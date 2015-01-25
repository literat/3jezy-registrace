<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Dashboard presenter.
 */
class DashboardPresenter extends BaseSecuredPresenter
{
	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
	}

}
