<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Base secured presenter for all application secured presenters.
 */
abstract class BaseSecuredPresenter extends BasePresenter
{

	/**
	 * Startup
	 */
	protected function startup()
	{
		parent::startup();
		$this->template->backlink = $this->getParameter("backlink");

		if (!$this->getUser()->isLoggedIn()) {
			$this->redirect(':Login:');
		} else {
			// extends login session by every request
			//$this->context->authService->updateLogoutTime();
		}
	}


	/**
	 * Handle changing roles
	 *
	 * @param   $roleId  role ID
	 * @return  void
	 */
	public function handleChangeRole($roleId) {
		$this->context->userService->updateSkautISRole($roleId);
		$this->redirect("this");
	}

	/**
	 * Before render
	 *
	 * Set user roles or log out
	 */
	public function beforeRender() {
		parent::beforeRender();
		try {
			if ($this->user->isLoggedIn() && $this->context->userService->isLoggedIn()) {
				$this->template->myRoles = $this->context->userService->getAllSkautISRoles();
				$this->template->myRole = $this->context->userService->getRoleId();
			}
		} catch (Exception $ex) {
			$this->user->logout();
		}
	}

}
