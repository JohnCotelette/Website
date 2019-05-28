<?php 
/**
 * A class to manage the view (motor)
 */

namespace App\Src\Framework;

class View
{
	private $file;
	private $title;
	private $css = [];
	private $scripts = [];

	public function addParameters($title, $css, $scripts)
	{
		$this->addTitle($title);

		if (is_array($css))
		{
			forEach($css as $style)
			{
				$this->addCSS($style);
			}
		}
		else 
		{
			$this->addCSS($css);
		}

		if (is_array($scripts))
		{
			forEach($scripts as $script)
			{
				$this->addScripts($script);
			}
		}
		else
		{
			$this->addScripts($scripts);
		}
	}

	public function addTitle($title)
	{
		$this->title = $title;
	}

	public function addCSS($file)
	{
		$this->css[] = '<link rel="stylesheet" href="css/' . $file . '.css" />';
	}

	public function addScripts($file)
	{
		$this->scripts[] = '<script src="js/' . $file . '.js"></script>';	
	}

	public function render($template, $data = [])
	{
		$this->file = "../template/" . $template . ".php";
		$content = $this->renderFile($this->file, $data);
		$view = $this->renderFile("../template/base.php", [
			"title" => $this->title,
			"css" => $this->css,
			"scripts" => $this->scripts,
			"content" => $content
		]);
		echo $view;	
	}

	public function renderFile($file, $data)
	{
		if(file_exists($file))
		{
			extract($data);
			ob_start();
			require $file;
			return ob_get_clean();
		}
		else
		{
			header("Location: index.php?route=notFound");
		}
	}
}