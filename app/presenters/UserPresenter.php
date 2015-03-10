<?php

namespace App\Presenters;

use Nette;
use Nette\Database\Context;
use Nette\Application\UI\Form;
use	App\Model;


/**
 * User presenter.
 */
class UserPresenter extends BaseSecuredPresenter
{


	const
		TABLE_NAME = 'users';

	/** @var Nette\Database\Context */
	private $database;


	/** @var string */
	private $tablePrefix;


	public function __construct(Nette\Database\Connection $database, Nette\DI\Container $container)
	{
		$this->database = new Context($database);
		$this->tablePrefix = $container->parameters['database']['prefix'];
	}


	public function renderDefault()
	{
		$this->template->users = $this->database->table($this->tablePrefix . self::TABLE_NAME);
	}


	public function actionEdit($id)
	{
		$user = $this->database->table($this->tablePrefix . self::TABLE_NAME)->get($id);
		if (!$user) {
			$this->error('Uživatel nebyl nalezen');
		}
		$this['userForm']->setDefaults($user->toArray());
	}


	protected function createComponentUserForm()
	{
		$form = new Form;
		$form->addText('name', 'Jméno:')
			->setRequired();
		$form->addText('surname', 'Příjmení:')
			->setRequired();
		$form->addText('email', 'E-mail:')
			->setRequired();

		$form->addSubmit('send', 'Uložit');
		$form->onSuccess[] = array($this, 'userFormSucceeded');

		return $form;
	}


	public function userFormSucceeded($form, $values)
	{
		$userId = $this->getParameter('id');

		if ($userId) {
			$user = $this->database->table($this->tablePrefix . self::TABLE_NAME)->get($userId);
			$user->update($values);
		} else {
			$user = $this->database->table($this->tablePrefix . self::TABLE_NAME)->insert($values);
		}

		$this->flashMessage('Uživatel byl úspěšně přidán.', 'success');
		$this->redirect('default');
	}

}
