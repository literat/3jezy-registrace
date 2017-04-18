<?php

namespace App\Presenters;

use Nette;
use Nette\Database\Context;
use Nette\Application\UI\Form;
use Nette\DI\Container;
use	App\Model;


/**
 * Category presenter.
 */
class CategoryPresenter extends BaseSecuredPresenter
{


	const TABLE_NAME = 'categories';

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
		$this->template->categories = $this->database->table($this->tablePrefix . self::TABLE_NAME);
	}


	public function actionEdit($categoryId)
	{
		$category = $this->database->table($this->tablePrefix . self::TABLE_NAME)->get($categoryId);
		if (!$category) {
			$this->error('Kategorie nebyla nalezena');
		}
		$this['categoryForm']->setDefaults($category->toArray());
	}


	protected function createComponentCategoryForm()
	{
		$form = new Form;
		$form->addText('name', 'Název:')
			->setRequired();
		$form->addTextArea('description', 'Popis:')
			->setRequired();
		$form->addText('shortcut', 'Zkratka:')
			->setRequired();

		$form->addSubmit('send', 'Uložit');
		$form->onSuccess[] = array($this, 'categoryFormSucceeded');

		return $form;
	}


	public function categoryFormSucceeded($form, $values)
	{
		$categoryId = $this->getParameter('id');

		if ($categoryId) {
			$category = $this->database->table($this->tablePrefix . self::TABLE_NAME)->get($categoryId);
			$category->update($values);
		} else {
			$category = $this->database->table($this->tablePrefix . self::TABLE_NAME)->insert($values);
		}

		$this->flashMessage('Kategorie byla úspěšně uložena.', 'success');
		$this->redirect('default');
	}

}
