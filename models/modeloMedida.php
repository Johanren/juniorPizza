<?php

class ModeloMedida{
    public $tabla = "medida";
    function agregarMeedidaModelo($dato){
        $sql = "INSERT INTO $this->tabla (nombre_medida, id_activo) VALUES (?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['med'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['activo'], PDO::PARAM_INT);
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

    function listarMedidaaModelo(){
        $sql = "SELECT * FROM $this->tabla INNER JOIN activo ON activo.id_activo = medida.id_activo";
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