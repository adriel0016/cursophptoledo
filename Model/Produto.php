<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 21/08/2018
 * Time: 13:31
 */

namespace Model;

class Produto
{
    // conexão com a base de dados
    private $conn;

    // object properties
    public $codigo;
    public $nome;
    public $preco;
    public $descricao;
    public $categoriacodigo;
    public $datacadastro;

    public function __construct($db){
        $this->conn = $db;
    }

    /**
     * Cadastrar Produto
     *
     * @return bool
     */
    function cadastrar() {
        try {
            // Query MySQL
            $query = "INSERT INTO produtos SET 
                          nome = :nome, 
                          preco = :preco, 
                          descricao = :descricao, 
                          categoriacodigo = :categoriacodigo, 
                          datacadastro = :datacadastro";

            // Estabelece a conexão
            $stmt = $this->conn->prepare($query);

            // Valores com os parametros
            $this->nome = htmlspecialchars(strip_tags($this->nome));
            $this->preco = htmlspecialchars(strip_tags($this->preco));
            $this->descricao = htmlspecialchars(strip_tags($this->descricao));
            $this->categoriacodigo = htmlspecialchars(strip_tags($this->categoriacodigo));

            // Data e hora atual do servidor
            $this->datacadastro = date('Y-m-d H:i:s');

            // Parametros
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":descricao", $this->descricao);
            $stmt->bindParam(":categoriacodigo", $this->categoriacodigo);
            $stmt->bindParam(":datacadastro", $this->datacadastro);

            if($stmt->execute()){
                return true;
            } else {
                return false;
            }

        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    // editar produto
    function editar() {
        try {

            $query = "UPDATE produtos SET 
                          nome = :nome,
                          preco = :preco,
                          descricao = :descricao,
                          categoriacodigo  = :categoriacodigo
                      WHERE
                          codigo = :codigo";

            $stmt = $this->conn->prepare($query);

            $this->nome = htmlspecialchars(strip_tags($this->nome));
            $this->preco = htmlspecialchars(strip_tags($this->preco));
            $this->descricao = htmlspecialchars(strip_tags($this->descricao));
            $this->categoriacodigo = htmlspecialchars(strip_tags($this->categoriacodigo));
            $this->codigo = htmlspecialchars(strip_tags($this->codigo));

            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":descricao", $this->descricao);
            $stmt->bindParam(":categoriacodigo", $this->categoriacodigo);
            $stmt->bindParam(":datacadastro", $this->datacadastro);
            $stmt->bindParam(':codigo', $this->codigo);

            if($stmt->execute())
                return true;

            return false;

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    // selecionar produto
    function selecionar($codigo) {
        try {

            $query = "SELECT * FROM produtos WHERE codigo = :codigo";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":codigo", $codigo, \PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            $row = array_map("utf8_encode", $row);

            $this->nome = $row['nome'];
            $this->preco = $row['preco'];
            $this->descricao = $row['descricao'];
            $this->categoriacodigo = $row['categoriacodigo'];
            $this->datacadastro = $row['datacadastro'];
            $this->codigo = $row['codigo'];

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    // selecionar todos produtos
    function selecionartodos() {
        try {

            $query = "SELECT * FROM produtos";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return json_encode($rows, JSON_UNESCAPED_UNICODE);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

}