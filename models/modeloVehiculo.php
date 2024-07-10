<?php

class ModeloVehiculo
{
    public $tabla = "vehiculo";
    function agregarVehiculoOrdenTrabajoModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (nivel_conbusible, estado_general, kilometraje, marca, placa, linea, id_cliente_taller) VALUES (?,?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['nivel'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['estado'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['kilometro'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['marca'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['placa'], PDO::PARAM_STR);
            $stms->bindParam(6, $dato['linea'], PDO::PARAM_STR);
            $stms->bindParam(7, $dato['id'], PDO::PARAM_INT);
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

    function listarOrdenTrabajoPlacaModelo($dato)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN cliente_taller ON cliente_taller.id_cliente_taller = vehiculo.id_cliente_taller WHERE placa like ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $dato = "%" . $dato . "%";
            $stms->bindParam(1, $dato, PDO::PARAM_STR);
        }
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

    function listarOrdenTrabajoPlacaIdModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN cliente_taller ON cliente_taller.id_cliente_taller = vehiculo.id_cliente_taller INNER JOIN estado_vehiculo ON estado_vehiculo.id_cliente_taller = cliente_taller.id_cliente_taller INNER JOIN firmas ON firmas.id_cliente_taller = cliente_taller.id_cliente_taller WHERE vehiculo.id_cliente_taller = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($id != '') {
            $stms->bindParam(1, $id, PDO::PARAM_INT);
        }
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

    function actualizarVehiculoOrdenTrabajoModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET nivel_conbusible=?,estado_general=?,kilometraje=?,marca=?,placa=?,linea=? WHERE id_cliente_taller = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['nivel'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['estado'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['kilometro'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['marca'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['placa'], PDO::PARAM_STR);
            $stms->bindParam(6, $dato['linea'], PDO::PARAM_STR);
            $stms->bindParam(7, $dato['id'], PDO::PARAM_INT);
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
