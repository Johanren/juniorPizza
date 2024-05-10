<?php

class ControladorProducto
{
    function agregarProducto()
    {
        if (isset($_POST['agregarProducto'])) {
            $id = $_POST['id_producto'];
            $id_proeevedor = $_POST['id_proeevedor'];
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $precio = str_replace(',', '',$_POST['precio']);
            $precioUnita = str_replace(',', '',$_POST['precioUnita']);
            $total = str_replace(',', '',$_POST['total']);
            $cantidad = $_POST['cantidad'];
            $cant = $_POST['cant'];
            $id_categoria = $_POST['id_categoria'];
            $id_medida = $_POST['id_medida'];
            $totalFactura = str_replace(',','',$_POST['totalFactura']);
            if ($_SESSION['rol'] == "Administrador") {
                $id_local = $_POST['id_local'];
            } else {
                $id_local = $_SESSION['id_local'];
            }
            for ($i = 0; $i < count($codigo); $i++) {
                if ($id[$i] != null) {
                    $cantidad_producto = $cant[$i] + $cantidad[$i];
                    $agreagr = new ModeloProducto();
                    $res = $agreagr->actualizarProductoModelo($id[$i], $id_proeevedor, $codigo[$i], $nombre[$i], $precio[$i], $cantidad_producto, $id_categoria[$i], $id_medida[$i], $id_local[$i]);
                    if ($res == true) {
                        $agregarFactura = new ControladorFacturaProeevedor();
                        $resFactura = $agregarFactura->agregarFacturaProeevedor($id_categoria[$i], $id_proeevedor, $_SESSION['id_usuario'], $id_medida[$i], $codigo[$i], $nombre[$i], $precio[$i], $cantidad[$i], $id_local[$i], $totalFactura, $precioUnita[$i], $total[$i]);
                        if ($resFactura == true) {
                            echo '<script>window.location="actualizarProducto"</script>';
                        }
                    }
                } else {
                    $agreagr = new ModeloProducto();
                    $res = $agreagr->agregarProductoModelo($id_proeevedor, $codigo[$i], $nombre[$i], $precio[$i], $cantidad[$i], $id_categoria[$i], $id_medida[$i], $id_local[$i]);
                    if ($res == true) {
                        $agregarFactura = new ControladorFacturaProeevedor();
                        $resFactura = $agregarFactura->agregarFacturaProeevedor($id_categoria[$i], $id_proeevedor, $_SESSION['id_usuario'], $id_medida[$i], $codigo[$i], $nombre[$i], $precio[$i], $cantidad[$i], $id_local[$i], $totalFactura, $precioUnita[$i], $total[$i]);
                        if ($resFactura == true) {
                            echo '<script>window.location="agregarProducto"</script>';
                        }
                    }
                }
            }

        }
    }

    function listarProducto()
    {
        $listar = new ModeloProducto();
        $res = $listar->listarProductoModelo();
        return $res;
    }

    function consultarProductoAjaxControlador($dato)
    {
        $consultar = new ModeloProducto();
        $res = $consultar->consultarModeloProductoAjaxModelo($dato);
        return $res;
    }

    function consultarProducto()
    {
        $consultar = new ModeloProducto();
        $res = $consultar->consultarProductoModelo($_GET['id']);
        return $res;
    }

    function consultarAritucloProeevedoridAjax($nit)
    {
        $conusltar = new ModeloProducto();
        $res = $conusltar->consultarAritucloProeevedoridAjaxModelo($nit);
        return $res;
    }

    function consultarAritucloProeevedorAjax($id)
    {
        $conusltar = new ModeloProducto();
        $res = $conusltar->consultarAritucloProeevedorAjaxModelo($id);
        return $res;
    }

    function mostrarArticulo($dato)
    {
        $buscar = new ModeloProducto();
        $res = $buscar->mostrarArticuloModelo($dato);
        return $res;
    }

    function actualizarProductoFactura($dato)
    {
        $buscar = new ModeloProducto();
        $res = $buscar->actualizarProductoFacturaModelo($dato);
        return $res;
    }
}