<?php
class ControladorDomicilioPedido
{

    function agregarDomicilioPedido()
    {
        if (isset($_POST['agregarPedido'])) {
            $dato = array(
                'nombre' => $_POST['nombre'],
                'tel1' => $_POST['tel1'],
                'tel2' => $_POST['tel2'],
                'dire' => $_POST['direccion'],
                'metodo' => $_POST['metodo'],
                'id_local' => $_POST['id_local']
            );
            $agrear = new ModeloDomicilioPedido();
            $res = $agrear->agregarDomicilioPedidoModelo($dato);
            if ($res == true) {
                $IdDomicilioPedido = $agrear->ultimoIDDomicilioPedido($dato);
                for ($i = 0; $i < count($_POST['id_pedido']); $i++) {
                    $datoDomicilio = array(
                        'id_producto' => $_POST['id_pedido'][$i],
                        'id_domicilio_pedido' => $IdDomicilioPedido[0]['MAX(id_domicilio_pedido)'],
                        'producto' => $_POST['producto'][$i],
                        'des' => $_POST['descripcion'][$i],
                        'precio' => str_replace(',', '', $_POST['precio'][$i]),
                        'cant' => $_POST['cantidad'][$i],
                        'id_estado' => 2,
                        'print' => 1,
                        'cocina' => 0,
                        'pago' => 0,
                        'entregado' => 0,
                        'cancelado' => 0,
                        'id_local' => $_POST['id_local']
                    );
                    $agregarDomicilio = new ControladorDomicilio();
                    $resDomicilio = $agregarDomicilio->agregarDomicilio($datoDomicilio);
                }
                if ($resDomicilio == true) {
                    echo '<script>window.location="index.php?action=domicilioEnviado&domicilio=' . $IdDomicilioPedido[0]['MAX(id_domicilio_pedido)'] . '"</script>';
                }
            }
        }
    }

    function listarPedidoDomicilio()
    {
        $listar = new ModeloDomicilioPedido();
        $res = $listar->listarDomicilioPedido($_GET['domicilio']);
        return $res;
    }

    function listarPedidoDomicilioTabla()
    {
        $listar = new ModeloDomicilioPedido();
        $res = $listar->listarDomicilioPedidoTabla();
        return $res;
    }

    function listarPedidoPirntFechaUsuarioIngresoDomicilioAjaxControlador($print)
    {
        $listar = new ModeloDomicilioPedido();
        $res = $listar->listarPedidoPrintDomicilioAjaxModelo($print);
        if ($res) {
            $resListo = $listar->listarPedidoPirntFechaUsuarioDomicilioIngreso($res[0]['MAX(id_domicilio_pedido)'], $print);
            return $resListo;
        }
    }
}

