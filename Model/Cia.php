<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 23/08/2018
 * Time: 10:25
 */

namespace Model;

class Cia
{
    // conexão com a base de dados
    private $conn;

    // Propriedades do Objeto
    public $codigo;
    public $nome;

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

    public function __construct($db){
        $this->conn = $db;
    }

    /**
     * Selecionar CIA
     * @param $codigo
     */
    function selecionar($codigo) {
        try {
            $query = "SELECT * FROM cia WHERE codigo = :codigo";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":codigo", $codigo, \PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            $row = array_map("utf8_encode", $row);

            $this->setNome($row['nome']);
            $this->setCodigo($row['codigo']);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Selecionar Todos CIA
     *
     * @return array
     */
    function selecionartodos() {
        try {
            $query = "SELECT * FROM cia";
            $stmt = $this->conn->prepare($query);
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
}