<?php 
namespace App\Src\Entity;

class AdminTheme
{
	private $ID;
	private $name;
	private $backgroundColor;
	private $backgroundColorSections;
	private $backgroundColorContent;
	private $backgroundColorButtons;
	private $textColor;
	private $status;

	public function getID()
	{
		return $this->ID;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getBackgroundColor()
	{
		return $this->backgroundColor;
	}

	public function getBackgroundColorSections()
	{
		return $this->backgroundColorSections;
	}

	public function getBackgroundColorContent()
	{
		return $this->backgroundColorContent;
	}

	public function getBackgroundColorButtons()
	{
		return $this->backgroundColorButtons;
	}

	public function getTextColor()
	{
		return $this->textColor;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setID($id)
	{
		$this->ID = $id;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function setBackgroundColor($backgroundColor)
	{
		$this->backgroundColor = $backgroundColor;
	}

	public function setBackgroundColorSections($backgroundColorSections)
	{
		$this->backgroundColorSections = $backgroundColorSections;
	}

	public function setBackgroundColorContent($backgroundColorContent)
	{
		$this->backgroundColorContent = $backgroundColorContent;
	}

	public function setBackgroundColorButtons($backgroundColorButtons)
	{
		$this->backgroundColorButtons = $backgroundColorButtons;
	}

	public function setTextColor($textColor)
	{
		$this->textColor = $textColor;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}
}