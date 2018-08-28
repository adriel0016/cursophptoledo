<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 23/08/2018
 * Time: 10:25
 */

namespace Model;

require "StatusVoo.php";
require "Cia.php";
require "Cidades.php";

use Model\StatusVoo;
use Model\Cia;
use Model\Cidades;

class Voo
{
    // conexão com a base de dados
    private $conn;

    // Propriedades do Objeto
    public $codigo;
    public $identificacao;
    public $portao;
    public $datavoo;
    public $statusvoo;
    public $codigocia;
    public $codigocidade;

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
    public function getIdentificacao()
    {
        return $this->identificacao;
    }

    /**
     * @param mixed $identificacao
     */
    public function setIdentificacao($identificacao)
    {
        $this->identificacao = $identificacao;
    }

    /**
     * @return mixed
     */
    public function getPortao()
    {
        return $this->portao;
    }

    /**
     * @param mixed $portao
     */
    public function setPortao($portao)
    {
        $this->portao = $portao;
    }

    /**
     * @return mixed
     */
    public function getDatavoo()
    {
        return $this->datavoo;
    }

    /**
     * @param mixed $datavoo
     */
    public function setDatavoo($datavoo)
    {
        $this->datavoo = $datavoo;
    }

    /**
     * @return mixed
     */
    public function getStatusvoo()
    {
        return $this->statusvoo;
    }

    /**
     * @param mixed $statusvoo
     */
    public function setStatusvoo($statusvoo)
    {
        $this->statusvoo = $statusvoo;
    }

    /**
     * @return mixed
     */
    public function getCodigocia()
    {
        return $this->codigocia;
    }

    /**
     * @param mixed $codigocia
     */
    public function setCodigocia($codigocia)
    {
        $this->codigocia = $codigocia;
    }

    /**
     * @return mixed
     */
    public function getCodigocidade()
    {
        return $this->codigocidade;
    }

    /**
     * @param mixed $codigocidade
     */
    public function setCodigocidade($codigocidade)
    {
        $this->codigocidade = $codigocidade;
    }

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
                         (identificacao, portao, datavoo, codigocia, statusvoo, codigocidade) 
                         VALUES (:identificacao, :portao, :datavoo, :codigocia, :statusvoo, :codigocidade)";

            // Estabelece a conexão
            $stmt = $this->conn->prepare($query);

            // Parametros
            $stmt->bindValue(":identificacao", (int)$this->getIdentificacao());
            $stmt->bindValue(":portao", $this->getPortao());
            $stmt->bindValue(":datavoo", $this->getDatavoo());
            $stmt->bindValue(":codigocia", (int)$this->getCodigocia());
            $stmt->bindValue(":statusvoo", (int)$this->getStatusvoo());
            $stmt->bindValue(":codigocidade", (int)$this->getCodigocidade());

            if($stmt->execute()){
                return $this->conn->lastInsertId();
            } else {
                return false;
            }

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Editar Voo
     *
     * @return bool
     */
    function editar() {
        try {

            $query = "UPDATE voo SET 
                          identificacao = :identificacao, 
                          portao = :portao, 
                          datavoo = :datavoo, 
                          codigocia = :codigocia,
                          statusvoo = :statusvoo,
                          codigocidade = :codigocidade
                      WHERE
                          codigo = :codigo";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":identificacao", $this->getIdentificacao());
            $stmt->bindParam(":portao", $this->getPortao());
            $stmt->bindParam(":datavoo", $this->getDatavoo());
            $stmt->bindParam(":codigocia", $this->getCodigocia());
            $stmt->bindParam(":statusvoo", $this->getStatusvoo());
            $stmt->bindParam(":codigocidade", $this->getCodigocidade());
            $stmt->bindParam(':codigo', $this->getCodigo());

            if($stmt->execute())
                return true;

            return false;

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Excluir Voo
     *
     * @return bool
     */
    function excluir() {
        try {

            $query = "DELETE FROM voo WHERE codigo = :codigo";

            $stmt = $this->conn->prepare($query);

            $codigo = $this->getCodigo();

            $stmt->bindParam(':codigo', $codigo);

            if($stmt->execute())
                return true;

            return false;

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Selecionar Voo
     * @param $codigo
     */
    function selecionar($codigo) {
        try {
            $query = "SELECT * FROM voo WHERE codigo = :codigo";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":codigo", $codigo, \PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            $row = array_map("utf8_encode", $row);

            $this->setIdentificacao($row['identificacao']);
            $this->setPortao($row['portao']);
            $this->setDatavoo($row['datavoo']);
            $this->setStatusvoo($row['statusvoo']);
            $this->setCodigocia($row['codigocia']);
            $this->setCodigocidade($row['codigocidade']);
            $this->setCodigo($row['codigo']);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Selecionar Todos Voos
     * @return array
     */
    function selecionartodos() {
        try {
            $query = "SELECT *, DATE_FORMAT(datavoo, '%H:%i') as horavoo FROM voo WHERE date(datavoo) = date(now()) && datavoo >= NOW() ORDER BY datavoo ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $resultado = array();

            $i = 0;
            foreach ($rows as $row){
                $resultado[$i] = $row;

                $statusvoo = new StatusVoo($this->conn);
                $cia = new Cia($this->conn);
                $cidades = new Cidades($this->conn);

                $statusvoo->selecionar((int)$row['statusvoo']);
                $cia->selecionar((int)$row['codigocia']);
                $cidades->selecionar((int)$row['codigocidade']);

                $resultado[$i]['statusvoo'] = $statusvoo;
                $resultado[$i]['cia'] = $cia;
                $resultado[$i]['cidades'] = $cidades;

                $i++;
            }

            return $resultado;

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}