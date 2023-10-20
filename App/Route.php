<?php

namespace App;

use MF\Init\Bootstrap;
class Route extends Bootstrap {
	protected function initRoutes() {

        $routes['home'] = array(
            'route' => '/',
            'controller' => 'indexController',
            'action' => 'index',
        );

        $routes['cadastro'] = array(
            'route' => '/cadastro',
            'controller' => 'CadastroController',
            'action' => 'cadastro',
        );

        $routes['editar'] = array(
            'route' => '/editar',
            'controller' => 'EditarController',
            'action' => 'editar',
        );

        $routes['deletar'] = array(
            'route' => '/deletar',
            'controller' => 'DeleteController',
            'action' => 'deletar',
        );
		$this->setRoutes($routes);
	}
}

?>