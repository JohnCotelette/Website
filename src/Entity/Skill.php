<?php 
namespace App\Src\Entity;

class Skill
{
	private $ID;
	private $title;
	private $pictureName;
	private $progress;

	public function getID()
	{
		return $this->ID;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getPictureName()
	{
		return $this->pictureName;
	}

	public function getProgress()
	{
		return $this->progress;
	}

	public function setID($id)
	{
		$this->ID = $id;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setPictureName($pictureName)
	{
		$this->pictureName = $pictureName;
	}

	public function setProgress($progress)
	{
		$this->progress = $progress;
	}
}