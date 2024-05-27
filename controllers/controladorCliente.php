<?php

class ControladorCliente
{
    function agregarCLiente()
    {
        if (isset($_POST['agregarCliente'])) {
            if ($_SESSION['rol'] == "Administrador") {
                $dato = array(
                    'priNombre' => $_POST['priNombre'],
                    'segNombre' => $_POST['segNombre'],
                    'priApellido' => $_POST['priApellido'],
                    'segApellido' => $_POST['segApellido'],
                    'cc' => $_POST['cc'],
                    'email' => $_POST['email'],
                    'local' => $_POST['local']
                );
            } else {
                $dato = array(
                    'priNombre' => $_POST['priNombre'],
                    'segNombre' => $_POST['segNombre'],
                    'priApellido' => $_POST['priApellido'],
                    'segApellido' => $_POST['segApellido'],
                    'cc' => $_POST['cc'],
                    'email' => $_POST['email'],
                    'local' => $_SESSION['id_local']
                );
            }

            $agregar = new ModeloCliente();
            $res = $agregar->agregarClienteModelo($dato);
            if ($res == true) {
                echo '<script>window.location="agregarCliente"</script>';
            }
        } elseif (isset($_POST['actualizarCliente'])) {
            if ($_SESSION['rol'] == "Administrador") {
                $dato = array(
                    'id' => $_GET['id_cliente'],
                    'priNombre' => $_POST['priNombreEdit'],
                    'segNombre' => $_POST['segNombreEdit'],
                    'priApellido' => $_POST['priApellidoEdit'],
                    'segApellido' => $_POST['segApellidoEdit'],
                    'cc' => $_POST['ccEdit'],
                    'email' => $_POST['emailEdit'],
                    'local' => $_POST['localEdit']
                );
            } else {
                $dato = array(
                    'id' => $_GET['id_cliente'],
                    'priNombre' => $_POST['priNombreEdit'],
                    'segNombre' => $_POST['segNombreEdit'],
                    'priApellido' => $_POST['priApellidoEdit'],
                    'segApellido' => $_POST['segApellidoEdit'],
                    'cc' => $_POST['ccEdit'],
                    'email' => $_POST['emailEdit'],
                    'local' => $_SESSION['id_local']
                );
            }

            $agregar = new ModeloCliente();
            $res = $agregar->actualizarClienteModelo($dato);
            if ($res == true) {
                echo '<script>window.location="actualizarCliente"</script>';
            }
        }
    }

    function listarCliente()
    {
        $listar = new ModeloCliente();
        $res = $listar->listarModeloCliente();
        return $res;
    }

    function consultarClienteAjax($dato)
    {
        $consultar = new ModeloCliente();
        $res = $consultar->consultarClienteAjaxModelo($dato);
        return $res;
    }

    function listarClienteId()
    {
        $id = $_GET['id_cliente'];
        $listar = new ModeloCliente();
        $res = $listar->mostrarClienteFacturaVentaModelo($id);
        return $res;
    }

    function consumidorFinalCompra()
    {
        $listar = new ModeloCliente();
        $res = $listar->consumidorFinalCompraModelo();
        return $res;
    }

    function eliminarClienteId()
    {
        $id = $_GET['id'];
        $listar = new ModeloCliente();
        $res = $listar->eliminarClienteIdModelo($id);
        if ($res == true) {
            echo '<script>window.location="eliminarCliente"</script>';
        }
    }
}
