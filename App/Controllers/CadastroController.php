<?php

namespace App\Controllers;


//os recursos do projeto
use MF\Controller\Action;
use MF\Model\Container;

//os models
use App\Models\Pessoa;

require "IndexController.php";
class CadastroController extends Action
{
    public function cadastro()
    {
        $pessoa = Container::getModel('Pessoa');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pessoa->insertPessoa();

            $indexController = new IndexController();
            $indexController->index();
        }

        $this->render('cadastro', 'layout1');

    }
}
