<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 23/08/2018
 * Time: 10:23
 */

namespace Controller\EstadosController;

require '../Model/Conexao.php';
require '../Model/Estados.php';

use Model\Estados;
use Model\Conexao;

class EstadosController
{
    function selecionartodos(){
        $database = new Conexao();
        $db = $database->getConnection();

        $estado = new Estados($db);
        $estados = $estado->selecionartodos();

        echo json_encode($estados, JSON_UNESCAPED_UNICODE);
    }
}

/**
 * Parte responsável pelo controle de requisições
 */

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$acao = htmlspecialchars($acao, ENT_QUOTES);

switch ($acao){
    case 'selecionartodos':
        $estado = new EstadosController();
        $estado->selecionartodos();

        break;
    default:
        echo "Função não encontrada";
        break;
}