<?php 
namespace App\Src\Controller;
use App\Src\Framework\Database;
use App\Src\Framework\Controller;
use App\Src\Model\AdminModel;
use App\Src\Model\MessageModel;
use App\Src\Model\ProjectModel;
use App\Src\Model\SiteContentModel;
use App\Src\Model\SkillModel;
use App\Src\Model\AdminThemeModel;
use App\Src\Utility\FormattingHelper;
use Exception;

class AdminController extends Controller
{
	private $adminModel; 
	private $messageModel;
	private $projectModel;
	private $siteContentModel;
	private $skillModel;
	private $adminThemeModel;

	public function __construct()
	{
		parent::__construct();
		$database = new Database;
		$this->adminModel = new AdminModel($database);
		$this->messageModel = new MessageModel($database);
		$this->projectModel = new ProjectModel($database);
		$this->siteContentModel = new SiteContentModel($database);
		$this->skillModel = new SkillModel($database);
		$this->adminThemeModel = new AdminThemeModel($database);
	}

	public function admin()
	{
		$admins = $this->adminModel->getAdminsList();
		$messages = $this->messageModel->getMessages();
		$projects = $this->projectModel->getProjects();
		$siteContent = $this->siteContentModel->getContent();
		$skills = $this->skillModel->getSkills();
		$adminThemes = $this->adminThemeModel->getThemes();
		$adminThemeSelected = $this->adminThemeModel->getThemeSelected();
		$totalAdmins = count($admins);
		$totalMessages = count($messages);
		$totalProjects = count($projects);
		$totalSkills = count($skills);
		$totalAdminThemes = count($adminThemes);
		$title = "Administration - " . $_SESSION["adminName"];
		switch ($adminThemeSelected)
		{
			case "défaut" :
				$cssAdminThemeSelected = "default";
				break;
			case "sombre" :
				$cssAdminThemeSelected = "dark";
				break;
		}
		$this->view->addParameters($title,
			[
				"animations", "admin", $cssAdminThemeSelected
			],
			[
				"MobileNav", "Ajax", "interfaceAdmin"
			]);
		return $this->view->render("admin", "internHeader",
		[
			"admins" => $admins,
			"messages" => $messages,
			"projects" => $projects,
			"siteContent" => $siteContent,
			"skills" => $skills,
			"adminThemes" => $adminThemes,
			"totalAdmins" => $totalAdmins,
			"totalMessages" => $totalMessages,
			"totalProjects" => $totalProjects,
			"totalSkills" => $totalSkills,
			"totalAdminThemes" => $totalAdminThemes
		]);
	}

