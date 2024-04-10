<?php

class ModeloIngrediente{
    public $tabla = "ingrediente";

    function agregarIngredienteModelo($nom_ingre, $id_medida, $cant){
        $sql = "INSERT INTO $this->tabla (nombre_ingrediente, id_medida, cantidad) VALUES (?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($cant != '') {
            $stms->bindParam(1, $nom_ingre, PDO::PARAM_STR);
            $stms->bindParam(2, $id_medida, PDO::PARAM_INT);
            $stms->bindParam(3, $cant, PDO::PARAM_INT);
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

    function listarIngredinteModelo(){
        $sql = "SELECT * FROM $this->tabla INNER JOIN medida ON medida.id_medida = ingrediente.id_medida";
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

    function consultarIngredeinteAjaxModelo($dato){
        if ($dato != '') {
            $dato = '%' . $dato . '%';
            $sql = "SELECT * FROM $this->tabla INNER JOIN medida ON medida.id_medida = ingrediente.id_medida WHERE nombre_ingrediente like ? ORDER BY id_ingrediente ";
        } else {
            $sql = "SELECT * FROM $this->tabla INNER JOIN medida ON medida.id_medida = ingrediente.id_medida ORDER BY id_ingrediente";
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