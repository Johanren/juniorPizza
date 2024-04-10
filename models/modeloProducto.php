<?php

class ModeloProducto
{
    public $tabla = "producto";
    function agregarProductoModelo($id_proeevedor, $codigo, $nombre, $precio, $cantidad, $id_categoria, $id_medida, $id_local)
    {
        $sql = "INSERT INTO $this->tabla (id_proeevedor, codigo_producto, nombre_producto, precio_unitario, cantidad_producto, id_categoria, id_medida, id_local) VALUES (?,?,?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($codigo != '') {
            $stms->bindParam(1, $id_proeevedor, PDO::PARAM_INT);
            $stms->bindParam(2, $codigo, PDO::PARAM_INT);
            $stms->bindParam(3, $nombre, PDO::PARAM_STR);
            $stms->bindParam(4, $precio, PDO::PARAM_INT);
            $stms->bindParam(5, $cantidad, PDO::PARAM_INT);
            $stms->bindParam(6, $id_categoria, PDO::PARAM_INT);
            $stms->bindParam(7, $id_medida, PDO::PARAM_INT);
            $stms->bindParam(8, $id_local, PDO::PARAM_INT);
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

    function listarProductoModelo()
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN proeevedor ON proeevedor.id_proeevedor = producto.id_proeevedor INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria INNER JOIN medida ON medida.id_medida = producto.id_medida INNER JOIN local ON local.id_local = producto.id_local";
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

    function consultarModeloProductoAjaxModelo($dato)
    {
        if ($dato != '') {
            $dato = '%' . $dato . '%';
            $sql = "SELECT * FROM $this->tabla WHERE nombre_producto like ? ORDER BY id_producto";
        } else {
            $sql = "SELECT * FROM $this->tabla ORDER BY id_producto";
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
}