	public function getDataProject($data)
	{
		try
		{
			$projectID = $data["projectID"];
			$dataProject = $this->projectModel->getOneProject($projectID, true);
			echo json_encode($dataProject);
		}

		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function deleteMessage($data)
	{
		try
		{
			$messageID = $data["messageID"];
			$this->messageModel->deleteMessage($messageID);
			echo "Le message a bien été supprimé de la base de données.";
		}

		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function editSiteTextContent($data)
	{
		try
		{
			$bigTitleHeader = addslashes($data["bigTitleHeader"]);
			$smallTitleHeader = addslashes($data["smallTitleHeader"]);
			$cvDesc = addslashes($data["cvDesc"]);
			$cvDescMore = addslashes($data["cvDescMore"]);
			$contactEmail = addslashes($data["contactEmail"]);
			$phoneNumber = addslashes($data["contactPhoneNumber"]);
			$this->siteContentModel->editContent($bigTitleHeader, $smallTitleHeader, $cvDesc, $cvDescMore, $contactEmail, $phoneNumber);
			echo "Les modifications ont bien été prises en compte.";
		}

		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function editSiteSkills($data)
	{
		try
		{
			$HTMLProgress = $data["HTML5"];
			$CSSProgress = $data["CSS3"];
			$JAVASCRIPTProgress = $data["JAVASCRIPT"];
			$PHPProgress = $data["PHP"];
			$SQLProgress = $data["MYSQL"];
			$values = [$HTMLProgress, $CSSProgress, $JAVASCRIPTProgress, $PHPProgress, $SQLProgress];
			forEach($values as $value)
			{
				if (!ctype_digit($value) || $value < 0 || $value > 100 )
				{
					throw new Exception("Les valeurs de progression doivent être entières et se situer dans un intervalle compris entre 0 et 100 inclus.");
				}
			}
			$helpfullData = array_slice($data, 0, -2);
			forEach($helpfullData as $skillName => $progress)
			{
				$this->skillModel->editSkillsProgress($skillName, $progress);
			}
			echo "Les modifications ont bien été prises en compte.";
		}

		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function addProject($data, $picture)
	{
		try
		{
			$newProjectTitle = $data["projectTitle"];
			$newProjectDesc = $data["projectDesc"];
			$newProjectType = $data["projectType"];
			$newProjectLink = $data["projectLink"];
			$newProjectGithubLink = $data["projectGithubLink"];
			$newProjectPicture = $picture["projectPicture"];

			if (FormattingHelper::countOnlyCharacters($newProjectTitle) <= 6 || FormattingHelper::countOnlyCharacters($newProjectDesc) <= 25)
			{
				throw new Exception("Le titre du projet doit faire au moins 6 caractères et sa description 25.");
			}
			if ($newProjectType !== "fromScratch" && $newProjectType !== "CMS")
			{
				throw new Exception("Le type du projet n'est pas compatible avec les options d'origine.");
			}
			if (!filter_var($newProjectLink, FILTER_VALIDATE_URL))
			{
				throw new Exception("L'URL du projet est invalide.");
			}
			if (!empty($newProjectGithubLink))
			{
				if (!filter_var($newProjectGithubLink, FILTER_VALIDATE_URL))
				{
					throw new Exception("L'URL Github du projet est invalide.");
				}
			}
			if ($newProjectPicture["size"] > 0 && $newProjectPicture["size"] < 307200)
			{
				if ($newProjectPicture["type"] == "image/jpg" || $newProjectPicture["type"] == "image/jpeg")
				{
					$directory = "img/";
					$locationPicture = $newProjectPicture["tmp_name"];
					$namePicture = $newProjectPicture["name"];
					if (file_exists("$directory/$namePicture"))
					{
						$namePicture = time() . $namePicture;
					}
					move_uploaded_file($locationPicture, "$directory/$namePicture");
					$newProjectTitle = addslashes($newProjectTitle);
					$newProjectDesc = addslashes($newProjectDesc);
					$namePictureForDB = FormattingHelper::cutExtension($namePicture);
					$this->projectModel->addProject($newProjectTitle, $newProjectType, $newProjectLink, $newProjectGithubLink, $namePictureForDB, $newProjectDesc);
					echo "L'article a bien été ajouté.";
				}
				else
				{
					throw new Exception("L'image doit être au format jpg ou jpeg.");
				}
			}
			else
			{
				throw new Exception("L'image doit peser moins de 300 kio.");
			}
		}

		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function editProject($data, $picture)
	{
		try
		{

			$projectID = $data["projectID"];
			$projectTitle = $data["projectTitle"];
			$projectDesc = $data["projectDesc"];
			$projectType = $data["projectType"];
			$projectLink = $data["projectLink"];
			$projectGithubLink = $data["projectGithubLink"];
			$projectPicture = $picture["projectPicture"];
			if (FormattingHelper::countOnlyCharacters($projectTitle) <= 6 || FormattingHelper::countOnlyCharacters($projectDesc) <= 25)
			{
				throw new Exception("Le titre du projet doit faire au moins 6 caractères et sa description 25.");
			}
			else
			{
				$projectTitle = addslashes($projectTitle);
				$projectDesc = addslashes($projectDesc);
			}
			if ($projectType !== "fromScratch" && $projectType !== "CMS")
			{
				throw new Exception("Le type du projet n'est pas compatible avec les options d'origine.");
			}
			if (!filter_var($projectLink, FILTER_VALIDATE_URL))
			{
				throw new Exception("L'URL du projet est invalide.");
			}
			if (!empty($projectGithubLink))
			{
				if (!filter_var($projectGithubLink, FILTER_VALIDATE_URL))
				{
					throw new Exception("L'URL Github du projet est invalide.");
				}
			}
			if ($projectPicture["size"] !== 0)
			{
				if ($projectPicture["size"] < 307200)
				{
					if ($projectPicture["type"] == "image/jpg" || $projectPicture["type"] == "image/jpeg")
					{
						$lastPictureName = $data["lastPicture"];
						$directory = "img/";
						$locationPicture = $projectPicture["tmp_name"];
						$namePicture = $projectPicture["name"];
						if (file_exists("$directory/$namePicture"))
						{
							$namePictureForDB = time() . $namePicture;
						}
						move_uploaded_file($locationPicture, "$directory/$namePicture");
						$namePictureForDB = FormattingHelper::cutExtension($namePicture);
						$oldPictureLocation = $directory . $lastPictureName . ".jpg";
						if (!file_exists("$oldPictureLocation"))
						{
							$oldPictureLocation = $directory . $lastPictureName . ".jpeg";
							if (!file_exists("$oldPictureLocation"))
							{
								$oldPictureLocation = $directory . $lastPictureName;
							}
						}
						unlink("$oldPictureLocation");
					}
					else
					{
						throw new Exception("L'image doit être au format jpg ou jpeg.");
					}
				}
				else
				{
					throw new Exception("L'image doit peser moins de 300 kio.");
				}
			}
			else
			{
				$namePictureForDB = $data["lastPicture"];
			}
			$this->projectModel->editProject($projectID, $projectTitle, $projectType, $projectLink, $projectGithubLink, $namePictureForDB, $projectDesc);
			echo "Le projet a bien été modifié.";
		}

		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function deleteProject($data)
	{
		try
		{
			$projectID = $data["projectID"];
			$project = $this->projectModel->getOneProject($projectID);
			$this->projectModel->deleteProject($projectID);
			$pictureName = $project->getPictureName();
			$directory = "img/";
			$pictureLocation = $directory . $pictureName . ".jpg";
			if (!file_exists("$pictureLocation"))
			{
				$pictureLocation = $directory . $pictureName . ".jpeg";
				if (!file_exists("$pictureLocation"))
				{
					$pictureLocation = $directory . $pictureName;
				}
			}
			unlink("$pictureLocation");
			echo "Le projet séléctionné a bien été supprimé de la base de données.";
		}

		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function addAdmin($data)
	{
		try
		{
			$name = $data["addAdminPseudo"];
			$password = $data["addAdminPassword"];
			$regexAdmin = "/^[[:alnum:][:punct:]]{8,25}$/";
			$admin = $this->adminModel->checkAdminIfExist(addslashes($name));
			if ($admin)
			{
				throw new Exception("Ce pseudo est déjà utilisé.");
			}
			if (preg_match($regexAdmin, $name) && preg_match($regexAdmin, $password))
			{
				$name = addslashes($name);
				$password = addslashes($password);
				$password = password_hash($password, PASSWORD_DEFAULT);
				$rights;
				switch($data["addAdminRights"])
				{
					case "testeur":
						$rights = 0;
						break;
					case "administrateur":
						$rights = 1;
						break;
				}
				$this->adminModel->addAdmin($name, $password, $rights);
				echo "Le nouveau collaborateur a bien été ajouté à la base de données.";
			}
			else
			{
				throw new Exception("Le pseudo et le mot de passe saisis sont tous deux soumis à un minimum de 8 caractères et 25 au maximum.");
			}
		}

		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function deleteAdmin($data)
	{
		try
		{
			$adminID = $data["adminID"];
			if ($adminID > 1)
			{
				$this->adminModel->deleteAdmin($adminID);
				echo "L'admin séléctionné a bien été supprimé de la base de données.";
			}
			else
			{
				throw new Exception ("Le propriétaire du site est la seule personne a ne pas pouvoir être supprimée de la base de données.");
			}
		}

		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	} 

	public function changeTheme($data)
	{
		$oldThemeID = $data["oldThemeID"];
		$newThemeID = $data["newThemeID"];
		$this->adminThemeModel->changeTheme($oldThemeID, $newThemeID);
		$newThemeCss = $this->adminThemeModel->getThemeSelectedCss($newThemeID);
		echo json_encode($newThemeCss);
	}
}