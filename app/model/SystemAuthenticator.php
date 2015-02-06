<?php

namespace SystemAuth;

use Nette;
use Nette\Security;
use Nette\Database\Context;
use Nette\Security\Passwords;

/**
 * Use for data from this system only!
 *
 * @author Litera Tomas <tomas@litera.me>
 */
class SystemAuthenticator extends Nette\Object implements Nette\Security\IAuthenticator
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


	public function __construct(Nette\Database\Connection $database)
	{
		$this->database = new Context($database);
	}


	/**
	 * Performs an authentication.
	 *
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($email, $password) = $credentials;

		$row = $this->database->table(self::TABLE_NAME)->where(self::COLUMN_EMAIL, $email)->fetch();

		if (!$row) {
			throw new Nette\Security\AuthenticationException('The email is incorrect.', self::IDENTITY_NOT_FOUND);

		} elseif (!Passwords::verify($row[self::COLUMN_PASSWORD_SALT].$password.$row[self::COLUMN_PASSWORD_SALT], $row[self::COLUMN_PASSWORD_HASH])) {
			throw new Nette\Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);

		} elseif (Passwords::needsRehash($row[self::COLUMN_PASSWORD_HASH])) {
			$row->update(array(
				self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
			));
		}

		$arr = $row->toArray();
		unset($arr[self::COLUMN_PASSWORD_HASH]);
		return new Nette\Security\Identity($row[self::COLUMN_ID], $row[self::COLUMN_ROLE], $arr);
	}

}
