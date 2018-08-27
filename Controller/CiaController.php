<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 23/08/2018
 * Time: 10:23
 */

namespace Controller\CiaController;

require '../Model/Conexao.php';
require '../Model/Cia.php';

use Model\Cia;
use Model\Conexao;

class CiaController
{
    function selecionartodos(){
        $database = new Conexao();
        $db = $database->getConnection();

        $cia = new Cia($db);
        $cias = $cia->selecionartodos();

        echo json_encode($cias, JSON_UNESCAPED_UNICODE);
    }
}

// COLOCAR EM UM ARQUIVO INTERMEDIÁRIO

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$acao = htmlspecialchars($acao, ENT_QUOTES);

switch ($acao){
    case 'selecionartodos':
        $cia = new CiaController();
        $cia->selecionartodos();

        break;
    default:
        echo "Função não encontrada";
        break;
}