<?php

class ModeloFactura
{
    public $tabla = "factura";

    function agregarFacturaModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (id_usuario, total_factura, metodo_pago, efectivo, cambio, id_cliente) VALUES (?,?,?,?,?,?)";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != null) {
                $stms->bindParam(1, $dato['id_usuario'], PDO::PARAM_INT);
                $stms->bindParam(2, $dato['total_factura'], PDO::PARAM_INT);
                $stms->bindParam(3, $dato['metodo_pago'], PDO::PARAM_STR);
                $stms->bindParam(4, $dato['efectivo'], PDO::PARAM_INT);
                $stms->bindParam(5, $dato['cambio'], PDO::PARAM_INT);
                $stms->bindParam(6, $dato['id_cliente'], PDO::PARAM_INT);
            }
            if ($stms->execute()) {
                return true;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function mostrarUltimoId()
    {
        $sql = "SELECT MAX(id_factura) FROM $this->tabla";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function mostrarFacturaVentaModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_factura = ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($id != null) {
                $stms->bindParam(1, $id, PDO::PARAM_STR);
            }
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }


    }

    function listarFacturaClienteModelo($dato)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        if ($dato != null) {
            $sql = "SELECT * FROM $this->tabla INNER JOIN cliente ON cliente.id_cliente = factura.id_cliente WHERE cliente.numero_cedula = ? AND fecha_factura like ?";
        } else {
            $sql = "SELECT * FROM $this->tabla INNER JOIN cliente ON cliente.id_cliente = factura.id_cliente WHERE fecha_factura like ?";
        }

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != null) {
                $fecha = $dato['fecha'] . "%";
                $stms->bindParam(1, $dato['cc'], PDO::PARAM_STR);
                $stms->bindParam(2, $fecha, PDO::PARAM_STR);
            } else {
                $fechaActal = $fechaActal . "%";
                $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
            }
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