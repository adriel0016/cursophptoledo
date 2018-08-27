<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 23/08/2018
 * Time: 10:25
 */

namespace Model;

require "Estados.php";

use Model\Estados;

class Cidades
{
    // conexão com a base de dados
    private $conn;

    // Propriedades do Objeto
    public $codigo;
    public $nome;
    public $codigoestado;

    public $estados;

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getCodigoestado()
    {
        return $this->codigoestado;
    }

    /**
     * @param mixed $codigoestado
     */
    public function setCodigoestado($codigoestado)
    {
        $this->codigoestado = $codigoestado;
    }

    public function __construct($db){
        $this->conn = $db;

        $this->estados = new Estados($this->conn);
    }

    /**
     * Selecionar Cidade
     * @param $codigo
     */
    function selecionar($codigo) {
        try {
            $query = "SELECT * FROM cidades WHERE codigo = :codigo";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":codigo", $codigo, \PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            $this->setNome($row['nome']);
            $this->setCodigoestado($row['codigoestado']);
            $this->setCodigo($row['codigo']);

            $this->estados->selecionar($row['codigoestado']);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Selecionar por Estados
     * @param $codigo
     * @return array
     */
    function selecionarporestado($codigo) {
        try {
            $query = "SELECT * FROM cidades WHERE codigoestado = :codigo";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":codigo", $codigo, \PDO::PARAM_INT);
            $stmt->execute();

            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $resultado = array();

            foreach ($rows as $row){
                $resultado[] = $row;
            }

            return $resultado;

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Selecionar Todas Cidades
     * @return array
     */
    function selecionartodos() {
        try {
            $query = "SELECT * FROM cidades"; // WHERE datavoo = NOW()
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $resultado = array();

            $i = 0;
            foreach ($rows as $row){
                $resultado[$i] = $row;

                $this->estados->selecionar($row['codigoestado']);

                $resultado[$i]['estados'] = $this->estados;

                $i++;
            }

            return $resultado;

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}