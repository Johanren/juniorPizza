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
        }
    }

    function listarCliente()
    {
        $listar = new ModeloCliente();
        $res = $listar->listarModeloCliente();
        return $res;
    }

    function consultarClienteAjax($dato){
        $consultar = new ModeloCliente();
        $res = $consultar->consultarClienteAjaxModelo($dato);
        return $res;
    }
}