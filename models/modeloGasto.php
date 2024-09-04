<?php

class ModeloGasto
{
    public $tabla = "gasto";

    function agregarGastoModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (nombre_gasto, total, descripcion,id_local) VALUES (?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['gasto'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['total'], PDO::PARAM_INT);
            $stms->bindParam(3, $dato['descripcion'], PDO::PARAM_STR);
            $stms->bindParam(4, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function listarGastoModelo($dato)
    {
        $dato = $dato . "%";
        $sql = "SELECT * FROM $this->tabla WHERE fecha_ingreso like ? AND id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $dato, PDO::PARAM_STR);
        $stms->bindParam(2, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function listarGastoIdModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_gasto = ? AND id_local=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id, PDO::PARAM_INT);
        $stms->bindParam(2, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function actualizarGastoModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET nombre_gasto=?,total=?,descripcion=? WHERE id_gasto=? AND id_local=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['gasto'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['total'], PDO::PARAM_INT);
            $stms->bindParam(3, $dato['descripcion'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['id'], PDO::PARAM_INT);
            $stms->bindParam(5, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function TotalGastoModelo($dato)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        $fechaActal = $fechaActal . "%";
        $sql = "SELECT CONCAT('$', FORMAT(SUM(total), '$#,##0.00')),SUM(total) FROM $this->tabla WHERE fecha_ingreso like ? AND id_local = ?";
        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != '') {
                $dato = $dato . "%";
                $stms->bindParam(1, $dato, PDO::PARAM_STR);
                $stms->bindParam(2, $_SESSION['id_local'], PDO::PARAM_INT);
            } else {
                $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
                $stms->bindParam(2, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function eliminarGastoIdModelo($id)
    {
        $sql = "SET FOREIGN_KEY_CHECKS=1";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($stms->execute()) {
                $sql = "DELETE FROM $this->tabla WHERE id_gasto = ? AND id_local = ?";

                try {
                    $conn = new Conexion();
                    $stms = $conn->conectar()->prepare($sql);
                    $stms->bindParam(1, $id, PDO::PARAM_INT);
                    $stms->bindParam(2, $_SESSION['id_local'], PDO::PARAM_INT);
                    if ($stms->execute()) {
                        return true;
                    } else {
                        return false;
                    }
                } catch (PDOException $e) {
                    print_r($e->getMessage());
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function gastosMensualesModelo()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m');
        $fechaActal = $fechaActal . "%";
        $sql = "SELECT CONCAT('$', FORMAT(SUM(total), '$#,##0.00')) FROM $this->tabla WHERE fecha_ingreso like ? AND id_local = ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
            $stms->bindParam(2, $_SESSION['id_local'], PDO::PARAM_INT);
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function gastosAnuealesModelo()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y');
        $fechaActal = $fechaActal . "%";
        $sql = "SELECT CONCAT('$', FORMAT(SUM(total), '$#,##0.00')) FROM $this->tabla WHERE fecha_ingreso like ? AND id_local = ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
            $stms->bindParam(2, $_SESSION['id_local'], PDO::PARAM_INT);
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function listarPorMesModelo()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y');
        $fechaActal = $fechaActal . "%";
        $sql = "SELECT SUM(total) AS totalGasto, MONTHNAME(fecha_ingreso) AS mesGasto FROM gasto WHERE fecha_ingreso like ? AND id_local = ? GROUP BY MONTH(fecha_ingreso)";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
            $stms->bindParam(2, $_SESSION['id_local'], PDO::PARAM_INT);
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
