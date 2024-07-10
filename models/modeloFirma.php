<?php

class ModeloFirma
{
    public $tabla = "firmas";
    function agregarFirmaOrdenTrabajoModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (firmaCliente, firmaTecnico, firmaVehiculo, id_cliente_taller) VALUES (?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['clinte'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['tecnico'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['entrega'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['id'], PDO::PARAM_INT);
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

    function actualizarFirmaOrdenTrabajoModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET firmaCliente=?,firmaTecnico=?,firmaVehiculo=? WHERE id_cliente_taller = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['clinte'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['tecnico'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['entrega'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['id'], PDO::PARAM_INT);
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
