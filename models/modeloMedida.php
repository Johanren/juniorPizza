<?php
require_once 'conexion.php';
class ModeloMedida
{
    public $tabla = "medida";
    function agregarMeedidaModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (nombre_medida, id_activo) VALUES (?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['med'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['activo'], PDO::PARAM_INT);
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

    function listarMedidaaModelo()
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN activo ON activo.id_activo = medida.id_activo";
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

    function consultarMedidaAjaxModelo($dato)
    {
        if ($dato != '') {
            $dato = '%' . $dato . '%';
            $sql = "SELECT * FROM $this->tabla WHERE nombre_medida like ? ORDER BY id_medida ";
        } else {
            $sql = "SELECT * FROM $this->tabla ORDER BY id_medida";
        }

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != '') {
                $stms->bindParam(1, $dato, PDO::PARAM_STR);
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

    function listarMedidaIdModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN activo ON activo.id_activo = medida.id_activo WHERE id_medida = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id, PDO::PARAM_STR);
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

    function actualizarMeedidaModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET nombre_medida=?,id_activo=? WHERE id_medida=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['med'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['activo'], PDO::PARAM_INT);
            $stms->bindParam(3, $dato['id'], PDO::PARAM_INT);
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
}