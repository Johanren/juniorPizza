<?php

class ModeloUsuario
{
    public $tabla = "usuario";

    function ModeloLoginIngresar($dato)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN rol ON rol.id_rol = usuario.id_rol INNER JOIN activo ON activo.id_activo = usuario.id_activo WHERE usuario = ? AND clave = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['user'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['clave'], PDO::PARAM_STR);
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
    function agregarUsuarioModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, usuario, clave, id_rol, id_activo, id_local) VALUES (?,?,?,?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['priNombre'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['segNombre'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['priApellido'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['segApellido'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['user'], PDO::PARAM_STR);
            $stms->bindParam(6, $dato['clave'], PDO::PARAM_STR);
            $stms->bindParam(7, $dato['rol'], PDO::PARAM_INT);
            $stms->bindParam(8, $dato['activo'], PDO::PARAM_INT);
            $stms->bindParam(9, $dato['local'], PDO::PARAM_INT);
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

    function listarModeloUsuario()
    {
        if ($_SESSION['rol'] == "Administrador") {
            $sql = "SELECT * FROM $this->tabla INNER JOIN rol ON rol.id_rol = usuario.id_rol INNER JOIN activo ON activo.id_activo = usuario.id_activo INNER JOIN local ON local.id_local = usuario.id_local";
        } else {
            $sql = "SELECT * FROM $this->tabla INNER JOIN rol ON rol.id_rol = usuario.id_rol INNER JOIN activo ON activo.id_activo = usuario.id_activo INNER JOIN local ON local.id_local = usuario.id_local WHERE local.id_local = ?";
        }
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($_SESSION['rol'] == "Administrador") {

        } else {
            $stms->bindParam(1, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function consultarUsuarioPerfilModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN rol ON rol.id_rol = usuario.id_rol INNER JOIN activo ON activo.id_activo = usuario.id_activo INNER JOIN local ON local.id_local = usuario.id_local WHERE id_usuario = ?";
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

    function listarUsuarioNominaModelo()
    {
        if ($_SESSION['rol'] == "Administrador") {
            $sql = "SELECT * FROM $this->tabla INNER JOIN rol ON rol.id_rol = usuario.id_rol INNER JOIN activo ON activo.id_activo = usuario.id_activo INNER JOIN local ON local.id_local = usuario.id_local";
        } else {
            $sql = "SELECT * FROM $this->tabla INNER JOIN rol ON rol.id_rol = usuario.id_rol INNER JOIN activo ON activo.id_activo = usuario.id_activo INNER JOIN local ON local.id_local = usuario.id_local WHERE local.id_local = ?";
        }
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($_SESSION['rol'] == "Administrador") {

        } else {
            $stms->bindParam(1, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function listarUsuarioIdModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN rol ON rol.id_rol = usuario.id_rol INNER JOIN activo ON activo.id_activo = usuario.id_activo INNER JOIN local ON local.id_local = usuario.id_local WHERE id_usuario = ?";
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

    function actualizarUsuarioModelo($dato){
        $sql = "UPDATE $this->tabla SET primer_nombre=?,segundo_nombre=?,primer_apellido=?,segundo_apellido=?,usuario=?,clave=?,id_rol=?,id_activo=?,id_local= ? WHERE id_usuario = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['priNombre'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['segNombre'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['priApellido'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['segApellido'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['user'], PDO::PARAM_STR);
            $stms->bindParam(6, $dato['clave'], PDO::PARAM_STR);
            $stms->bindParam(7, $dato['rol'], PDO::PARAM_INT);
            $stms->bindParam(8, $dato['activo'], PDO::PARAM_INT);
            $stms->bindParam(9, $dato['local'], PDO::PARAM_INT);
            $stms->bindParam(10, $dato['id'], PDO::PARAM_INT);
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