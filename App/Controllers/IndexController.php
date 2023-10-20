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

    public function cadastro()
    {
        $pessoa = Container::getModel('Pessoa');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pessoa->insertPessoa();
            $this->index();
        }

        $this->render('cadastro', 'layout1');

    }
    public function editar()
    {
        $id = $_GET['id'];

        $pessoa = Container::getModel('Pessoa');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pessoa->updatePessoa($id);;
        }

        $dadosPessoa = $pessoa->getPessoaById($id);

        @$this->view->dados = $dadosPessoa;

        $this->render('editar', 'layout1');
    }

    public function deletar()
    {
        $id = $_GET['id'];

        $pessoa = Container::getModel('Pessoa');

        $pessoa->deletePessoaById($id);

        $this->index();


    }
}
