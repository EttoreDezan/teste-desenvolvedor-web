<?php

namespace App\Controllers;


//os recursos do projeto
use MF\Controller\Action;
use MF\Model\Container;

//os models
use App\Models\Pessoa;

require "IndexController.php";
class DeleteController extends Action
{
    public function deletar()
    {
        $id = $_GET['id'];

        $pessoa = Container::getModel('Pessoa');

        $pessoa->deletePessoaById($id);
        $indexController = new IndexController();

        $indexController->index();

    }
}
