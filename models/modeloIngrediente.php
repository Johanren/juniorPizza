<?php

class ModeloIngrediente
{
    public $tabla = "ingrediente";

    function agregarIngredienteModelo($nom_ingre, $id_medida, $cant, $id_local)
    {
        $sql = "INSERT INTO $this->tabla (nombre_ingrediente, id_medida, cantidad, id_local) VALUES (?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($cant != '') {
            $stms->bindParam(1, $nom_ingre, PDO::PARAM_STR);
            $stms->bindParam(2, $id_medida, PDO::PARAM_INT);
            $stms->bindParam(3, $cant, PDO::PARAM_INT);
            $stms->bindParam(4, $id_local, PDO::PARAM_INT);
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

    function listarIngredinteModelo()
    {
        if ($_SESSION['rol'] == "Administrador") {
            $sql = "SELECT * FROM $this->tabla INNER JOIN medida ON medida.id_medida = ingrediente.id_medida";
        } else {
            $id = $_SESSION['id_local'];
            $sql = "SELECT * FROM $this->tabla INNER JOIN medida ON medida.id_medida = ingrediente.id_medida WHERE id_local = $id";
        }
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

    function consultarIngredeinteAjaxModelo($dato)
    {
        if ($dato != '') {
            $dato = '%' . $dato . '%';
            $sql = "SELECT * FROM $this->tabla INNER JOIN medida ON medida.id_medida = ingrediente.id_medida INNER JOIN local ON local.id_local = ingrediente.id_local WHERE nombre_ingrediente like ? ORDER BY id_ingrediente";
        } else {
            $sql = "SELECT * FROM $this->tabla INNER JOIN medida ON medida.id_medida = ingrediente.id_medida INNER JOIN local ON local.id_local = ingrediente.id_local ORDER BY id_ingrediente";
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

    function mostrarIngredienteModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla  WHERE id_ingrediente = ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($id != null) {
                $stms->bindParam(1, $id, PDO::PARAM_INT);
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

    function actualizarIngredienteFacturaModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET cantidad=? WHERE id_ingrediente=?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != null) {
                $stms->bindParam(1, $dato['cantidad'], PDO::PARAM_INT);
                $stms->bindParam(2, $dato['id_ingrediente'], PDO::PARAM_INT);
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

    function actualizarIngredienteModelo($id, $nom_ingre, $id_medida, $cant, $id_local)
    {
        $sql = "UPDATE $this->tabla SET nombre_ingrediente=?,id_medida=?,cantidad=?,id_local=? WHERE id_ingrediente=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($cant != '') {
            $stms->bindParam(1, $nom_ingre, PDO::PARAM_STR);
            $stms->bindParam(2, $id_medida, PDO::PARAM_INT);
            $stms->bindParam(3, $cant, PDO::PARAM_INT);
            $stms->bindParam(4, $id_local, PDO::PARAM_INT);
            $stms->bindParam(5, $id, PDO::PARAM_INT);
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