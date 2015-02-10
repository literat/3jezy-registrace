<?php

namespace App\Presenters;

use Nette;
use App\Model;
use SystemAuth;
use Nette\Application\UI\Form;
use Tracy\Debugger;
use SkautIS;


/**
 * Sign in/out presenters.
 */
class LoginPresenter extends BasePresenter
{


	/**
	 * Redirects user to Dashboard  when he/she is logged in
	 *
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
	 *
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = new Form;
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

	/**
	 * Sign-in form succeeded.
	 *
	 * @return void
	 */
	public function signInFormSucceeded($form, $values)
	{
		if ($values->remember) {
			$this->user->setExpiration('14 days', FALSE);
		} else {
			$this->user->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->user->setAuthenticator(new SystemAuth\SystemAuthenticator($this->context->database, $this->context));
			$this->user->login($values->email, $values->password);
			$this->redirect('Dashboard:');

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


	/**
	 * Registration form factory.
	 *
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignUpForm()
	{
		$form = new Form;
		$form->addText('name', 'Jméno:', 35)
			->setRequired('Zadejte prosím své jméno.')
			->setAttribute('placeholder', 'Jméno')
			->addRule(FORM::FILLED, 'Jméno musí být vyplněno!')
			->addCondition(Form::FILLED);

		$form->addText('surname', 'Příjmení:', 60)
			->setRequired('Zadejte prosím své příjmení.')
			->setAttribute('placeholder', 'Příjmení')
			->addRule(Form::FILLED, 'Příjmení musí být vyplněno!')
			->addCondition(Form::FILLED);

		$form->addText('email', 'E-mail:', 35)
			->setRequired('Prosím zadejte svůj e-mail.')
			->setAttribute('placeholder', 'E-mail')
			->addCondition(Form::FILLED, 'E-mail musí být vyplněn!')
			->addRule(Form::EMAIL, 'Nevalidní e-mailová adresa!');

		$form->addPassword('password', 'Heslo:')
			->setRequired('Prosím zadejte své heslo.')
			->setAttribute('placeholder', 'Heslo')
			->addRule(Form::FILLED, 'Heslo musí být vyplněno!')
			->addRule(Form::MIN_LENGTH, 'HEslo musí mít alespoň %d znaků!', 6);

		$form->addSubmit('signup', 'Zaregistrovat')
			->setAttribute('class', 'button large danger');

		// call method signUpFormSucceeded() on success
		$form->onSuccess[] = $this->signUpFormSucceeded;
		return $form;
	}


	/**
	 * Sign-in form succeeded.
	 *
	 * @return void
	 */
	public function signUpFormSucceeded($form, $values)
	{
		// TODO: try if new user is unique
		// TODO: generate global unique id
		$this->context->registerService->add($values);
		$this->flashMessage('You have been registered succesfuly.');
	}


	/**
	 * Logout action
	 *
	 * @return void
	 */
	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}

}
