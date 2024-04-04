<?php

class ModeloCliente
{
    public $tabla = 'cliente';

    function agregarClienteModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, numero_cc, correo, id_local) VALUES (?,?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['priNombre'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['segNombre'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['priApellido'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['segApellido'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['cc'], PDO::PARAM_STR);
            $stms->bindParam(6, $dato['email'], PDO::PARAM_STR);
            $stms->bindParam(7, $dato['local'], PDO::PARAM_INT);
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

    function listarModeloCliente(){
        $sql = "SELECT * FROM $this->tabla INNER JOIN local ON local.id_local = cliente.id_local";
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