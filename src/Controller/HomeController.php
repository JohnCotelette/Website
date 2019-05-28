<?php 
namespace App\Src\Controller;
use App\Src\Framework\Database;
use App\Src\Framework\Controller;

class HomeController extends Controller
{
	private $articleModel;

	public function __construct()
	{
		parent::__construct();
		$database = new Database;
	}

	public function home()
	{
		$this->view->addTitle("Samuel Darras - Développeur Web");
		return $this->view->render("home", []);
	}
}