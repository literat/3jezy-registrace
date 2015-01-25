<?php

namespace App;

use Nette,
	Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 */
class RouterFactory
{

	/**
	 * @return \Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
		$router[] = new Route('index.php', 'Dashboard:default', Route::ONE_WAY);
		$router[] = new Route('sign/<action>[/back-<backlink>]', array(
			"presenter" => "Auth",
			"action" => "default",
			"backlink" => NULL
		));
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Dashboard:default');
		return $router;
	}

}
