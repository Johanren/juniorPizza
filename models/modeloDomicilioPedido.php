<?php

class ModeloDomicilioPedido
{
    public $tabla = "domiciliopedido";
    function agregarDomicilioPedidoModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (nombre, telefono1, telefono2, direccion, metodo_pago, id_local) VALUES (?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['nombre'], PDO::PARAM_STR);
            $stms->bindParam(2, $dato['tel1'], PDO::PARAM_INT);
            $stms->bindParam(3, $dato['tel2'], PDO::PARAM_INT);
            $stms->bindParam(4, $dato['dire'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['metodo'], PDO::PARAM_STR);
            $stms->bindParam(6, $dato['id_local'], PDO::PARAM_INT);
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

    function ultimoIDDomicilioPedido($dato)
    {
        $sql = "SELECT MAX(id_domicilio_pedido) FROM $this->tabla WHERE id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['id_local'], PDO::PARAM_INT);
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

    function listarDomicilioPedido($id)
    {
        $sql = "SELECT * FROM $this->tabla inner JOIN local ON local.id_local = domiciliopedido.id_local WHERE id_domicilio_pedido = ?";
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

    function listarDomicilioPedidoTabla()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        $sql = "SELECT DISTINCT domiciliopedido.id_domicilio_pedido, domiciliopedido.nombre, domiciliopedido.telefono1, domiciliopedido.telefono2, domiciliopedido.direccion, domiciliopedido.metodo_pago FROM $this->tabla INNER JOIN domicilio ON domicilio.id_domicilio_pedido = domiciliopedido.id_domicilio_pedido WHERE domicilio.entregado = 0 AND domicilio.p_cancelado = 0 AND domicilio.id_local = ? AND fecha_ingreso = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $_SESSION['id_local'], PDO::PARAM_INT);
        $stms->bindParam(2, $fechaActal, PDO::PARAM_STR);
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

    function listarPedidoPrintDomicilioAjaxModelo()
    {
        $sql = "SELECT MAX(id_domicilio_pedido) FROM domicilio WHERE print = 0 AND id_local = ?";
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

    function listarPedidoPirntFechaUsuarioDomicilioIngreso($id, $print)
    {
        $sql = "SELECT DISTINCT domiciliopedido.nombre,domiciliopedido.id_domicilio_pedido FROM `domicilio` INNER JOIN domiciliopedido ON domiciliopedido.id_domicilio_pedido = domicilio.id_domicilio_pedido WHERE domicilio.id_domicilio_pedido = ? AND print = ? AND domiciliopedido.id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id, PDO::PARAM_INT);
        $stms->bindParam(2, $print, PDO::PARAM_INT);
        $stms->bindParam(3, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function actualziarNotificación($id)
    {
        $sql = "UPDATE $this->tabla SET notificado = 1 WHERE id_domicilio_pedido = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id, PDO::PARAM_INT);
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
