<?php

class ModeloFacturaProeevedor
{
    public $tabla = "factura_proeevedor";

    function agregarFacturaModelo($id_categoria, $id_proeevedor, $id_usuario, $id_medida, $codigo, $nombre, $precio, $cantidad, $id_local, $totalFactura, $precioUnita, $total)
    {
        $sql = "INSERT INTO $this->tabla (id_categoria, id_proeevedor, id_usuario, id_medida, codigo_producto, nombre_producto, precio_unitario, cantidad_producto, id_local, pago_factura, unitario, total) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($id_categoria != '') {
            $stms->bindParam(1, $id_categoria, PDO::PARAM_INT);
            $stms->bindParam(2, $id_proeevedor, PDO::PARAM_INT);
            $stms->bindParam(3, $id_usuario, PDO::PARAM_INT);
            $stms->bindParam(4, $id_medida, PDO::PARAM_INT);
            $stms->bindParam(5, $codigo, PDO::PARAM_INT);
            $stms->bindParam(6, $nombre, PDO::PARAM_STR);
            $stms->bindParam(7, $precio, PDO::PARAM_INT);
            $stms->bindParam(8, $cantidad, PDO::PARAM_INT);
            $stms->bindParam(9, $id_local, PDO::PARAM_INT);
            $stms->bindParam(10, $totalFactura, PDO::PARAM_INT);
            $stms->bindParam(11, $precioUnita, PDO::PARAM_INT);
            $stms->bindParam(12, $total, PDO::PARAM_INT);
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

    function listarProeevedorFacturaModelo($fecha)
    {
        date_default_timezone_set('America/Mexico_City');
        if ($fecha != null) {
            $fechaActal = $fecha;
        } else {
            $fechaActal = date('Y-m-d');
        }
        if ($_SESSION['rol'] == "Administrador") {
            $sql = "SELECT DISTINCT factura_proeevedor.pago_factura, factura_proeevedor.id_proeevedor, proeevedor.nit_proeevedor, proeevedor.nombre_proeevedor, factura_proeevedor.fecha_ingreso, proeevedor.id_local FROM $this->tabla INNER JOIN proeevedor ON proeevedor.id_proeevedor = factura_proeevedor.id_proeevedor WHERE factura_proeevedor.fecha_ingreso = ?";
        } else {
            $sql = "SELECT DISTINCT factura_proeevedor.id_proeevedor, proeevedor.nit_proeevedor, proeevedor.nombre_proeevedor, factura_proeevedor.fecha_ingreso, proeevedor.id_local FROM $this->tabla INNER JOIN proeevedor ON proeevedor.id_proeevedor = factura_proeevedor.id_proeevedor WHERE factura_proeevedor.fecha_ingreso = ? AND proeevedor.id_local = ?";
        }

        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($_SESSION['rol'] == "Administrador") {
            $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
        } else {
            $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
            $stms->bindParam(2, $_SESSION['id_local'], PDO::PARAM_STR);
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

    function listarFacturaProductoModelo($id, $fecha)
    {
        date_default_timezone_set('America/Mexico_City');
        if ($fecha != null) {
            $fechaActal = $fecha;
        } else {
            $fechaActal = date('Y-m-d');
        }
        if ($_SESSION['rol'] == "Administrador") {
            $sql = "SELECT * FROM $this->tabla INNER JOIN medida ON medida.id_medida = factura_proeevedor.id_medida INNER JOIN categoria ON categoria.id_categoria = factura_proeevedor.id_categoria INNER JOIN proeevedor ON proeevedor.id_proeevedor = factura_proeevedor.id_proeevedor WHERE factura_proeevedor.fecha_ingreso = ? AND proeevedor.id_proeevedor = ?";
        } else {
            $sql = "SELECT * FROM $this->tabla INNER JOIN medida ON medida.id_medida = factura_proeevedor.id_medida INNER JOIN categoria ON categoria.id_categoria = factura_proeevedor.id_categoria INNER JOIN proeevedor ON proeevedor.id_proeevedor = factura_proeevedor.id_proeevedor WHERE factura_proeevedor.fecha_ingreso = ? AND proeevedor.id_proeevedor AND proeevedor.id_local = ?";
        }

        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($_SESSION['rol'] == "Administrador") {
            $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
            $stms->bindParam(2, $id, PDO::PARAM_STR);
        } else {
            $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
            $stms->bindParam(2, $id, PDO::PARAM_STR);
            $stms->bindParam(3, $_SESSION['id_local'], PDO::PARAM_STR);
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

    function DeudaProeevedorModelo()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        $fechaActal = $fechaActal . "%";
        $sql = "SELECT CONCAT('$', FORMAT(SUM(DISTINCT(pago_factura)), '$#,##0.00')),SUM(DISTINCT(pago_factura)) FROM $this->tabla WHERE fecha_ingreso like ?";
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
}