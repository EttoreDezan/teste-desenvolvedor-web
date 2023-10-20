<?php

namespace App\Controllers;

//os recursos do projeto
use MF\Controller\Action;
use MF\Model\Container;

//os models
use App\Models\Pessoa;

class IndexController extends Action
{
	public function index()
	{
		$pessoa = Container::getModel('Pessoa');

		$dadosPessoa = $pessoa->getPessoa();

		@$this->view->dados = $dadosPessoa;

		$this->render('listar', 'layout1');


	}

}
