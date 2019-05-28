<?php 
namespace App\Src\Framework;
use App\Src\Framework\View;

abstract class Controller
{
	protected $view;

	public function __construct()
	{
		$this->view = new View();
	}
}