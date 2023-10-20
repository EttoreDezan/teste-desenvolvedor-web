<?php
@ob_start();
session_start();
// responsavél pelo carregamento das classes da arquitetura

require_once "../teste-desenvolvedor-web/vendor/autoload.php";

// Instancia do objeto
$route = new \App\Route;
