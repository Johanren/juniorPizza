<?php

class ModeloPromocion
{
    public $tabla = "promocion";
    function agregarPromocionModelo($id_producto, $id_prodcu, $cantidadPromocion, $id_activa)
    {
        $sql = "INSERT INTO $this->tabla (id_producto, id_promocion_articulo, cantidad_promocion_producto, id_activo) VALUES (?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($id_producto != '') {
            $stms->bindParam(1, $id_producto, PDO::PARAM_INT);
            $stms->bindParam(2, $id_prodcu, PDO::PARAM_INT);
            $stms->bindParam(3, $cantidadPromocion, PDO::PARAM_INT);
            $stms->bindParam(4, $id_activa, PDO::PARAM_INT);
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

    function listarPromocionId()
    {
        $sql = "SELECT DISTINCT promocion.id_producto, producto.nombre_producto, activo.nombre_activo FROM $this->tabla INNER JOIN producto ON producto.id_producto = promocion.id_producto INNER JOIN activo ON activo.id_activo = promocion.id_activo";
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

    function listarPromocionModelo($id)
    {
        $sql = "SELECT GROUP_CONCAT(nombre_producto SEPARATOR ', ') FROM $this->tabla INNER JOIN producto ON producto.id_producto = promocion.id_promocion_articulo WHERE promocion.id_producto = ?";
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

    function listarPromocionProductoFacturaModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN producto ON producto.id_producto = promocion.id_promocion_articulo WHERE promocion.id_producto = ?";
        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($id != null) {
                $stms->bindParam(1, $id, PDO::PARAM_INT);
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

    function actualizarPromocionModelo($id, $id_producto, $id_prodcu, $cantidadPromocion, $id_activa)
    {
        $sql = "UPDATE $this->tabla SET id_producto=?,id_promocion_articulo=?,cantidad_promocion_producto=?,id_activo=? WHERE id_promocion_articulo=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($id_producto != '') {
            $stms->bindParam(1, $id_producto, PDO::PARAM_INT);
            $stms->bindParam(2, $id_prodcu, PDO::PARAM_INT);
            $stms->bindParam(3, $cantidadPromocion, PDO::PARAM_INT);
            $stms->bindParam(4, $id_activa, PDO::PARAM_INT);
            $stms->bindParam(5, $id, PDO::PARAM_INT);
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