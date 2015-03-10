<?php

namespace App\Presenters;

use Nette;
use Nette\Database\Context;
use Nette\Application\UI\Form;
use	App\Model;


/**
 * System presenter.
 */
class SystemPresenter extends BaseSecuredPresenter
{


	const
		TABLE_NAME = 'system_settings';

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
		$this->template->settings = $this->database->table($this->tablePrefix . self::TABLE_NAME);
	}


	public function actionEdit($settingId)
	{
		$setting = $this->database->table($this->tablePrefix . self::TABLE_NAME)->get($settingId);
		if (!$setting) {
			$this->error('Nastavení nebylo nalezeno');
		}
		$this['settingForm']->setDefaults($setting->toArray());
	}


	protected function createComponentSettingForm()
	{
		$form = new Form;
		$form->addText('name', 'Název:')
			->setRequired();
		$form->addText('value', 'Hodnota:')
			->setRequired();

		$form->addSubmit('send', 'Uložit');
		$form->onSuccess[] = array($this, 'settingFormSucceeded');

		return $form;
	}


	public function settingFormSucceeded($form, $values)
	{
		$settingId = $this->getParameter('id');

		if ($settingId) {
			$setting = $this->database->table($this->tablePrefix . self::TABLE_NAME)->get($settingId);
			$setting->update($values);
		} else {
			$setting = $this->database->table($this->tablePrefix . self::TABLE_NAME)->insert($values);
		}

		$this->flashMessage('Nastavení bylo úspěšně uloženo.', 'success');
		$this->redirect('default');
	}

}
