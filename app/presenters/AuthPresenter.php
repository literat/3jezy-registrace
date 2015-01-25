<?php

namespace App\Presenters;

use Tracy\Debugger;
use Skautis;
use SkautisAuth;

/**
 * SkautIS Auth presenters.
 */
class AuthPresenter extends BasePresenter
{

	protected function startup()
	{
		parent::startup();
	}


	/**
	 * přesměruje na stránku s přihlášením
	 * Redirects to login page
	 *
	 * @param  	string  $backlink
	 * @return  void
	 */
	function actionSkautisLogin($backlink = NULL)
	{
		$this->redirectUrl($this->context->authService->getLoginUrl($backlink));
	}


	/**
	 * Handle SkautIS login process
	 *
	 * @param   string  $ReturnUrl
	 * @return  void
	 */
	function actionSkautIS($ReturnUrl = NULL)
	{
		$post = $this->request->post;
		// if token is not set - get out from here - must log in
		if (!isset($post['skautIS_Token'])) {
			$this->redirect(":Login:");
		}
		//Debugger::log("AuthP: ".$post['skautIS_Token']." / ". $post['skautIS_IDRole'] . " / " . $post['skautIS_IDUnit'], "auth");
		try {
			$this->context->authService->setInit($post);

			if (!$this->context->userService->isLoggedIn()) {
				throw new Skautis\Exception\AuthenticationException("Nemáte platné přihlášení do skautISu");
			}
			$me = $this->context->userService->getPersonalDetail();

			$this->user->setExpiration('+ 29 minutes'); // nastavíme expiraci
			$this->user->setAuthenticator(new SkautisAuth\SkautisAuthenticator());
			$this->user->login($me);

			if (isset($ReturnUrl)) {
				$this->context->application->restoreRequest($ReturnUrl);
			}
		} catch (\Skautis\Exception\AuthenticationException $e) {
			$this->flashMessage($e->getMessage(), "danger");
			$this->redirect(":Auth:Login");
		}
		$this->presenter->redirect(':Dashboard:');
	}


	/**
	 * Handle log out from SkautIS
	 * SkautIS redirects to this action after log out
	 *
	 * @param   void
	 * @return  void
	 */
	function actionLogoutFromSkautis()
	{
		$this->redirectUrl($this->context->authService->getLogoutUrl());
	}

	/**
	 * Log out from SkautIS
	 *
	 * @param   void
	 * @return  void
	 */
	function actionSkautisLogout()
	{
		$this->user->logout(TRUE);
		$this->context->userService->resetLoginData();
		$this->presenter->flashMessage("Byl jsi úspěšně odhlášen ze SkautISu.");
		/*
		if ($this->request->post['skautIS_Logout']) {
			$this->presenter->flashMessage("Byl jsi úspěšně odhlášen ze SkautISu.");
		} else {
			$this->presenter->flashMessage("Odhlášení ze skautISu se nezdařilo", "danger");
		}
		*/
		$this->redirect(":Login:");
		//$this->redirectUrl($this->service->getLogoutUrl());
	}

}
