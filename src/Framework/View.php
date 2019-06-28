<?php 
namespace App\Src\Framework;

class View
{
	private $file;
	private $title;
	private $header;
	private $css = [];
	private $scripts = [];

	public function addParameters($title, $css, $scripts)
	{
		$this->addTitle($title);

		forEach($css as $style)
		{
			$this->css[] = $style;
		}

		forEach($scripts as $script)
		{
			$this->scripts[] = $script;
		}
	}

	public function addTitle($title)
	{
		$this->title = $title;
	}

	public function render($contentTemplate, $headerTemplate, $data = [])
	{
		$this->file = "../template/" . $contentTemplate . ".php";
		$this->header = "../template/" . $headerTemplate . ".php";
		$header = $this->renderFile($this->header, $data);
		$content = $this->renderFile($this->file, $data);
		$view = $this->renderFile("../template/base.php", [
			"title" => $this->title,
			"header" => $header,
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
			throw new Exception;
		}
	}
}