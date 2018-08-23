<?php
/**
 * Created by PhpStorm.
 * User: ADRIE
 * Date: 22/08/2018
 * Time: 22:40
 */

namespace Controller\ProdutoController;

require '../Model/Conexao.php';
require '../Model/Produto.php';

use Model\Produto;
use Model\Conexao;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ProdutoController
{
    function selecionar($codigo){

        $database = new Conexao();
        $db = $database->getConnection();

        $produto = new Produto($db);
        $produto->selecionar($codigo);

        echo json_encode($produto, JSON_UNESCAPED_UNICODE);

    }
}


$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : '';

if(isset($_GET['codigo'])){
    $produto = new ProdutoController();
    $produto->selecionar($_GET['codigo']);
}