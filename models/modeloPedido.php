<?php

class ModeloPedido
{
    public $tabla = "pedido";
    function agregarPedidoModelo($id_mesa, $id_producto, $producto, $descripcion, $cantidad, $id_esatdo, $id_usuario, $fechaActal)
    {
        $sql = "INSERT INTO $this->tabla (id_mesa, id_producto, producto, descripcion, cantidad, id_estado_mesa, id_usuario, fecha_ingreso,id_local) VALUES (?,?,?,?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($id_producto != '') {
            $stms->bindParam(1, $id_mesa, PDO::PARAM_INT);
            $stms->bindParam(2, $id_producto, PDO::PARAM_INT);
            $stms->bindParam(3, $producto, PDO::PARAM_STR);
            $stms->bindParam(4, $descripcion, PDO::PARAM_STR);
            $stms->bindParam(5, $cantidad, PDO::PARAM_INT);
            $stms->bindParam(6, $id_esatdo, PDO::PARAM_INT);
            $stms->bindParam(7, $id_usuario, PDO::PARAM_INT);
            $stms->bindParam(8, $fechaActal, PDO::PARAM_STR);
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

    function listarPedidoMesa()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        $sql = "SELECT DISTINCT mesa.id_mesa, mesa.nombre_mesa, usuario.primer_nombre, usuario.primer_apellido, pedido.fecha_ingreso, estado_mesa.nombre_estado, estado_mesa.id_estado_mesa FROM $this->tabla INNER JOIN mesa ON mesa.id_mesa = pedido.id_mesa INNER JOIN usuario ON usuario.id_usuario = pedido.id_usuario INNER JOIN estado_mesa ON estado_mesa.id_estado_mesa = pedido.id_estado_mesa WHERE pedido.fecha_ingreso like ? AND pago = 0 AND pedido.id_local = ? ORDER BY $this->tabla.fecha_ingreso DESC";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $fechaActal = "%" . $fechaActal . "%";
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

    function listarPedidoFacturaMesa()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        $sql = "SELECT DISTINCT mesa.id_mesa, mesa.nombre_mesa, usuario.primer_nombre, usuario.primer_apellido, estado_mesa.nombre_estado, estado_mesa.id_estado_mesa FROM $this->tabla INNER JOIN mesa ON mesa.id_mesa = pedido.id_mesa INNER JOIN usuario ON usuario.id_usuario = pedido.id_usuario INNER JOIN estado_mesa ON estado_mesa.id_estado_mesa = pedido.id_estado_mesa WHERE pedido.fecha_ingreso like ? AND pedido.id_estado_mesa = 4 AND pedido.pago = 0 AND pedido.id_local =? ORDER BY $this->tabla.fecha_ingreso DESC";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $fechaActal = "%" . $fechaActal . "%";
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

    function listarPedidoMesaDescripcionModelo($id, $fecha)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN mesa ON mesa.id_mesa = pedido.id_mesa INNER JOIN usuario ON usuario.id_usuario = pedido.id_usuario INNER JOIN estado_mesa ON estado_mesa.id_estado_mesa = pedido.id_estado_mesa WHERE pedido.id_mesa = ? AND pedido.fecha_ingreso = ? AND pago = 0 AND pedido.id_local=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id, PDO::PARAM_INT);
        $stms->bindParam(2, $fecha, PDO::PARAM_STR);
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

    function actualizarMesaPedido($id, $id_mesa)
    {
        $sql = "UPDATE $this->tabla SET id_mesa = ? WHERE id_mesa = ? AND id_local";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id_mesa, PDO::PARAM_INT);
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

