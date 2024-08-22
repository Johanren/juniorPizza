<?php

class ModeloVenta
{
    public $tabla = "venta";
    function agregarVentaModelo($dato)
    {
        $sql = "INSERT INTO $this->tabla (id_factura, id_usuario, id_producto, peso, cantidad, valor_unitario, precio_compra) VALUES (?,?,?,?,?,?,?)";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != null) {
                $stms->bindParam(1, $dato['id_factura'], PDO::PARAM_INT);
                $stms->bindParam(2, $dato['id_usuario'], PDO::PARAM_INT);
                $stms->bindParam(3, $dato['id_articulo'], PDO::PARAM_INT);
                $stms->bindParam(4, $dato['peso'], PDO::PARAM_INT);
                $stms->bindParam(5, $dato['cantidad'], PDO::PARAM_INT);
                $stms->bindParam(6, $dato['valor_unitario'], PDO::PARAM_INT);
                $stms->bindParam(7, $dato['precio_compra'], PDO::PARAM_INT);
            }
            if ($stms->execute()) {
                return true;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function mostrarFacturaVentaModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN factura ON factura.id_factura = venta.id_factura INNER JOIN producto ON producto.id_producto = venta.id_producto INNER JOIN usuario ON usuario.id_usuario = venta.id_usuario INNER JOIN cliente ON cliente.id_cliente = factura.id_cliente WHERE venta.id_factura = ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($id != null) {
                $stms->bindParam(1, $id, PDO::PARAM_STR);
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

    function consultarVentaDia($fecha)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');

        if ($fecha != null) {
            $sql = "SELECT DISTINCT(producto.id_producto),fecha_ingreso, producto.nombre_producto, CONCAT('$', FORMAT(valor_unitario, '$#,##0.00')), factura.metodo_pago FROM venta INNER JOIN producto ON producto.id_producto = venta.id_producto INNER JOIN factura ON factura.id_factura = venta.id_factura WHERE fecha_ingreso like ?";
        } else {
            $sql = "SELECT DISTINCT(producto.id_producto),fecha_ingreso, producto.nombre_producto, CONCAT('$', FORMAT(valor_unitario, '$#,##0.00')), factura.metodo_pago FROM venta INNER JOIN producto ON producto.id_producto = venta.id_producto INNER JOIN factura ON factura.id_factura = venta.id_factura WHERE fecha_ingreso like ?";
        }

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($fecha != null) {
                $fecha = $fecha . "%";
                $stms->bindParam(1, $fecha, PDO::PARAM_STR);
            } else {
                $fechaActal = $fechaActal . "%";
                $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
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

    function consultarVentaTotalDia($fecha)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');

        if ($fecha != null) {
            $sql = "SELECT CONCAT('$', FORMAT(SUM(precio_compra), '$#,##0.00')),SUM(precio_compra) FROM $this->tabla WHERE fecha_ingreso like ?";
        } else {
            $sql = "SELECT CONCAT('$', FORMAT(SUM(precio_compra), '$#,##0.00')),SUM(precio_compra) FROM $this->tabla WHERE fecha_ingreso like ?";
        }

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($fecha != null) {
                $fecha = $fecha . "%";
                $stms->bindParam(1, $fecha, PDO::PARAM_STR);
            } else {
                $fechaActal = $fechaActal . "%";
                $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
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

    function consultarVentaDiaCantidadTotalModelo($id, $fecha, $metodo)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');

        if ($fecha != null) {
            $sql = "SELECT SUM(cantidad), CONCAT('$', FORMAT(SUM(precio_compra), '$#,##0.00')), SUM(peso) FROM $this->tabla INNER JOIN factura ON factura.id_factura = venta.id_factura WHERE id_producto = ? AND fecha_ingreso like ? AND metodo_pago = ?";
        } else {
            $sql = "SELECT SUM(cantidad), CONCAT('$', FORMAT(SUM(precio_compra), '$#,##0.00')), SUM(peso) FROM $this->tabla INNER JOIN factura ON factura.id_factura = venta.id_factura WHERE id_producto = ? AND fecha_ingreso like ? AND metodo_pago = ?";
        }

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($fecha != null) {
                $fecha = $fecha . "%";
                $stms->bindParam(1, $id, PDO::PARAM_INT);
                $stms->bindParam(2, $fecha, PDO::PARAM_STR);
                $stms->bindParam(3, $metodo, PDO::PARAM_STR);
            } else {
                $fechaActal = $fechaActal . "%";
                $stms->bindParam(1, $id, PDO::PARAM_INT);
                $stms->bindParam(2, $fechaActal, PDO::PARAM_STR);
                $stms->bindParam(3, $metodo, PDO::PARAM_STR);
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

    function ganaciasMensualesVentaModelo()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m');
        $fechaActal = $fechaActal . "%";
        $sql = "SELECT CONCAT('$', FORMAT(SUM(precio_compra), '$#,##0.00')) FROM `venta` WHERE fecha_ingreso like ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function ganaciasAnualesVentaModelo()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y');
        $fechaActal = $fechaActal . "%";
        $sql = "SELECT CONCAT('$', FORMAT(SUM(precio_compra), '$#,##0.00')) FROM `venta` WHERE fecha_ingreso like ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
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
        $sql = "SELECT SUM(precio_compra) AS total, MONTHNAME(fecha_ingreso) AS mes FROM `venta` WHERE fecha_ingreso like ? GROUP BY MONTH(fecha_ingreso)";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function listarMetodosPagoModelo($metodo)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        $fechaActal = $fechaActal . "%";
        if ($metodo == null) {
            $sql = "SELECT DISTINCT(metodo_pago) FROM $this->tabla INNER JOIN factura ON factura.id_factura = venta.id_factura  WHERE fecha_factura like ?";
        } else {
            $sql = "SELECT SUM(venta.precio_compra) FROM $this->tabla INNER JOIN factura ON factura.id_factura = venta.id_factura WHERE fecha_factura like ? AND metodo_pago = ?";
        }

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($metodo == null) {
                $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
            } else {
                $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
                $stms->bindParam(2, $metodo, PDO::PARAM_STR);
            }
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function consultarFacturaDevolucionAjaxModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN producto ON producto.id_producto = venta.id_producto INNER JOIN factura ON factura.id_factura = venta.id_factura WHERE venta.id_factura = ?";
        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            $stms->bindParam(1, $id, PDO::PARAM_INT);
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function devolverProductoModelo($id, $id_factura, $restarTotal, $totalCa)
    {
        $sql = "UPDATE $this->tabla SET cantidad=?,precio_compra=? WHERE id_factura = ? AND id_producto = ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            $stms->bindParam(1, $totalCa, PDO::PARAM_STR);
            $stms->bindParam(2, $restarTotal, PDO::PARAM_STR);
            $stms->bindParam(3, $id_factura, PDO::PARAM_STR);
            $stms->bindParam(4, $id, PDO::PARAM_STR);
            if ($stms->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function eliminarFacturaVenta($id)
    {
        try {
            // Establece la conexión a la base de datos
            $conn = new Conexion();
            $pdo = $conn->conectar();

            // Habilita la revisión de claves foráneas
            $sql_enable_fk = "SET FOREIGN_KEY_CHECKS=1";
            $stmt_enable_fk = $pdo->prepare($sql_enable_fk);
            $stmt_enable_fk->execute();

            // Consulta para eliminar registros
            $sql_delete = "DELETE FROM {$this->tabla} WHERE id_factura = ?";
            $stmt_delete = $pdo->prepare($sql_delete);
            $stmt_delete->bindParam(1, $id, PDO::PARAM_INT);

            // Ejecuta la consulta para eliminar registros
            if ($stmt_delete->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Manejo de excepciones
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    function listarProductosVendidos()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m');
        $fechaActal = $fechaActal . "%";
        $sql = "SELECT producto.nombre_producto AS nombre, SUM(cantidad) AS total_vendido FROM `venta` INNER JOIN producto ON producto.id_producto = venta.id_producto WHERE fecha_ingreso LIKE ? GROUP BY producto.nombre_producto ORDER BY total_vendido DESC LIMIT 5";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            $stms->bindParam(1, $fechaActal, PDO::PARAM_STR);
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
