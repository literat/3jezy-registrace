<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BaseSecuredPresenter
{
	public function renderDefault()
	{
		$this->template->anyVariable = 'any value';
	}

}