    function actualizarMesaPedidoEstado($id, $id_mesa, $estado, $fecha)
    {
        $sql = "UPDATE $this->tabla SET id_mesa = ?, id_estado_mesa = ? WHERE id_mesa = ? AND fecha_ingreso = ? AND id_local=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $id_mesa, PDO::PARAM_INT);
        $stms->bindParam(2, $estado, PDO::PARAM_INT);
        $stms->bindParam(3, $id, PDO::PARAM_INT);
        $stms->bindParam(4, $fecha, PDO::PARAM_STR);
        $stms->bindParam(5, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function ListarMesaPedidoModelo($fecha)
    {
        $sql = "SELECT DISTINCT pedido.id_mesa, pedido.fecha_ingreso, mesa.nombre_mesa, usuario.primer_nombre, usuario.primer_apellido FROM $this->tabla INNER JOIN mesa ON mesa.id_mesa = pedido.id_mesa INNER JOIN usuario ON usuario.id_usuario = pedido.id_usuario WHERE fecha_ingreso LIKE ? AND cocina = 0 AND pedido.id_local ORDER BY fecha_ingreso DESC";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $fecha, PDO::PARAM_STR);
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

    function listarPedidoCocinaModelo($id, $fecha)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN mesa ON mesa.id_mesa = pedido.id_mesa INNER JOIN usuario ON usuario.id_usuario = pedido.id_usuario WHERE fecha_ingreso like ? AND pedido.id_mesa = ? AND cocina = 0 AND pedido.id_local=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $fecha, PDO::PARAM_STR);
        $stms->bindParam(2, $id, PDO::PARAM_INT);
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

    function actualizarPedidoPrintModelo($id, $fecha, $print)
    {
        $sql = "UPDATE $this->tabla SET print = ? WHERE fecha_ingreso = ? AND id_mesa = ? AND id_local=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $print, PDO::PARAM_INT);
        $stms->bindParam(2, $fecha, PDO::PARAM_STR);
        $stms->bindParam(3, $id, PDO::PARAM_INT);
        $stms->bindParam(4, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function actualizarPedidoCocinaModelo($id, $fecha, $cocina)
    {
        $sql = "UPDATE $this->tabla SET cocina = ? WHERE fecha_ingreso = ? AND id_mesa = ? AND = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $cocina, PDO::PARAM_INT);
        $stms->bindParam(2, $fecha, PDO::PARAM_STR);
        $stms->bindParam(3, $id, PDO::PARAM_INT);
        $stms->bindParam(4, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function listarMesaUsuarioIdModelo($id, $fecha)
    {
        $sql = "SELECT DISTINCT usuario.primer_nombre, usuario.primer_apellido, mesa.nombre_mesa FROM $this->tabla INNER JOIN mesa ON mesa.id_mesa = pedido.id_mesa INNER JOIN usuario ON usuario.id_usuario = pedido.id_usuario WHERE fecha_ingreso like ? AND pedido.id_mesa = ? AND cocina = 0 AND pedido.id_local=?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $fecha, PDO::PARAM_STR);
        $stms->bindParam(2, $id, PDO::PARAM_INT);
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

    function listarPedidoPrintAjaxModelo($print)
    {
        $sql = "SELECT MAX(fecha_ingreso), id_mesa FROM $this->tabla WHERE print = ? AND id_local = ?";
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

    function listarPedidoPrintActAjaxModelo($print, $id)
    {
        $sql = "SELECT MAX(fecha_ingreso), id_mesa FROM $this->tabla WHERE print = ? AND id_mesa = ? AND id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $print, PDO::PARAM_INT);
        $stms->bindParam(2, $id, PDO::PARAM_INT);
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

    function listarPedidoPirntFechaIngreso($fecha, $print)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN producto ON producto.id_producto = pedido.id_producto INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria WHERE fecha_ingreso = ? AND print = ? AND producto.id_local";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $fecha, PDO::PARAM_STR);
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

    function listarPedidoPirntFechaUsuarioIngreso($fecha, $print)
    {
        $sql = "SELECT DISTINCT usuario.primer_nombre, usuario.primer_apellido, mesa.nombre_mesa, mesa.id_mesa FROM $this->tabla INNER JOIN usuario ON usuario.id_usuario = pedido.id_usuario INNER JOIN mesa ON mesa.id_mesa = pedido.id_mesa WHERE fecha_ingreso = ? AND print = ? AND pedido.id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $fecha, PDO::PARAM_STR);
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

    function actualizarPedidoMesa($fecha, $print, $estadoMesa, $printNuero)
    {
        $sql = "UPDATE $this->tabla SET print = ?, id_estado_mesa = ? WHERE fecha_ingreso = ? AND print = ? AND id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $stms->bindParam(1, $printNuero, PDO::PARAM_INT);
        $stms->bindParam(2, $estadoMesa, PDO::PARAM_INT);
        $stms->bindParam(3, $fecha, PDO::PARAM_STR);
        $stms->bindParam(4, $print, PDO::PARAM_INT);
        $stms->bindParam(5, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function listarPedidoFacturaModelo($id)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        $sql = "SELECT * FROM $this->tabla INNER JOIN producto ON producto.id_producto = pedido.id_producto WHERE id_mesa = ? AND fecha_ingreso LIKE ? AND id_estado_mesa = 4 AND pago = 0 AND pedido.id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        $fechaActal = "%" . $fechaActal . "%";
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

    function actualizarPagoPedidoModelo($id, $fecha)
    {
        $sql = "UPDATE $this->tabla SET pago = 1 WHERE fecha_ingreso = ? AND id_producto = ? AND id_local = ?";
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