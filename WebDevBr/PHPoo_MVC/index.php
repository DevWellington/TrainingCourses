<?php

define('ROOT', __DIR__);
define('DS', DIRECTORY_SEPARATOR);

require ROOT.DS.'vendor'.DS.'autoload.php';

$route = new MeuFramework\Core\Routes();
$route
	->add('/', array(
			'controller'=>'paginas',
			'action'=>'home'
		)
	)
	->load();
exit;