<?php

namespace App\Controllers;

//os recursos do projeto
use MF\Controller\Action;
use MF\Model\Container;

//os models
use App\Models\Pessoa;

class EditarController extends Action
{
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
