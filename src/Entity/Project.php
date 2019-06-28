<?php 
namespace App\Src\Entity;

class Project
{
	private $ID;
	private $title;
	private $type;
	private $link;
	private $githubLink;
	private $pictureName;
	private $description;

	public function getID()
	{
		return $this->ID;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getLink()
	{
		return $this->link;
	}

	public function getGithubLink()
	{
		return $this->githubLink;
	}

	public function getPictureName()
	{
		return $this->pictureName;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setID($id)
	{
		$this->ID = $id;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function setLink($link)
	{
		$this->link = $link;
	}

	public function setGithubLink($githubLink)
	{
		$this->githubLink = $githubLink;
	}

	public function setPictureName($pictureName)
	{
		$this->pictureName = $pictureName;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}
}