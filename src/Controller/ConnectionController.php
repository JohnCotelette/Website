<?php
namespace App\Src\Controller;
use App\Src\Framework\Database;
use App\Src\Framework\Controller;
use App\Src\Framework\Session;
use App\Src\Model\AdminModel;
use App\Src\Entity\Admin;
use Exception;

class ConnectionController extends Controller
{
	private $adminModel;

	public function __construct()
	{
		parent::__construct();
		$database = new Database;
		$this->adminModel = new AdminModel($database);
	}

	public function connect($failConnect = null)
	{
		if ($failConnect)
		{
			$this->view->addParameters("Connexion",
			[
				"animations", "signIn", "failConnect"
			],
			[
				"MobileNav", "Captcha", "NotARobot"
			]);
		}
		else
		{
			$this->view->addParameters("Connexion",
			[
				"animations", "signIn"
			], 
			[
			 	"MobileNav", "Captcha", "NotARobot"
			]);
		}
		return $this->view->render("signIn", "internHeader", []);
	}

	public function disconnect()
	{
		Session::endSession();
		$this->view->addParameters("Deconnexion...", 
		[
			"animations", "disconnect"
		],
		[
			"MobileNav", "Ajax", "AutoRedirect"
		]);
		return $this->view->render("disconnect", "internHeader", []);
	}

	public function checkConnect($data)
	{
		$name = addslashes($data["pseudo"]);
		$password = addslashes($data["password"]);

		try
		{
			$admin = $this->adminModel->checkAdminIfExist($name);
			if ($admin)
			{
				if (password_verify($password, $admin->getPassword()))
				{
					$rights = $admin->getRights();
					Session::customizeSession("adminName", $name);
					Session::customizeSession("adminRights", $rights);
					header("Location: index.php?admin");
				}
				else
				{
					throw new Exception;
				}
			}
			else
			{
				throw new Exception;
			}
		}

		catch (Exception $e)
		{
			throw new Exception;
		}
	}
}