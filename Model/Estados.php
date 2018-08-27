<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 23/08/2018
 * Time: 10:25
 */

namespace Model;

class Estados
{
    // conexão com a base de dados
    private $conn;

    // Propriedades do Objeto
    public $codigo;
    public $nome;
    public $sigla;

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
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * @param mixed $sigla
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
    }

    public function __construct($db){
        $this->conn = $db;
    }

    /**
     * Selecionar Estados
     * @param $codigo
     */
    function selecionar($codigo) {
        try {
            $query = "SELECT * FROM estados WHERE codigo = :codigo";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":codigo", $codigo, \PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            $row = array_map("utf8_encode", $row);

            $this->setNome($row['nome']);
            $this->setSigla($row['sigla']);
            $this->setCodigo($row['codigo']);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Selecionar Todos Estados
     * @return array
     */
    function selecionartodos() {
        try {
            $query = "SELECT * FROM estados";
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