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
		$router[] = new Route('sign/<action>[/back-<backlink>]',
			[
				"presenter"	=> "Auth",
				"action"	=> "default",
				"backlink"	=> NULL
			],
			Route::SECURED
		);
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Dashboard:default', Route::SECURED);
		return $router;
	}

}
