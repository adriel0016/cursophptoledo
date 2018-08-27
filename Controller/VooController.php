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
    function cadastrar($identificacao, $portao, $cia, $datavoo, $codigoaeronave){
        $database = new Conexao();
        $db = $database->getConnection();

        $voo = new Voo($db);
        $voo->setIdentificacao($identificacao);
        $voo->setPortao($portao);
        $voo->setDatavoo($datavoo);
        $voo->setCia($cia);
        $voo->setCodigoaeronave($codigoaeronave);

        $ret = $voo->cadastrar();

        if($ret)
            echo json_encode($ret, JSON_UNESCAPED_UNICODE);

    }

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

$acao = htmlspecialchars($acao, ENT_QUOTES);

switch ($acao){
    case 'cadastrar':

        $identificacao = isset($_POST['identificacao']) ? $_POST['identificacao'] : '';
        $portao = isset($_POST['portao']) ? $_POST['portao'] : '';
        $datavoo = isset($_POST['datavoo']) ? $_POST['datavoo'] : '';
        $cia = isset($_POST['cia']) ? $_POST['cia'] : '';
        $statusvoo = isset($_POST['statusvoo']) ? $_POST['statusvoo'] : '';
        $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';

        $voo = new VooController();
        $voo->cadastrar($identificacao, $portao, $datavoo, $cia, $statusvoo, $cidade);

        break;
    case 'selecionar':
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
        $codigo = htmlspecialchars($codigo, ENT_QUOTES);

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