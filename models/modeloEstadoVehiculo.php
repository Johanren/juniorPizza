<?php

class ModeloEstadoVehiculo
{
    public $tabla = "estado_vehiculo";
    function agregarEstadoVehiculoOrdenTrabajoModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (grasa, aceite, desvare, electrico, llantas, lavado, freno, suspencion, motor, muelles, pintura, diferencial, direccion, vidrio, tapizado, luces, soldadura, caja, descripcion, observacion, id_cliente_taller) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['grasa'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['aceite'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['desvare'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['electrico'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['llantas'], PDO::PARAM_STR);
            $stms->bindParam(6, $dato['lavado'], PDO::PARAM_STR);
            $stms->bindParam(7, $dato['frenos'], PDO::PARAM_STR);
            $stms->bindParam(8, $dato['supencion'], PDO::PARAM_STR);
            $stms->bindParam(9, $dato['motor'], PDO::PARAM_STR);
            $stms->bindParam(10, $dato['muelles'], PDO::PARAM_STR);
            $stms->bindParam(11, $dato['pintura'], PDO::PARAM_STR);
            $stms->bindParam(12, $dato['diferencial'], PDO::PARAM_STR);
            $stms->bindParam(13, $dato['direccion'], PDO::PARAM_STR);
            $stms->bindParam(14, $dato['vidrios'], PDO::PARAM_STR);
            $stms->bindParam(15, $dato['tapizado'], PDO::PARAM_STR);
            $stms->bindParam(16, $dato['luces'], PDO::PARAM_STR);
            $stms->bindParam(17, $dato['soldadura'], PDO::PARAM_STR);
            $stms->bindParam(18, $dato['caja'], PDO::PARAM_STR);
            $stms->bindParam(19, $dato['descripcion'], PDO::PARAM_STR);
            $stms->bindParam(20, $dato['pendienevehiculo'], PDO::PARAM_STR);
            $stms->bindParam(21, $dato['id'], PDO::PARAM_INT);
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

    function actualizarEstadoVehiculoOrdenTrabajoModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET grasa=?,aceite=?,desvare=?,electrico=?,llantas=?,lavado=?,freno=?,suspencion=?,motor=?,muelles=?,pintura=?,diferencial=?,direccion=?,vidrio=?,tapizado=?,luces=?,soldadura=?,caja=?,descripcion=?,observacion=? WHERE id_cliente_taller = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['grasa'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['aceite'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['desvare'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['electrico'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['llantas'], PDO::PARAM_STR);
            $stms->bindParam(6, $dato['lavado'], PDO::PARAM_STR);
            $stms->bindParam(7, $dato['frenos'], PDO::PARAM_STR);
            $stms->bindParam(8, $dato['supencion'], PDO::PARAM_STR);
            $stms->bindParam(9, $dato['motor'], PDO::PARAM_STR);
            $stms->bindParam(10, $dato['muelles'], PDO::PARAM_STR);
            $stms->bindParam(11, $dato['pintura'], PDO::PARAM_STR);
            $stms->bindParam(12, $dato['diferencial'], PDO::PARAM_STR);
            $stms->bindParam(13, $dato['direccion'], PDO::PARAM_STR);
            $stms->bindParam(14, $dato['vidrios'], PDO::PARAM_STR);
            $stms->bindParam(15, $dato['tapizado'], PDO::PARAM_STR);
            $stms->bindParam(16, $dato['luces'], PDO::PARAM_STR);
            $stms->bindParam(17, $dato['soldadura'], PDO::PARAM_STR);
            $stms->bindParam(18, $dato['caja'], PDO::PARAM_STR);
            $stms->bindParam(19, $dato['descripcion'], PDO::PARAM_STR);
            $stms->bindParam(20, $dato['pendienevehiculo'], PDO::PARAM_STR);
            $stms->bindParam(21, $dato['id'], PDO::PARAM_INT);
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
