<?php

class ControladorMedida
{
    function agregarMedida()
    {
        if (isset($_POST['agregarCategoria'])) {
            $dato = array('med' => $_POST['med'], 'activo' => $_POST['activo']);
            $agregar = new ModeloMedida();
            $res = $agregar->agregarMeedidaModelo($dato);
            if ($res == true) {
                echo '<script>window.location="agregarMedida"</script>';
            }
        }elseif (isset($_POST['actualizarCategoria'])) {
            $dato = array('id' => $_GET['id'], 'med' => $_POST['med'], 'activo' => $_POST['activo']);
            $agregar = new ModeloMedida();
            $res = $agregar->actualizarMeedidaModelo($dato);
            if ($res == true) {
                echo '<script>window.location="actualizarMedida"</script>';
            }
        }
    }

    function listarMedida()
    {
        $listar = new ModeloMedida();
        $res = $listar->listarMedidaaModelo();
        return $res;
    }

    function consultarMedidaAjaxControlador($dato){
        $consultar = new ModeloMedida();
        $res = $consultar->consultarMedidaAjaxModelo($dato);
        return $res;
    }

    function listarMedidaId(){
        $id = $_GET['id'];
        $listar = new ModeloMedida();
        $res = $listar->listarMedidaIdModelo($id);
        return $res;
    }
}