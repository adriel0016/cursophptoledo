<?php
// set page headers
$page_title = "Cadastro de Produto";

// include database and object files
include_once '../api/Conexao.php';
include_once '../functions/Produto.php';

// get database connection
$database = new Conexao();
$db = $database->getConnection();

// pass connection to objects
$produto = new Produto($db);

include_once "header.php";

// contents will be here

$lista = Array();

$lista = $produto->selecionartodos();

foreach ($lista as $object){
    echo $object['nome'] . "<br/>";
}

// footer
include_once "footer.php";
?>