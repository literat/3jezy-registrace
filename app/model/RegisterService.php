<?php

use Nette\Database\Context;
use Nette\Utils\Strings;
use Nette\Security\Passwords;

/**
 * Registration service
 */
class RegisterService extends Nette\Object
{


	const
		TABLE_NAME = 'users',
		COLUMN_ID = 'id',
		COLUMN_EMAIL = 'email',
		COLUMN_PASSWORD_HASH = 'password',
		COLUMN_PASSWORD_SALT = 'salt',
		COLUMN_NAME = 'name',
		COLUMN_SURNAME = 'surname',
		COLUMN_ROLE = 'role';


	/** @var Nette\Database\Context */
	private $database;


	/** @var string */
	private $tablePrefix = 'r3j__';


	public function __construct(Context $database)
	{
		$this->database = $database;
		//	$this->tablePrefix = $tablePrefix;
	}


	/**
	 * Adds new user.
	 *
	 * @param  values
	 * @return void
	 */
	public function add($values)
	{
		$salt = $this->generateSalt(10);
		$this->database->table($this->tablePrefix . self::TABLE_NAME)->insert(array(
			self::COLUMN_EMAIL => $values->{self::COLUMN_EMAIL},
			self::COLUMN_PASSWORD_HASH => Passwords::hash($salt.$values->{self::COLUMN_PASSWORD_HASH}.$salt),
			self::COLUMN_PASSWORD_SALT => $salt,
			self::COLUMN_NAME => $values->{self::COLUMN_NAME},
			self::COLUMN_SURNAME => $values->{self::COLUMN_SURNAME},
		));
	}


	/**
	 * Generates salt.
	 *
	 * @param  length
	 * @return string
	 */
	private function generateSalt($length)
	{
		return $this->random($length);
	}


	/**
	 * Generates random text from base.
	 *
	 * @param  length
	 * @param  base
	 * @return string
	 */
	private function random($length, $base = "abcdefghjkmnpqrstwxyz0123456789")
	{
		$max = strlen($base)-1;
		$string = "";

		mt_srand((double)microtime()*1000000);
		while (strlen($string) < $length)
			$string .= $base[mt_rand(0,$max)];

		return $string;
	}

}