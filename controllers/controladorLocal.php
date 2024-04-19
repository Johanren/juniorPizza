<?php

class ControladorLocal
{
    function agregarLocal()
    {
        if (isset($_POST['agregarLocal'])) {
            $dato = array('local' => $_POST['local'], 'nit' => $_POST['nit'], 'dire' => $_POST['dire'], 'tel' => $_POST['tel']);
            $agregar = new ModeloLocal();
            $res = $agregar->agregarLocalModelo($dato);
            if ($res == true) {
                echo '<script>window.location="agregarLocal"</script>';
            }
        }

    }

    function listarLocal()
    {
        $listar = new ModeloLocal();
        $res = $listar->listarModeloModelo();
        return $res;
    }

    function consultarLocal($id){
        $consultar = new ModeloLocal();
        $res = $consultar->consultarLocalModelo($id);
        return $res;
    }

    function consultarLocalAjaxControlador($dato){
        $consultar = new ModeloLocal();
        $res = $consultar->consultarModeloAjaxModelo($dato);
        return $res;
    }
}