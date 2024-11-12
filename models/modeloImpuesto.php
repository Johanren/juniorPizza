<?php

class ModeloImpuesto
{
    public $tabla = "impuesto";
    function listarAjaxImpuestoModelo($dato)
    {
        $sql = "SELECT * FROM $this->tabla WHERE numero_impuesto like ? OR nombre_impusto like ? OR base_impuesto like ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != null) {
                $nombre = '%' . $dato . '%';
                $stms->bindParam(1, $nombre, PDO::PARAM_INT);
                $stms->bindParam(2, $nombre, PDO::PARAM_STR);
                $stms->bindParam(3, $nombre, PDO::PARAM_INT);
            }
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return [];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function listarImpuesoModelo($dato)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_impuesto = ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != null) {
                $stms->bindParam(1, $dato, PDO::PARAM_INT);
            }
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return [];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
}
