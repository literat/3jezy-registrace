<?php

namespace App\Presenters;

use Nette;
use Nette\Database\Context;
use Nette\Application\UI\Form;
use	App\Model;


/**
 * Contact presenter.
 */
class ContactPresenter extends BaseSecuredPresenter
{


	const
		TABLE_NAME = 'registration_data';

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
		$this->template->contacts = $this->database->table($this->tablePrefix . self::TABLE_NAME);
	}


	public function actionEdit($id)
	{
		$contact = $this->database->table($this->tablePrefix . self::TABLE_NAME)->get($id);
		if (!$contact) {
			$this->error('Kontakt nebyl nalezen');
		}
		$this['contactForm']->setDefaults($contact->toArray());
	}


	protected function createComponentContactForm()
	{
		$form = new Form;
		$form->addText('city', 'Město:')
			->setRequired();
		$form->addText('street', 'Ulice:')
			->setRequired();
		$form->addText('postal_code', 'PSČ:')
			->setRequired();
		$form->addText('gsm', 'Telefon:')
			->setRequired();
		$form->addText('province', 'Kraj:')
			->setRequired();
		$form->addText('group_num', 'Číslo jednotky:')
			->setRequired();
		$form->addText('group_name', 'Název jednotky:')
			->setRequired();
		$form->addText('troop_name', 'Název oddílu:')
			->setRequired();

		$form->addSubmit('send', 'Uložit');
		$form->onSuccess[] = array($this, 'contactFormSucceeded');

		return $form;
	}


	public function contactFormSucceeded($form, $values)
	{
		$contactId = $this->getParameter('id');

		if ($contactId) {
			$contact = $this->database->table($this->tablePrefix . self::TABLE_NAME)->get($contactId);
			$contact->update($values);
		} else {
			$contact = $this->database->table($this->tablePrefix . self::TABLE_NAME)->insert($values);
		}

		$this->flashMessage('Kontakt byl úspěšně vytvořen.', 'success');
		$this->redirect('default');
	}

}
