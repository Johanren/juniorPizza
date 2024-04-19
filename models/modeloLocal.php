<?php

class ModeloLocal
{
    public $tabla = "local";
    function agregarLocalModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (nombre_local, nit, direccion, telefono) VALUES (?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['local'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['nit'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['dire'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['tel'], PDO::PARAM_STR);
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

    function listarModeloModelo()
    {
        $sql = "SELECT * FROM $this->tabla";
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

    function consultarLocalModelo($id){

        $sql = "SELECT * FROM $this->tabla WHERE id_local = ?";
        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($id != '') {
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

    function consultarModeloAjaxModelo($dato)
    {
        if ($dato != '') {
            $dato = '%' . $dato . '%';
            $sql = "SELECT * FROM $this->tabla WHERE nombre_local like ? ORDER BY id_local ";
        } else {
            $sql = "SELECT * FROM $this->tabla ORDER BY id_local";
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