<?php

class ModeloMesa{
    public $tabla = "mesa";
    function agregarMesaModelo($mesa, $estado, $piso){
        $sql = "INSERT INTO $this->tabla (nombre_mesa, id_estado_mesa, id_piso) VALUES (?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($mesa != '') {
            $stms->bindParam(1, $mesa, PDO::PARAM_STR);
            $stms->bindParam(2, $estado, PDO::PARAM_INT);
            $stms->bindParam(3, $piso, PDO::PARAM_INT);
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

    function listarMesaModelo(){
        $sql = "SELECT * FROM $this->tabla INNER JOIN estado_mesa ON estado_mesa.id_estado_mesa = mesa.id_estado_mesa INNER JOIN piso ON piso.id_piso = mesa.id_piso";
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

    function actualizarEstadoMesaModelo($id_mesa, $id_esatdo){
        $sql = "UPDATE $this->tabla SET id_estado_mesa = ? WHERE id_mesa = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($id_mesa != '') {
            $stms->bindParam(1, $id_esatdo, PDO::PARAM_INT);
            $stms->bindParam(2, $id_mesa, PDO::PARAM_INT);
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

    function buscarMesaIdModelo($id){
        $sql = "SELECT * FROM $this->tabla INNER JOIN estado_mesa ON estado_mesa.id_estado_mesa = mesa.id_estado_mesa";
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
}