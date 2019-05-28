<?php 
require "../config/dev.php";
require "../vendor/autoload.php";
use App\Src\Framework\Router;

$router = new Router();
$router->run();