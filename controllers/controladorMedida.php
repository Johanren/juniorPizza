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
}