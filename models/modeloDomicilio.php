<?php

class ModeloDomicilio
{
    public $tabla = "domicilio";
    function agregarDomicilioModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (id_producto, id_domicilio_pedido, producto, descripcion, precio, cantidad, id_estado_mesa, print, cocina, pago, entregado, p_cancelado, id_local) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($dato != '') {
            $stms->bindParam(1, $dato['id_producto'], PDO::PARAM_INT);
            $stms->bindParam(2, $dato['id_domicilio_pedido'], PDO::PARAM_INT);
            $stms->bindParam(3, $dato['producto'], PDO::PARAM_STR);
            $stms->bindParam(4, $dato['des'], PDO::PARAM_STR);
            $stms->bindParam(5, $dato['precio'], PDO::PARAM_INT);
            $stms->bindParam(6, $dato['cant'], PDO::PARAM_INT);
            $stms->bindParam(7, $dato['id_estado'], PDO::PARAM_INT);
            $stms->bindParam(8, $dato['print'], PDO::PARAM_INT);
            $stms->bindParam(9, $dato['cocina'], PDO::PARAM_INT);
            $stms->bindParam(10, $dato['pago'], PDO::PARAM_INT);
            $stms->bindParam(11, $dato['entregado'], PDO::PARAM_INT);
            $stms->bindParam(12, $dato['cancelado'], PDO::PARAM_INT);
            $stms->bindParam(13, $dato['id_local'], PDO::PARAM_INT);
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

    function listarDomicilioPedido($id)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN estado_mesa ON estado_mesa.id_estado_mesa = domicilio.id_estado_mesa WHERE id_domicilio_pedido = ?";
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

    function cancelarPedidoDomicilioModelo($cancelado, $id)
    {
        $sql = "UPDATE $this->tabla SET p_cancelado = ? WHERE id_domicilio_pedido = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($id != '') {
            $stms->bindParam(1, $cancelado, PDO::PARAM_INT);
            $stms->bindParam(2, $id, PDO::PARAM_INT);
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
    function listarPedidoTablaModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN estado_mesa ON estado_mesa.id_estado_mesa = domicilio.id_estado_mesa WHERE id_domicilio_pedido = ?";
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

    function listarPedidoDomicilioPrintAjaxModelo($print)
    {
        $sql = "SELECT MAX(id_domicilio_pedido) FROM $this->tabla WHERE print = ? AND id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $print, PDO::PARAM_INT);
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

    function listarPedidoDomicilioPirntFechaIngreso($id, $print)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN producto ON producto.id_producto = domicilio.id_producto INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria WHERE id_domicilio_pedido = ? AND print = ? AND producto.id_local = ?";
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

    function ActualizarPedidoDomicilioAjaxModelo($estado, $printDomicilio, $time, $print, $id)
    {
        $sql = "UPDATE $this->tabla SET id_estado_mesa = ?, print = ?, time = ? WHERE id_domicilio_pedido = ? AND print = ? AND id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $estado, PDO::PARAM_INT);
        $stms->bindParam(2, $printDomicilio, PDO::PARAM_INT);
        $stms->bindParam(3, $time, PDO::PARAM_STR);
        $stms->bindParam(4, $id, PDO::PARAM_INT);
        $stms->bindParam(5, $print, PDO::PARAM_INT);
        $stms->bindParam(6, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function actualizarPrintDomicilio($id)
    {
        $sql = "UPDATE $this->tabla SET print = 0 WHERE id_domicilio_pedido = ?";
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

    function actualizarCanceDomicilio($id)
    {
        $sql = "UPDATE $this->tabla SET p_cancelado = 1 WHERE id_domicilio_pedido = ?";
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

    function actualizarLlevarDomicilio($id)
    {
        $sql = "UPDATE $this->tabla SET recogido = 1 WHERE id_domicilio_pedido = ?";
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

    function actualizarEntregaDomicilio($id)
    {
        $sql = "UPDATE $this->tabla SET entregado = 1, id_estado_mesa = 4, recogido = 0 WHERE id_domicilio_pedido = ?";
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

    function obtenerNuevosDomicilios($id)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN domiciliopedido ON domiciliopedido.id_domicilio_pedido = domicilio.id_domicilio_pedido WHERE domiciliopedido.id_local = ? AND domiciliopedido.id_domicilio_pedido > ? AND entregado = 0 AND p_cancelado = 0 AND notificado = 0 ORDER BY domiciliopedido.id_domicilio_pedido DESC";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $_SESSION['id_local'], PDO::PARAM_INT);
        $stms->bindParam(2, $id, PDO::PARAM_INT);
        try {
            if ($stms->execute()) {
                $resultados = $stms->fetchAll(PDO::FETCH_ASSOC);
                return $resultados ? $resultados : []; // Retornar un arreglo vacío si no hay resultados
            } else {
                return []; // Retornar un arreglo vacío si no se ejecuta correctamente
            }
        } catch (PDOException $e) {
            error_log("Error en obtenerNuevosDomicilios: " . $e->getMessage()); // Log del error
            return []; // Retornar un arreglo vacío en caso de error
        }
    }

    function listarDomicilioFacturaModelo()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        $sql = "SELECT DISTINCT domiciliopedido.id_domicilio_pedido, domiciliopedido.nombre FROM $this->tabla INNER JOIN domiciliopedido ON domiciliopedido.id_domicilio_pedido = domicilio.id_domicilio_pedido WHERE domicilio.fecha_ingreso = ? AND domicilio.pago = 0 AND domicilio.id_local = ? AND domicilio.p_cancelado = 0";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
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

    function listarPedidoDomicilioFacturaModelo($id)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        $sql = "SELECT * FROM $this->tabla INNER JOIN producto ON producto.id_producto = domicilio.id_producto WHERE domicilio.id_domicilio_pedido = ? AND domicilio.fecha_ingreso = ? AND pago = 0 AND domicilio.p_cancelado = 0 AND domicilio.id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id, PDO::PARAM_INT);
        $stms->bindParam(2, $fechaActal, PDO::PARAM_STR);
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

    function actualizarPagoPedidoDomicilioModelo($id, $fecha)
    {
        $sql = "UPDATE $this->tabla SET pago = 1 WHERE fecha_ingreso = ? AND id_domicilio_pedido = ? AND id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $fecha, PDO::PARAM_STR);
        $stms->bindParam(2, $id, PDO::PARAM_INT);
        $stms->bindParam(3, $_SESSION['id_local'], PDO::PARAM_INT);
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
