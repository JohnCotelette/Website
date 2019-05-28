<?php
namespace App\Src\Framework;
use App\Src\Framework\Database;

abstract class Model
{
	protected $dataBase;

	public function __construct(Database $item)
	{
		$this->dataBase = $item;
	}
}