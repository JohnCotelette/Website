<?php 
namespace App\Src\Framework;

class Session
{
	static public function buildSession()
	{
		if (session_status() !== PHP_SESSION_ACTIVE)
		{
			self::startSession();
		}
	}

	static public function startSession()
	{
		session_start();
	}

	static public function endSession()
	{
		session_destroy();
	}

	static public function customizeSession($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	static public function checkSession()
	{
		if (!empty($_SESSION))
		{
			return true;
		}
	}
}