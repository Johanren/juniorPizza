<?php

class ModeloApertura
{
    public $tabla = "apertura";

    function agregarApeturaModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (monto, cierre) VALUES (?,?)";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != null) {
                $stms->bindParam(1, $dato['monto'], PDO::PARAM_INT);
                $stms->bindParam(2, $dato['cierre'], PDO::PARAM_STR);
            }
            if ($stms->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function consultarAperturaModelo()
    {
        $sql = "SELECT * FROM $this->tabla WHERE cierre = ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            $dato = "false";
            $stms->bindParam(1, $dato, PDO::PARAM_STR);
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function cerrarCajaModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET fecha_cierre=?,cierre=? WHERE id_apertura=?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != null) {
                $stms->bindParam(1, $dato['fecha_cierre'], PDO::PARAM_STR);
                $stms->bindParam(2, $dato['cierre'], PDO::PARAM_STR);
                $stms->bindParam(3, $dato['id_apertura'], PDO::PARAM_INT);
            }
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
