<?php 
namespace App\Src\Framework;
use App\Src\Framework\Session;
use App\Src\Controller\HomeController;
use Exception;

class Router 
{
	// One page = one controller
	private $homeController;

	public function __construct()
	{
		Session::buildSession();
		$this->homeController = new HomeController();
	}

	public function run()
	{
		try
		{
			if (isset($_GET["test"]))
			{

			}
			else
			{
				$this->homeController->home();
			}
		}

		catch (Exception $e)
		{
			
		}
	}
}
