<?php

class ControladorPedido
{
    function agregarPedido()
    {
        if (isset($_POST['agregarPedido'])) {
            $id_mesa = $_GET['id'];
            $id_producto = $_POST['id_pedido'];
            $producto = $_POST['producto'];
            $descripcion = $_POST['descripcion'];
            $cantidad = $_POST['cantidad'];
            $id_esatdo = 2;
            $id_usuario = $_SESSION['id_usuario'];
            for ($i = 0; $i < count($id_producto); $i++) {
                $agregar = new ModeloPedido();
                $res = $agregar->agregarPedidoModelo($id_mesa, $id_producto[$i], $producto[$i], $descripcion[$i], $cantidad[$i], $id_esatdo, $id_usuario);
                if ($res == true) {
                    $actualizar = new ControladorMesa();
                    $res = $actualizar->actualizarEstadoMesa($id_mesa, $id_esatdo);
                    if ($res == true) {
                        echo '<script>window.location="agregarPedidor"</script>';
                    }
                }
            }
        }
    }

    function listarPedidoMesa(){
        $listarid = new ModeloPedido();
        $res = $listarid->listarPedidoMesa();
        return $res;
    }

    function listarPedidoMesaDescripcion($id, $fecha){
        $listarid = new ModeloPedido();
        $res = $listarid->listarPedidoMesaDescripcionModelo($id, $fecha);
        return $res;
    }
}