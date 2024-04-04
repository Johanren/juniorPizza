<?php

 class ModeloActivo{
    public $tabla = "activo";
    function lsitarActivoModelo()
    {
        $sql = "SELECT * FROM $this->tabla";
        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
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