<?php 
namespace App\Src\Framework;
use App\Src\Framework\Session;
use App\Src\Controller\HomeController;
use App\Src\Controller\ConnectionController;
use App\Src\Controller\AdminController;
use Exception;

class Router 
{
	private $homeController;
	private $connectionController;
	private $adminController;

	public function __construct()
	{
		Session::buildSession();
		$this->homeController = new HomeController();
		$this->connectionController = new ConnectionController();
		$this->adminController = new AdminController();
	}

	public function run()
	{
		try
		{
			if (!empty($_POST))
			{
				if (isset($_POST["changeTheme"]) && $_POST["changeTheme"] == true && isset($_POST["oldThemeID"]) && isset($_POST["newThemeID"]))
				{
					$this->adminController->changeTheme($_POST);
				}
				else if (isset($_POST["deleteMessage"]) && $_POST["deleteMessage"] == true && isset($_POST["messageID"]) && isset($_POST["jsAuthorization"]) && $_POST["jsAuthorization"] == true && $_SESSION["adminRights"] > 0)
				{
					$this->adminController->deleteMessage($_POST);
				}
				else if (isset($_POST["bigTitleHeader"]) && isset($_POST["smallTitleHeader"]) && isset($_POST["cvDesc"]) && isset($_POST["cvDescMore"]) && isset($_POST["jsAuthorization"]) && $_POST["jsAuthorization"] == true  && $_SESSION["adminRights"] > 0)
				{
					$this->adminController->editSiteTextContent($_POST);
				}
				else if (isset($_POST["editSkills"]) && $_POST["editSkills"] == true && isset($_POST["jsAuthorization"]) && $_POST["jsAuthorization"] == true  && $_SESSION["adminRights"] > 0)
				{
					$this->adminController->editSiteSkills($_POST);
				}
				else if (isset($_POST["addProject"]) && $_POST["addProject"] == true && isset($_POST["jsAuthorization"]) && $_POST["jsAuthorization"] == true  && $_SESSION["adminRights"] > 0)
				{
					$this->adminController->addProject($_POST, $_FILES);
				}
				else if (isset($_POST["requestDataProject"]) && $_POST["requestDataProject"] == true && isset($_POST["jsAuthorization"]) && $_POST["jsAuthorization"] == true  && $_SESSION["adminRights"] > 0)
				{
					$this->adminController->getDataProject($_POST);
				}
				else if (isset($_POST["editProject"]) && $_POST["editProject"] == true && isset($_POST["jsAuthorization"]) && $_POST["jsAuthorization"] == true  && $_SESSION["adminRights"] > 0)
				{
					$this->adminController->editProject($_POST, $_FILES);
				}
				else if (isset($_POST["deleteProject"]) && $_POST["deleteProject"] == true && isset($_POST["jsAuthorization"]) && $_POST["jsAuthorization"] == true  && $_SESSION["adminRights"] > 0)
				{
					$this->adminController->deleteProject($_POST);
				}
				else if (isset($_POST["addAdminPseudo"]) && isset($_POST["addAdminPassword"]) && isset($_POST["addAdminRights"]) && isset($_POST["jsAuthorization"]) && $_POST["jsAuthorization"] == true  && $_SESSION["adminRights"] > 0)
				{
					$this->adminController->addAdmin($_POST);
				}
				else if (isset($_POST["deleteAdmin"]) && $_POST["deleteAdmin"] == true && isset($_POST["adminID"]) && isset($_POST["jsAuthorization"]) && $_POST["jsAuthorization"] == true  && $_SESSION["adminRights"] > 0)
				{
					$this->adminController->deleteAdmin($_POST);
				}
				else if (isset($_POST["pseudo"]) && isset($_POST["password"]))
				{
					$this->connectionController->checkConnect($_POST);
				}
				else if (isset($_POST["formName"]) && isset($_POST["formSurname"]) && isset($_POST["formEmail"]) && isset($_POST["formSubject"]) && isset($_POST["formContent"]) && isset($_POST["jsAuthorization"]) && $_POST["jsAuthorization"] == true)
				{
					$this->homeController->sendMessage($_POST);
				}
				else if (isset($_POST["newName"]))
				{
					$this->connectionController->addAdmin($_POST);
				}
			}
			else if (isset($_GET["adminConnect"]))
			{
				if (isset($_SESSION["adminName"]))
				{
					header("Location: index.php?admin");
				}
				else
				{
					$this->connectionController->connect();
				}
			}
			else if (isset($_GET["adminDisconnect"]))
			{
				if (isset($_SESSION["adminName"]))
				{
					$this->connectionController->disconnect();
				}
				else
				{
					throw new Exception;
				}
			}
			else if (isset($_GET["admin"]))
			{
				if (!empty($_SESSION))
				{
					$this->adminController->admin();
				}
				else
				{
					throw new Exception;
				}
			}
			else
			{
				$this->homeController->home();
			}
		}

		catch (Exception $e)
		{
			if (isset($_POST["pseudo"]) && isset($_POST["password"]))
			{
				$this->connectionController->connect($e);
			}
			else
			{
				$this->homeController->home();
			}
		}
	}
}
