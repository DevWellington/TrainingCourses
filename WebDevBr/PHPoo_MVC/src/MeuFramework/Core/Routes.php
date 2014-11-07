<?php

namespace MeuFramework\Core;

class Routes
{

	use \MeuFramework\Helpers\Request;
	use \MeuFramework\Helpers\Strings_converter;

	protected $config;

	public function add($url, Array $mirror)
	{
		$url = '/'.trim($url, '/');
		$this->config[$url] = $mirror;
		return $this;
	}

	public function load()
	{
		$path = $this->request()['path_info'];
		if (!empty($this->config[$path])) {
			$routes = $this->config[$path];

			$this->string = $routes['controller'];
			$this->toUpper();

			$controller = 'Mvc\Controller\\'.$this->string.'Controller';
			$controller = new $controller();
			$controller->$routes['action']();
		} else {
			echo 'Opa!!!! Essa rota não existe!';
		}
	}
}
