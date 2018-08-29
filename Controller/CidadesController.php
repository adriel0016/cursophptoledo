<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 23/08/2018
 * Time: 10:23
 */

namespace Controller\CidadesController;

require '../Model/Conexao.php';
require '../Model/Cidades.php';

use Model\Cidades;
use Model\Conexao;

class CidadesController
{
    function selecionarporestado($codigoestado){
        $database = new Conexao();
        $db = $database->getConnection();

        $cidade = new Cidades($db);
        $cidades = $cidade->selecionarporestado($codigoestado);

        echo json_encode($cidades, JSON_UNESCAPED_UNICODE);
    }
}

/**
 * Parte responsável pelo controle de requisições
 */

$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

$acao = htmlspecialchars($acao, ENT_QUOTES);

switch ($acao){
    case 'selecionarporestado':

        $codigoestado = isset($_POST['codigoestado']) ? $_POST['codigoestado'] : '';
        $codigoestado = htmlspecialchars($codigoestado, ENT_QUOTES);

        $cidade = new CidadesController();
        $cidade->selecionarporestado($codigoestado);

        break;
    default:
        echo "Função não encontrada";
        break;
}