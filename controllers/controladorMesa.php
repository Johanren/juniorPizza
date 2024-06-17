<?php

class ControladorMesa
{
    function agregarMesa()
    {
        if (isset($_POST['agregarMesa'])) {
            $mesa = $_POST['mesa'];
            $esatdo = 1;
            $id_piso = $_POST['id_piso'];
            $agregar = new ModeloMesa();
            $res = $agregar->agregarMesaModelo($mesa, $esatdo, $id_piso);
            if ($res == true) {
                echo '<script>window.location="agregarMesa"</script>';
            }
        }
    }

    function listarMesa()
    {
        $listar = new ModeloMesa();
        $res = $listar->listarMesaModelo();
        return $res;
    }

    function actualizarEstadoMesa($id_mesa, $id_esatdo)
    {
        if (isset($_POST['actualizarMesa'])) {
            $id_mesa = $_POST['mesa'];
            $id_esatdo = $_POST['estado'];
            $actualizar = new ModeloMesa();
            $res = $actualizar->actualizarEstadoMesaModelo($id_mesa, $id_esatdo);
            if ($res == true) {
                $id_mesa = $_GET['id'];
                $id_esatdo = 1;
                $actualizar = new ModeloMesa();
                $res = $actualizar->actualizarEstadoMesaModelo($id_mesa, $id_esatdo);
                if ($res == true) {
                    $id_mesa = $_POST['mesa'];
                    $actualizarPedido = new ModeloPedido();
                    $res = $actualizarPedido->actualizarMesaPedido($_GET['id'], $id_mesa);
                    if ($res == true) {
                        echo '<script>window.location="actualizoMesa"</script>';
                    }
                }
            }
        } elseif (isset($_POST['actualizarMesa_id'])) {
            $id_mesa = $_POST['mesa'];
            $id_esatdo = $_POST['estado'];
            $fecha = $_GET['fecha'];
            $actualizar = new ModeloMesa();
            $res = $actualizar->actualizarEstadoMesaModelo($id_mesa, $id_esatdo);
            if ($res == true) {
                $id_mesa = $_POST['mesa'];
                $actualizarPedido = new ModeloPedido();
                $res = $actualizarPedido->actualizarMesaPedidoEstado($_GET['id_mesa'], $id_mesa, $id_esatdo, $fecha);
                if ($res == true) {
                    echo '<script>window.location="actualizoMesa"</script>';
                }
            }
        } else {
            $actualizar = new ModeloMesa();
            $res = $actualizar->actualizarEstadoMesaModelo($id_mesa, $id_esatdo);
            return $res;
        }
    }

    function buscarMesaId($id_mesa)
    {
        $actualizar = new ModeloMesa();
        $res = $actualizar->buscarMesaIdModelo($id_mesa);
        return $res;
    }

    function estadoMesaFactura($id, $id_esatdo)
    {
        $actualizar = new ModeloMesa();
        $res = $actualizar->actualizarEstadoMesaModelo($id, $id_esatdo);
        return $res;
    }

    function eliminarMesaId()
    {
        $id = $_GET['id_mesa'];
        $listar = new ModeloMesa();
        $res = $listar->eliminarMesaIdModelo($id);
        if ($res == true) {
            echo '<script>window.location="eliminarMesa"</script>';
        }
    }
}
