<?php 
namespace App\Src\Controller;
use App\Src\Framework\Database;
use App\Src\Framework\Controller;
use App\Src\Model\SiteContentModel;
use App\Src\Model\ProjectModel;
use App\Src\Model\SkillModel;
use App\Src\Model\MessageModel;
use App\Src\Entity\ContactEmail;
use App\Src\Utility\FormattingHelper;
use Exception;

class HomeController extends Controller
{
	private $siteContentModel;
	private $projectModel;
	private $skillModel;
	private $messageModel;

	public function __construct()
	{
		parent::__construct();
		$dataBase = new Database;
		$this->siteContentModel = new SiteContentModel($dataBase);
		$this->projectModel = new ProjectModel($dataBase);
		$this->skillModel = new SkillModel($dataBase);
		$this->messageModel = new MessageModel($dataBase);
	}

	public function home()
	{
		$siteContent = $this->siteContentModel->getContent();
		$projects = $this->projectModel->getProjects();
		$skills = $this->skillModel->getSkills();
		$this->view->addParameters($siteContent[1]->getBigTitleHeader() . " - " . $siteContent[1]->getSmallTitleHeader(),
		[
			"animations", "home"
		],
		[
			"MobileNav", "HomeAnimations", "HomeNav", "ProjectsController", "Ajax", "FormContact"
		]);
		return $this->view->render("home", "homeHeader", 
		[
			"siteContent" => $siteContent,
			"projects" => $projects,
			"skills" => $skills
		]);
	}

	public function sendMessage($data)
	{
		try
		{
			$name = $data["formName"];
			$surname = $data["formSurname"];
			$email = $data["formEmail"];
			$subject = $data["formSubject"];
			$content = $data["formContent"];
			if (FormattingHelper::countOnlyCharacters($name) >= 3 && FormattingHelper::countOnlyCharacters($name) <= 30 && FormattingHelper::countOnlyCharacters($surname) >= 3 && FormattingHelper::countOnlyCharacters($surname) <= 30 && FormattingHelper::countOnlyCharacters($subject) >= 8 && FormattingHelper::countOnlyCharacters($subject) <= 100 && FormattingHelper::countOnlyCharacters($content) >= 50 && FormattingHelper::countOnlyCharacters($content) <= 800)
			{
				if (filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					$email = addslashes($email);
					$subject = addslashes($subject);
					$content = addslashes($content);
					$name = addslashes($name);
					$surname = addslashes($surname);
					$completeName = $name . " " . $surname;
					$this->messageModel->addMessage($completeName, $email, $subject, $content);
					echo "ok";
					$contentEmail = str_replace(array("\r\n", "\n"),"<br />", stripslashes($content));
					$contactEmail = new ContactEmail(
						[
							"surname" => stripslashes($surname),
							"name" => stripslashes($name),
							"email" => stripslashes($email),
							"subject" => stripslashes($subject),
							"content" => $contentEmail
						]);
					$contactEmail->sendEmail();
					return;
				}
				else
				{
					throw new Exception("L'adresse email est invalide.");
				}
			}
			else
			{
				throw new Exception("Veuillez saisir un minimum de contenu dans les différents champs (3 caractères pour le nom et le prénom [30 max], 8 pour le sujet [100 max] et 50 pour le contenu de votre message [800 max].");
			}
		}

		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
}