<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Base secured presenter for all application secured presenters.
 */
abstract class BaseSecuredPresenter extends Nette\Application\UI\Presenter
{
	protected function startup()
	{
		parent::startup();
		if(!$this->getUser()->isLoggedIn()) $this->redirect('Sign:in');
	}
}
