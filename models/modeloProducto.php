<?php

class ModeloProducto
{
    public $tabla = "producto";
    function agregarProductoModelo($id_proeevedor, $codigo, $nombre, $precio, $cantidad, $id_categoria, $id_medida, $id_local)
    {
        $sql = "INSERT INTO $this->tabla (id_proeevedor, codigo_producto, nombre_producto, precio_unitario, cantidad_producto, id_categoria, id_medida, id_local) VALUES (?,?,?,?,?,?,?,?)";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($codigo != '') {
            $stms->bindParam(1, $id_proeevedor, PDO::PARAM_INT);
            $stms->bindParam(2, $codigo, PDO::PARAM_INT);
            $stms->bindParam(3, $nombre, PDO::PARAM_STR);
            $stms->bindParam(4, $precio, PDO::PARAM_INT);
            $stms->bindParam(5, $cantidad, PDO::PARAM_INT);
            $stms->bindParam(6, $id_categoria, PDO::PARAM_INT);
            $stms->bindParam(7, $id_medida, PDO::PARAM_INT);
            $stms->bindParam(8, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function listarProductoModelo()
    {
        if ($_SESSION['rol'] == "Administrador") {
            $id = $_SESSION['id_local'];
            $sql = "SELECT * FROM $this->tabla INNER JOIN proeevedor ON proeevedor.id_proeevedor = producto.id_proeevedor INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria INNER JOIN medida ON medida.id_medida = producto.id_medida INNER JOIN local ON local.id_local = producto.id_local WHERE producto.id_local = $id";
        } else {
            $id = $_SESSION['id_local'];
            $sql = "SELECT * FROM $this->tabla INNER JOIN proeevedor ON proeevedor.id_proeevedor = producto.id_proeevedor INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria INNER JOIN medida ON medida.id_medida = producto.id_medida INNER JOIN local ON local.id_local = producto.id_local WHERE producto.id_local = $id";
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

    function listarProductoExcelModelo()
    {
        $sql = "SELECT * FROM $this->tabla INNER JOIN proeevedor ON proeevedor.id_proeevedor = producto.id_proeevedor INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria INNER JOIN medida ON medida.id_medida = producto.id_medida INNER JOIN local ON local.id_local = producto.id_local WHERE producto.id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
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

    function consultarModeloProductoAjaxModelo($dato)
    {
        if ($dato != '') {
            $dato = '%' . $dato . '%';
            $sql = "SELECT * FROM $this->tabla INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria INNER JOIN medida ON medida.id_medida = producto.id_medida INNER JOIN local ON local.id_local = producto.id_local WHERE nombre_producto like ? AND id_local = ? ORDER BY id_producto";
        } else {
            $sql = "SELECT * FROM $this->tabla WHERE id_local = ? ORDER BY id_producto";
        }

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != '') {
                $stms->bindParam(1, $dato, PDO::PARAM_STR);
                $stms->bindParam(2, $_SESSION['id_local'], PDO::PARAM_INT);
            }else{
                $stms->bindParam(1, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function consultarProductoModelo($id)
    {

        $sql = "SELECT * FROM $this->tabla WHERE id_producto = ? AND id_local=?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            $stms->bindParam(1, $id, PDO::PARAM_INT);
            $stms->bindParam(2, $_SESSION['id_local'], PDO::PARAM_INT);
            if ($stms->execute()) {
                return $stms->fetchAll();
            } else {
                return [];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function consultarAritucloProeevedoridAjaxModelo($nit)
    {

        $sql = "SELECT * FROM $this->tabla WHERE codigo_producto like ? OR nombre_producto like ? AND id_local = ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($nit != null) {
                $nombre = '%' . $nit . '%';
                $nit = $nit . '%';
                $stms->bindParam(1, $nit, PDO::PARAM_INT);
                $stms->bindParam(2, $nombre, PDO::PARAM_STR);
                $stms->bindParam(3, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function consultarAritucloProeevedorAjaxModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla WHERE id_producto = ? AND id_local = ?";

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
                return [];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function mostrarArticuloModelo($id)
    {
        $sql = "SELECT * FROM $this->tabla  WHERE id_producto = ? AND id_local = ?";

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
                return [];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function actualizarProductoFacturaModelo($dato)
    {
        $sql = "UPDATE $this->tabla SET cantidad_producto=? WHERE id_producto=? AND id_local = ?";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($dato != null) {
                $stms->bindParam(1, $dato['cantidad'], PDO::PARAM_INT);
                $stms->bindParam(2, $dato['id_producto'], PDO::PARAM_INT);
                $stms->bindParam(3, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function actualizarProductoModelo($id, $id_proeevedor, $codigo, $nombre, $precio, $cantidad, $id_categoria, $id_medida, $id_local)
    {
        $sql = "UPDATE $this->tabla SET id_proeevedor=?,codigo_producto=?,nombre_producto=?,precio_unitario=?,cantidad_producto=?,id_categoria=?,id_medida=?,id_local=? WHERE id_producto=? AND id_local = ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if ($codigo != '') {
            $stms->bindParam(1, $id_proeevedor, PDO::PARAM_INT);
            $stms->bindParam(2, $codigo, PDO::PARAM_INT);
            $stms->bindParam(3, $nombre, PDO::PARAM_STR);
            $stms->bindParam(4, $precio, PDO::PARAM_INT);
            $stms->bindParam(5, $cantidad, PDO::PARAM_INT);
            $stms->bindParam(6, $id_categoria, PDO::PARAM_INT);
            $stms->bindParam(7, $id_medida, PDO::PARAM_INT);
            $stms->bindParam(8, $id_local, PDO::PARAM_INT);
            $stms->bindParam(9, $id, PDO::PARAM_INT);
            $stms->bindParam(10, $_SESSION['id_local'], PDO::PARAM_INT);
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

    function alertarProductosFaltanteModelo()
    {
        if ($_SESSION['rol'] == "Administrador") {
            $id = $_SESSION['id_local'];
            $sql = "SELECT * FROM $this->tabla INNER JOIN proeevedor ON proeevedor.id_proeevedor = producto.id_proeevedor INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria INNER JOIN medida ON medida.id_medida = producto.id_medida INNER JOIN local ON local.id_local = producto.id_local WHERE producto.id_local = $id";
        } else {
            $id = $_SESSION['id_local'];
            $sql = "SELECT * FROM $this->tabla INNER JOIN proeevedor ON proeevedor.id_proeevedor = producto.id_proeevedor INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria INNER JOIN medida ON medida.id_medida = producto.id_medida INNER JOIN local ON local.id_local = producto.id_local WHERE producto.id_local = $id";
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

    function eliminaProductoIdModelo($id)
    {
        $sql = "SET FOREIGN_KEY_CHECKS=1";

        try {
            $conn = new Conexion();
            $stms = $conn->conectar()->prepare($sql);
            if ($stms->execute()) {
                $sql = "DELETE FROM $this->tabla WHERE id_producto = ? AND id_local=?";

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
