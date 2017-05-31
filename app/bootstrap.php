<?php

if(!function_exists('dd')) {
	/**
	 * Dump the passed variables and end the script.
	 *
	 * @param  mixed
	 * @return void
	 */
	function dd() {
		array_map(function ($x){
			(\Tracy\Debugger::dump($x));
		}, func_get_args());

		die(1);
	}
}

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;

//$configurator->setDebugMode(true);
$configurator->setDebugMode('23.75.345.200'); // enable for your remote IP
$configurator->enableDebugger(__DIR__ . '/../log');
error_reporting(~E_USER_DEPRECATED); // note ~ before E_USER_DEPRECATED

$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->addDirectory(__DIR__ . '/../vendor/others')
	->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');
if ($configurator->isDebugMode()) {
	$configurator->addConfig(__DIR__ . '/config/config.local.neon');
} else {
	$configurator->addConfig(__DIR__ . '/config/config.remote.neon');
}

$container = $configurator->createContainer();
//dd($container);
return $container;
