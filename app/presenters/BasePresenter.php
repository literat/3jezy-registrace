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


	/**
	 * Before render
	 * Prepare variables for template
	 */
	public function beforeRender()
	{
		parent::beforeRender();

		$this->template->production = $this->context->parameters['productionMode']/* === 'production' ? 1 : 0*/;
		$this->template->version = $this->context->parameters['site']['version'];
	}

}
