<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 23/08/2018
 * Time: 10:25
 */

namespace Model;

class Voo
{
    // conexão com a base de dados
    private $conn;

    // Propriedades do Objeto
    public $codigo;
    public $identificacao;
    public $portao;
    public $cia;
    public $datavoo;
    public $codigoaeronave;

    public function __construct($db){
        $this->conn = $db;
    }

    /**
     * Cadastrar Voo
     *
     * @return bool
     */
    function cadastrar() {
        try {
            // Query MySQL
            $query = "INSERT INTO voo 
                         (identificacao = :identificacao, 
                          portao = :portao, 
                          cia = :cia, 
                          datavoo = :datavoo, 
                          codigoaeronave = :codigoaeronave)";

            // Estabelece a conexão
            $stmt = $this->conn->prepare($query);

            // Valores com os parametros
            $this->identificacao = htmlspecialchars(strip_tags($this->identificacao));
            $this->portao = htmlspecialchars(strip_tags($this->portao));
            $this->cia = htmlspecialchars(strip_tags($this->cia));
            $this->datavoo = htmlspecialchars(strip_tags($this->datavoo));
            $this->codigoaeronave = htmlspecialchars(strip_tags($this->codigoaeronave));

            // Data e hora atual do servidor
            $this->datavoo = date('Y-m-d H:i:s');

            // Parametros
            $stmt->bindParam(":identificacao", $this->identificacao);
            $stmt->bindParam(":portao", $this->portao);
            $stmt->bindParam(":cia", $this->cia);
            $stmt->bindParam(":datavoo", $this->datavoo);
            $stmt->bindParam(":codigoaeronave", $this->codigoaeronave);

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

            $query = "UPDATE voo SET 
                          identificacao = :identificacao, 
                          portao = :portao, 
                          cia = :cia, 
                          datavoo = :datavoo, 
                          codigoaeronave = :codigoaeronave
                      WHERE
                          codigo = :codigo";

            $stmt = $this->conn->prepare($query);

            $this->identificacao = htmlspecialchars(strip_tags($this->identificacao));
            $this->portao = htmlspecialchars(strip_tags($this->portao));
            $this->cia = htmlspecialchars(strip_tags($this->cia));
            $this->datavoo = htmlspecialchars(strip_tags($this->datavoo));
            $this->codigoaeronave = htmlspecialchars(strip_tags($this->codigoaeronave));
            $this->codigo = htmlspecialchars(strip_tags($this->codigo));

            $stmt->bindParam(":identificacao", $this->identificacao);
            $stmt->bindParam(":portao", $this->portao);
            $stmt->bindParam(":cia", $this->cia);
            $stmt->bindParam(":datavoo", $this->datavoo);
            $stmt->bindParam(":codigoaeronave", $this->codigoaeronave);
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
            $query = "SELECT * FROM voo WHERE codigo = :codigo";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":codigo", $codigo, \PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            $row = array_map("utf8_encode", $row);

            $this->identificacao = $row['identificacao'];
            $this->portao = $row['portao'];
            $this->cia = $row['cia'];
            $this->datavoo = $row['datavoo'];
            $this->codigoaeronave = $row['codigoaeronave'];
            $this->codigo = $row['codigo'];

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    // selecionar todos produtos
    function selecionartodos() {
        try {
            $query = "SELECT * FROM voo";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $rows;

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}