<?php

class ModeloFuncion
{
    public $tabla = "funiones";
    function listarFuncionModelo()
    {
        $sql = "SELECT * FROM $this->tabla";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        try {
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function actualizarFuncion($valor, $nombre_campo)
    {
        $sql = "UPDATE $this->tabla SET estado = ? WHERE nombre_campo = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $valor, PDO::PARAM_STR);
        $stms->bindParam(2, $nombre_campo, PDO::PARAM_STR);
        try {
            if ($stms->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
