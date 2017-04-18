<?php

namespace App\Presenters;

use Nette;
use Nette\Database\Context;
use Nette\DI\Container;
use Nette\Application\UI\Form;
use	App\Model;


/**
 * Competitor presenter.
 */
class CompetitorPresenter extends BaseSecuredPresenter
{


	const TABLE_NAME = 'competitors';

	/** @var Nette\Database\Context */
	private $database;


	/** @var string */
	private $tablePrefix;


	public function __construct(Context $database, Container $container)
	{
		$this->database = $database;
		$this->tablePrefix = $container->parameters['database']['prefix'];
	}


	public function renderDefault()
	{
		$this->template->competitors = $this->database->table($this->tablePrefix . self::TABLE_NAME);
	}


	public function actionEdit($id)
	{
		$competitor = $this->database->table($this->tablePrefix . self::TABLE_NAME)->get($id);
		if (!$competitor) {
			$this->error('Závodník nebyl nalezen');
		}
		$this['competitorForm']->setDefaults($competitor->toArray());
	}


	protected function createComponentCompetitorForm()
	{
		$form = new Form;
		$form->addText('name', 'Jméno:')
			->setRequired();
		$form->addText('surname', 'Příjmení:')
			->setRequired();
		$form->addText('nickname', 'Přezdívka:')
			->setRequired();
		$form->addText('birthday', 'Datum narození:')
			->setRequired();

		$form->addSubmit('send', 'Uložit');
		$form->onSuccess[] = array($this, 'competitorFormSucceeded');

		return $form;
	}


	public function competitorFormSucceeded($form, $values)
	{
		$competitorId = $this->getParameter('id');

		if ($competitorId) {
			$competitor = $this->database->table($this->tablePrefix . self::TABLE_NAME)->get($competitorId);
			$competitor->update($values);
		} else {
			$competitor = $this->database->table($this->tablePrefix . self::TABLE_NAME)->insert($values);
		}

		$this->flashMessage('Závodník byl úspěšně vytvořen.', 'success');
		$this->redirect('default');
	}

}
