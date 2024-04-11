<?php

class ModeloPedido
{
    public $tabla = "pedido";
    function agregarPedidoModelo($id_mesa, $id_producto, $producto, $descripcion, $cantidad, $id_esatdo, $id_usuario)
    {
        $sql = "INSERT INTO $this->tabla (id_mesa, id_producto, producto, descripcion, cantidad, id_estado_mesa, id_usuario) VALUES (?,?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($id_producto != '') {
            $stms->bindParam(1, $id_mesa, PDO::PARAM_INT);
            $stms->bindParam(2, $id_producto, PDO::PARAM_INT);
            $stms->bindParam(3, $producto, PDO::PARAM_STR);
            $stms->bindParam(4, $descripcion, PDO::PARAM_STR);
            $stms->bindParam(5, $cantidad, PDO::PARAM_INT);
            $stms->bindParam(6, $id_esatdo, PDO::PARAM_INT);
            $stms->bindParam(7, $id_usuario, PDO::PARAM_INT);
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

    function listarPedidoMesa()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        $sql = "SELECT DISTINCT mesa.id_mesa, mesa.nombre_mesa, usuario.primer_nombre, usuario.primer_apellido, pedido.fecha_ingreso, estado_mesa.nombre_estado FROM $this->tabla INNER JOIN mesa ON mesa.id_mesa = pedido.id_mesa INNER JOIN usuario ON usuario.id_usuario = pedido.id_usuario INNER JOIN estado_mesa ON estado_mesa.id_estado_mesa = pedido.id_estado_mesa WHERE pedido.fecha_ingreso like ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $fechaActal = "%" . $fechaActal . "%";
        $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
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

    function listarPedidoMesaDescripcionModelo($id, $fecha)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN mesa ON mesa.id_mesa = pedido.id_mesa INNER JOIN usuario ON usuario.id_usuario = pedido.id_usuario INNER JOIN estado_mesa ON estado_mesa.id_estado_mesa = pedido.id_estado_mesa WHERE pedido.id_mesa = ? AND pedido.fecha_ingreso = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id, PDO::PARAM_INT);
        $stms->bindParam(2, $fecha, PDO::PARAM_STR);
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