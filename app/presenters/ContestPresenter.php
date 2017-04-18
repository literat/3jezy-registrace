<?php

namespace App\Presenters;

use Nette;
use Nette\Database\Context;
use Nette\Application\UI\Form;
use Nette\DI\Container;
use	App\Model;


/**
 * Contest presenter.
 */
class ContestPresenter extends BaseSecuredPresenter
{


	const
		TABLE_NAME = 'contests';

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
		$this->template->contests = $this->database->table($this->tablePrefix . self::TABLE_NAME);
	}


	public function actionEdit($id)
	{
		$contest = $this->database->table($this->tablePrefix . self::TABLE_NAME)->get($id);
		if (!$contest) {
			$this->error('Závod nebyl nalezen');
		}
		$this['contestForm']->setDefaults($contest->toArray());
	}


	protected function createComponentContestForm()
	{
		$form = new Form;
		$form->addText('name', 'Název:')
			->setRequired();
		$form->addText('start_date', 'Začátek:')
			->setRequired();
		$form->addText('end_date', 'Konec:')
			->setRequired();

		$form->addSubmit('send', 'Uložit');
		$form->onSuccess[] = array($this, 'contestFormSucceeded');

		return $form;
	}


	public function contestFormSucceeded($form, $values)
	{
		$contestId = $this->getParameter('id');

		if ($contestId) {
			$contest = $this->database->table($this->tablePrefix . self::TABLE_NAME)->get($contestId);
			$contest->update($values);
		} else {
			$contest = $this->database->table($this->tablePrefix . self::TABLE_NAME)->insert($values);
		}

		$this->flashMessage('Závod byl úspěšně přidán.', 'success');
		$this->redirect('default');
	}

}
