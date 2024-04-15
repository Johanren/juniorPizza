<?php

class ControladorProducto
{
    function agregarProducto()
    {
        if (isset($_POST['agregarProducto'])) {
            $id_proeevedor = $_POST['id_proeevedor'];
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $id_categoria = $_POST['id_categoria'];
            $id_medida = $_POST['id_medida'];
            if ($_SESSION['rol'] == "Administrador") {
                $id_local = $_POST['id_local'];
            } else {
                $id_local = $_SESSION['rol'];
            }
            for ($i = 0; $i < count($codigo); $i++) {
                $agreagr = new ModeloProducto();
                $res = $agreagr->agregarProductoModelo($id_proeevedor, $codigo[$i], $nombre[$i], $precio[$i], $cantidad[$i], $id_categoria[$i], $id_medida[$i], $id_local[$i]);
                if ($res == true) {
                    $agregarFactura = new ControladorFacturaProeevedor();
                    $resFactura = $agregarFactura->agregarFacturaProeevedor($id_categoria[$i], $id_proeevedor, $_SESSION['id_usuario'], $id_medida[$i], $codigo[$i], $nombre[$i], $precio[$i], $cantidad[$i], $id_local[$i]);
                    if ($resFactura == true) {
                        echo '<script>window.location="agregarProducto"</script>';
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
}