<?php 
namespace App\Src\Entity;

class Admin
{
	private $ID;
	private $name;
	private $password;
	private $rights;

	public function getID()
	{
		return $this->ID;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getRights()
	{
		return $this->rights;
	}

	public function setID($id)
	{
		$this->ID = $id;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function setRights($rights)
	{
		$this->rights = $rights;
	}
}