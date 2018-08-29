<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 23/08/2018
 * Time: 10:23
 */

namespace Controller\StatusVooController;

require '../Model/Conexao.php';
require '../Model/StatusVoo.php';

use Model\StatusVoo;
use Model\Conexao;

class StatusVooController
{
    function selecionartodos(){
        $database = new Conexao();
        $db = $database->getConnection();

        $status = new StatusVoo($db);
        $statusvoo = $status->selecionartodos();

        echo json_encode($statusvoo, JSON_UNESCAPED_UNICODE);
    }
}

/**
 * Parte responsável pelo controle de requisições
 */

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$acao = htmlspecialchars($acao, ENT_QUOTES);

switch ($acao){
    case 'selecionartodos':
        $status = new StatusVooController();
        $status->selecionartodos();

        break;
    default:
        echo "Função não encontrada";
        break;
}