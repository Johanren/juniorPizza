<?php

class ModeloNomina
{
    public $tabla = "nomina";
    function agregarPagoNominaModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (id_usuario, nombre, apellido, rol, pago, dias_trabajados) VALUES (?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['id_usuario'], PDO::PARAM_INT);
            $stms->bindParam(2, $dato['nombre'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['apellido'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['rol'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['pago'], PDO::PARAM_INT);
            $stms->bindParam(6, $dato['dia'], PDO::PARAM_INT);
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

    function ConsultarNominaModelo($id)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        $sql = "SELECT * FROM $this->tabla WHERE id_usuario = ? AND fecha_ingreso = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($id != '') {
            $stms->bindParam(1, $id, PDO::PARAM_INT);
            $stms->bindParam(2, $fechaActal, PDO::PARAM_STR);
        }
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

    function deudaNominaModelo()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        $fechaActal = $fechaActal . "%";
        $sql = "SELECT SUM(pago) FROM $this->tabla WHERE fecha_ingreso like ?";
        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return [];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function consultarNominaPedidoAjaxModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_nomina = ?";
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
}