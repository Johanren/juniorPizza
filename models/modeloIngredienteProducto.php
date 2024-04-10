<?php

class ModeloIngredienteProducto
{
    public $tabla = "ingrediente_producto";
    function agregarIngredienteProductoModelo($id_producto, $id_ingre, $cantidad)
    {
        $sql = "INSERT INTO $this->tabla (id_producto, id_ingrediente, cantidad) VALUES (?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($cantidad != '') {
            $stms->bindParam(1, $id_producto, PDO::PARAM_INT);
            $stms->bindParam(2, $id_ingre, PDO::PARAM_INT);
            $stms->bindParam(3, $cantidad, PDO::PARAM_INT);
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

    function listarIngredinteProductoIdModelo()
    {
        $sql = "SELECT DISTINCT ingrediente_producto.id_producto, producto.nombre_producto FROM $this->tabla INNER JOIN producto ON producto.id_producto = ingrediente_producto.id_producto";
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

    function listarIngredinteProductoModelo($id){
        $sql = "SELECT GROUP_CONCAT(nombre_ingrediente SEPARATOR ', ') FROM $this->tabla INNER JOIN producto ON producto.id_producto = ingrediente_producto.id_producto INNER JOIN ingrediente ON ingrediente.id_ingrediente = ingrediente_producto.id_ingrediente WHERE ingrediente_producto.id_producto = ?";
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