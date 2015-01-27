<?php

namespace App\Presenters;

use Nette,
	App\Model;
use Tracy\Debugger;
use SkautIS;


/**
 * Sign in/out presenters.
 */
class LoginPresenter extends BasePresenter
{

	/**
	 * Redirects user to Dashboard  when he/she is logged in
	 * @param string $backlin
	 */
	public function actionDefault($backlink)
	{
		if ($this->user->isLoggedIn()) {
			if ($backlink) {
				$this->restoreRequest($backlink);
			}
			$this->redirect(':Dashboard:');
		}
	}


	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('email', 'E-mail:')
			->setRequired('Prosím zadejte svůj e-mail.')
			->setAttribute('placeholder', 'E-mail')
			->addCondition($form::FILLED, 'E-mail musí být vyplněn!')
			->addRule($form::EMAIL, 'Nevalidní e-mailová adresa!');

		$form->addPassword('password', 'Heslo:')
			->setRequired('Prosím zadejte své heslo.')
			->setAttribute('placeholder', 'Heslo')
			->addCondition($form::FILLED, 'Heslo musí být vyplněno!');

		$form->addCheckbox('remember', 'Zapamatovat si mě!');

		$form->addSubmit('signin', 'Přihlásit')
			->setAttribute('class', 'button large success');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signInFormSucceeded;
		return $form;
	}


	public function signInFormSucceeded($form, $values)
	{
		if ($values->remember) {
			$this->getUser()->setExpiration('14 days', FALSE);
		} else {
			$this->getUser()->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->getUser()->login($values->username, $values->password);
			$this->redirect('Dashboard:');

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


	/**
	 * Registration form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignUpForm()
	{
		$form = new Nette\Application\UI\Form;
		$form->addText('name', 'Jméno:')
			->setRequired('Zadejte prosím své jméno.')
			->setAttribute('placeholder', 'Jméno')
			->addCondition($form::FILLED, 'Jméno musí být vyplněno!');

		$form->addText('surname', 'Příjmení:')
			->setRequired('Zadejte prosím své příjmení.')
			->setAttribute('placeholder', 'Příjmení')
			->addCondition($form::FILLED, 'Příjmení musí být vyplněno!');

		$form->addText('email', 'E-mail:')
			->setRequired('Prosím zadejte svůj e-mail.')
			->setAttribute('placeholder', 'E-mail')
			->addCondition($form::FILLED, 'E-mail musí být vyplněn!')
			->addRule($form::EMAIL, 'Nevalidní e-mailová adresa!');

		$form->addPassword('password', 'Heslo:')
			->setRequired('Prosím zadejte své heslo.')
			->setAttribute('placeholder', 'Heslo')
			->addCondition($form::FILLED, 'Heslo musí být vyplněno!');

		$form->addSubmit('signup', 'Zaregistrovat')
			->setAttribute('class', 'button large danger');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signUpFormSucceeded;
		return $form;
	}


	public function signUpFormSucceeded($form, $values)
	{
		$this->getUser()->setExpiration('20 minutes', TRUE);

		try {
			$this->getUser()->login($values->username, $values->password);
			$this->redirect('Dashboard:');

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}

}
