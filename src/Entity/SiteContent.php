<?php 
namespace App\Src\Entity;

class SiteContent
{
	private $ID;
	private $bigTitleHeader;
	private $smallTitleHeader;
	private $cvDesc;
	private $cvDescMore;
	private $email;
	private $phoneNumber;

	public function getID()
	{
		return $this->ID;
	}

	public function getBigTitleHeader()
	{
		return $this->bigTitleHeader;
	}

	public function getSmallTitleHeader()
	{
		return $this->smallTitleHeader;
	}

	public function getCVDesc()
	{
		return $this->cvDesc;
	}

	public function getCVDescMore()
	{
		return $this->cvDescMore;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getPhoneNumber()
	{
		return $this->phoneNumber;
	}

	public function setID($id)
	{
		$this->ID = $id;
	}

	public function setBigTitleHeader($bigTitleHeader)
	{
		$this->bigTitleHeader = $bigTitleHeader;
	}

	public function setSmallTitleHeader($smallTitleHeader)
	{
		$this->smallTitleHeader = $smallTitleHeader;
	}

	public function setCVDesc($cvDesc)
	{
		$this->cvDesc = $cvDesc;
	}

	public function setCVDescMore($cvDescMore)
	{
		$this->cvDescMore = $cvDescMore;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setPhoneNumber($phoneNumber)
	{
		$this->phoneNumber = $phoneNumber;
	}
}