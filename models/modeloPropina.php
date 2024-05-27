<?php

class ModeloPropina
{
    public $tabla = "propinas";
    function agregarPropinaModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla(id_factura, valor_propinas) VALUES (?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['id_factura'], PDO::PARAM_INT);
            $stms->bindParam(2, $dato['propina'], PDO::PARAM_INT);
        }
        try {
            if ($stms->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function listarPropinaModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_factura = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id, PDO::PARAM_INT);
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

    function listarPropinaInicioFinModelo($inicio, $fin)
    {
        $sql = "SELECT SUM(valor_propinas) FROM $this->tabla WHERE fecha_ingreso = ? OR fecha_ingreso = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $inicio, PDO::PARAM_STR);
        $stms->bindParam(2, $fin, PDO::PARAM_STR);
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

    function actualizarPropinaAjaxModelo($propina, $id)
    {
        $sql = "UPDATE $this->tabla SET valor_propinas=? WHERE id_factura=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $propina, PDO::PARAM_INT);
        $stms->bindParam(2, $id, PDO::PARAM_INT);
        try {
            if ($stms->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
}
