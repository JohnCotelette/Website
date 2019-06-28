<?php 
namespace App\Src\Entity;

class Message
{
	private $ID;
	private $date;
	private $identity;
	private $email;
	private $subject;
	private $content;

	public function getID()
	{
		return $this->ID;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getIdentity()
	{
		return $this->identity;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getSubject()
	{
		return $this->subject;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function setID($id)
	{
		$this->ID = $id;
	}

	public function setDate($date)
	{
		$this->date = $date;
	}

	public function setIdentity($identity)
	{
		$this->identity = $identity;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setSubject($subject)
	{
		$this->subject = $subject;
	}

	public function setContent($content)
	{
		$this->content = $content;
	}
}