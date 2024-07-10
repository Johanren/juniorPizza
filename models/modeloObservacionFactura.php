<?php

class ModeloObservacionFactura
{
    public $tabla = "descripcion_factura";

    function agregarObservacionFacturaModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla(nombre, placa, observacion, id_factura) VALUES (?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['nombre'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['placa'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['observacion'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['id_factura'], PDO::PARAM_INT);
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
    function listarObservacionFacturaModelo($placa)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN factura ON factura.id_factura = descripcion_factura.id_factura WHERE placa like ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($placa != '') {
            $placa = "%" . $placa . "%";
            $stms->bindParam(1, $placa, PDO::PARAM_STR);
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

    function listarObservacionFacturaIdModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_factura = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($id != '') {
            $stms->bindParam(1, $id, PDO::PARAM_INT);
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
}
