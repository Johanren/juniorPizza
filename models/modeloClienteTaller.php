<?php

class ModeloClienteTaller
{
    public $tabla = "cliente_taller";
    function agregarOrdenTrabajoClienteModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (nombre_cliente, nombre_empresa, telefono_cliente, recibido) VALUES (?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['nombreCliente'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['nombreempresa'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['telefonoCliente'], PDO::PARAM_INT);
            $stms->bindParam(4, $dato['recibidoPor'], PDO::PARAM_STR);
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

    function mostrarUltimoId()
    {
        $sql = "SELECT MAX(id_cliente_taller) FROM $this->tabla";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function actualizarOrdenTrabajoClienteModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET nombre_cliente=?,nombre_empresa=?,telefono_cliente=?,recibido=?,fecha_salida=? WHERE id_cliente_taller = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['nombreCliente'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['nombreempresa'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['telefonoCliente'], PDO::PARAM_INT);
            $stms->bindParam(4, $dato['recibidoPor'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['fechaSalida'], PDO::PARAM_STR);
            $stms->bindParam(6, $dato['id'], PDO::PARAM_STR);
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
