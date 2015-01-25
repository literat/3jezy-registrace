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
		$form->addText('username', 'E-mail:')
			->setRequired('Please enter your e-mail.')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'E-mail');

		$form->addPassword('password', 'Password:')
			->setRequired('Please enter your password.')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Password');

		$form->addCheckbox('remember', 'Keep me signed in');

		$form->addSubmit('signin', 'Sign in')
			->setAttribute('class', 'btn btn-lg btn-primary btn-block');

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
		$form->addText('name', 'Name:')
			->setRequired('Please enter your name.')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Name');

		$form->addText('surname', 'Surname:')
			->setRequired('Please enter your surname.')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Surname');

		$form->addText('email', 'E-mail:')
			->setRequired('Please enter your e-mail.')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'E-mail');

		$form->addPassword('password', 'Password:')
			->setRequired('Please enter your surname.')
			->setAttribute('class', 'form-control')
			->setAttribute('placeholder', 'Password');

		$form->addSubmit('signup', 'Sign up')
			->setAttribute('class', 'btn btn-lg btn-success btn-block');

		// call method signInFormSucceeded() on success
		$form->onSuccess[] = $this->signUpFormSucceeded;
		return $form;
	}


	public function signUpFormSucceeded($form, $values)
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


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}

}
