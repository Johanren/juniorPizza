<?php

class ModeloProeevedor
{
    public $tabla = "proeevedor";
    function agregarProeevedorModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (nit_proeevedor, nombre_proeevedor, telefono_proeevedor, direccion_proeevedor, id_local) VALUES (?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['nit'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['proe'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['tel'], PDO::PARAM_INT);
            $stms->bindParam(4, $dato['dire'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['id_local'], PDO::PARAM_INT);
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

    function listarProeevedorModelo(){
        $sql = "SELECT * FROM $this->tabla INNER JOIN local ON local.id_local = proeevedor.id_local";
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