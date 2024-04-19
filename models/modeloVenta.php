<?php

class ModeloVenta{
    public $tabla = "venta";
    function agregarVentaModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (id_factura, id_usuario, id_producto, peso, cantidad, valor_unitario, precio_compra) VALUES (?,?,?,?,?,?,?)";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != null) {
                $stms->bindParam(1, $dato['id_factura'], PDO::PARAM_INT);
                $stms->bindParam(2, $dato['id_usuario'], PDO::PARAM_INT);
                $stms->bindParam(3, $dato['id_articulo'], PDO::PARAM_INT);
                $stms->bindParam(4, $dato['peso'], PDO::PARAM_INT);
                $stms->bindParam(5, $dato['cantidad'], PDO::PARAM_INT);
                $stms->bindParam(6, $dato['valor_unitario'], PDO::PARAM_INT);
                $stms->bindParam(7, $dato['precio_compra'], PDO::PARAM_INT);
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

    function mostrarFacturaVentaModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN factura ON factura.id_factura = venta.id_factura INNER JOIN producto ON producto.id_producto = venta.id_producto INNER JOIN usuario ON usuario.id_usuario = venta.id_usuario INNER JOIN cliente ON cliente.id_cliente = factura.id_cliente WHERE venta.id_factura = ?";

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

    function consultarVentaDia($fecha)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');

        if ($fecha != null) {
            $sql = "SELECT DISTINCT(producto.id_producto),fecha_ingreso, producto.nombre_producto, valor_unitario FROM $this->tabla INNER JOIN producto ON producto.id_producto = venta.id_producto WHERE fecha_ingreso like ?";
        } else {
            $sql = "SELECT DISTINCT(producto.id_producto),fecha_ingreso, producto.nombre_producto, valor_unitario FROM $this->tabla INNER JOIN producto ON producto.id_producto = venta.id_producto WHERE fecha_ingreso like ?";
        }

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($fecha != null) {
                $fecha = $fecha."%";
                $stms->bindParam(1, $fecha, PDO::PARAM_STR);
            } else {
                $fechaActal = $fechaActal."%";
                $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
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

    function consultarVentaTotalDia($fecha){
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');

        if ($fecha != null) {
            $sql = "SELECT SUM(precio_compra) FROM $this->tabla WHERE fecha_ingreso like ?";
        } else {
            $sql = "SELECT SUM(precio_compra) FROM $this->tabla WHERE fecha_ingreso like ?";
        }

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($fecha != null) {
                $fecha = $fecha."%";
                $stms->bindParam(1, $fecha, PDO::PARAM_STR);
            } else {
                $fechaActal = $fechaActal."%";
                $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
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

    function consultarVentaDiaCantidadTotalModelo($id, $fecha)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');

        if ($fecha != null) {
            $sql = "SELECT SUM(cantidad), SUM(precio_compra), SUM(peso) FROM $this->tabla WHERE id_producto = ? AND fecha_ingreso like ?";
        } else {
            $sql = "SELECT SUM(cantidad), SUM(precio_compra), SUM(peso) FROM $this->tabla WHERE id_producto = ? AND fecha_ingreso like ?";
        }

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($fecha != null) {
                $fecha = $fecha."%";
                $stms->bindParam(1, $id, PDO::PARAM_INT);
                $stms->bindParam(2, $fecha, PDO::PARAM_STR);
            } else {
                $fechaActal = $fechaActal."%";
                $stms->bindParam(1, $id, PDO::PARAM_INT);
                $stms->bindParam(2, $fechaActal, PDO::PARAM_STR);
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
}