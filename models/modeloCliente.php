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
            $stms->bindParam(7, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function listarModeloCliente()
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN local ON local.id_local = cliente.id_local WHERE cliente.id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function consultarClienteAjaxModelo($dato)
    {
        if ($dato != '') {
            $sql = "SELECT * FROM $this->tabla WHERE numero_cc like '%$dato%' AND id_local = ? ORDER BY id_cliente";
        } else {
            $sql = "SELECT * FROM $this->tabla WHERE id_local = ? ORDER BY id_cliente";
        }

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            $stms->bindParam(1, $_SESSION['id_local'], PDO::PARAM_INT);
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return [];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function mostrarClienteFacturaVentaModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_cliente = ? AND = id_local = ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($id != null) {
                $stms->bindParam(1, $id, PDO::PARAM_INT);
                $stms->bindParam(2, $_SESSION['id_local'], PDO::PARAM_INT);
            }
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function actualizarClienteModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET primer_nombre=?,segundo_nombre=?,primer_apellido=?,segundo_apellido=?,numero_cc=?,correo=?,id_local=? WHERE id_cliente=? AND id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['priNombre'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['segNombre'], PDO::PARAM_STR);
            $stms->bindParam(3, $dato['priApellido'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['segApellido'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['cc'], PDO::PARAM_STR);
            $stms->bindParam(6, $dato['email'], PDO::PARAM_STR);
            $stms->bindParam(7, $_SESSION['id_local'], PDO::PARAM_INT);
            $stms->bindParam(8, $dato['id'], PDO::PARAM_INT);
            $stms->bindParam(9, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function consumidorFinalCompraModelo()
    {
        $sql = "SELECT * FROM $this->tabla WHERE numero_cc LIKE '1111%' AND id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $_SESSION['id_local'], PDO::PARAM_INT);
        try {
            if ($stms->execute()) {
                return $stms->fetchAll();;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function eliminarClienteIdModelo($id)
    {
        $sql = "SET FOREIGN_KEY_CHECKS=1";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($stms->execute()) {
                $sql = "DELETE FROM $this->tabla WHERE id_cliente = ? AND id_local = ?";

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
}
