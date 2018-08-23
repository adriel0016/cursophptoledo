<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 23/08/2018
 * Time: 10:23
 */

namespace Controller\VooController;

require '../Model/Conexao.php';
require '../Model/Voo.php';

use Model\Voo;
use Model\Conexao;

class VooController
{
    function selecionar($codigo){
        $database = new Conexao();
        $db = $database->getConnection();

        $voo = new Voo($db);
        $voo->selecionar($codigo);

        echo json_encode($voo, JSON_UNESCAPED_UNICODE);
    }

    function selecionartodos(){
        $database = new Conexao();
        $db = $database->getConnection();

        $voo = new Voo($db);
        $voos = $voo->selecionartodos();

        echo json_encode($voos, JSON_UNESCAPED_UNICODE);
    }
}

// COLOCAR EM UM ARQUIVO INTERMEDIÁRIO

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

switch ($acao){
    case 'selecionar':
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';

        $voo = new VooController();
        $voo->selecionar($codigo);

        break;
    case 'selecionartodos':
        $voo = new VooController();
        $voo->selecionartodos();

        break;
    default:
        echo "Função não encontrada";
        break;
}