<?php
namespace App\Src\Utility;

class AddCssScripts
{
	static public function addCss($file)
	{
		return $newCss = '<link rel="stylesheet" href="css/' . $file . '.css" />';
	}

	static public function addScript($file, $parameter = null)
	{
		return $newScript = '<script src="js/' . $file . '.js"' . $parameter . '></script>';	
	}
}