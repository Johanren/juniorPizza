<?php

class ModeloMateriales
{
    public $tabla = "material_vehiculo";
    function agregarMaterialesOrdenTrabajoModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (material, id_cliente_taller) VALUES (?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['materiales'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['id'], PDO::PARAM_INT);
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

    function listarMaterialesIdModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_cliente_taller = ?";
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

    function actualizarMaterialesOrdenTrabajoModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET material=? WHERE id_material_vehiculo = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['materiales'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['id'], PDO::PARAM_INT);
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
