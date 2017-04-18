<?php

use Nette\InvalidArgumentException;
use Nette\Security\IAuthenticator;
use Nette\Security\IIdentity;

/**
 * Provides unified access to multiple authenticators
 *
 * @author Vojtěch Dobeš
 */
class MultiAuthenticator implements IAuthenticator
{

	/** @var callable[] */
	private $authenticators = array();


	/**
	 * Registers authenticator
	 *
	 * @param  string
	 * @param  IAuthenticator|callable
	 * @return MultiAuthenticator provides a fluent interface
	 */
	public function addAuthenticator($key, $authenticator)
	{
		//dump($authenticator);
		//exit;
		if ($authenticator instanceof IAuthenticator) {
			$this->authenticators[$key] = array($authenticator, 'authenticate');
		} elseif (is_callable($authenticator)) {
			$this->authenticators[$key] = $authenticator;
		} else {
			//var_dump($authenticator);
			//exit;
			//throw new InvalidArgumentException('Authenticator must be callable or instance of IAuthenticator.');
		}

		return $this;
	}


	/**
	 * Tries to authenticate via authenticator named as first argument
	 *
	 * @param  array
	 * @return IIdentity
	 */
	public function authenticate(array $args)
	{
		$key = array_shift($args);

		if (!isset($this->authenticators[$key])) {
			throw new InvalidArgumentException("Authenticator named '$key' is not registered.");
		}

		return call_user_func($this->authenticators[$key], $args);
	}

}

