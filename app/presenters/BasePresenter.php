<?php

namespace App\Presenters;

use Nette,
	App\Model;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

	/**
	 * backlink
	 */
	protected $backlink;

	/**
	 * Startup
	 */
	protected function startup()
	{
		parent::startup();
		$this->template->backlink = $this->getParameter("backlink");
	}

}
