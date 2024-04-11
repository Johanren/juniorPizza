<?php

class ControladorMesa{
    function agregarMesa(){
        if (isset($_POST['agregarMesa'])) {
            $mesa = $_POST['mesa'];
            $esatdo = 1;
            $id_piso = $_POST['id_piso'];
            $agregar =  new ModeloMesa();
            $res = $agregar->agregarMesaModelo($mesa,$esatdo,$id_piso);
            if ($res == true) {
                echo '<script>window.location="agregarMesa"</script>';
            }
        }
    }

    function listarMesa(){
        $listar = new ModeloMesa();
        $res = $listar->listarMesaModelo();
        return $res;
    }

    function actualizarEstadoMesa($id_mesa, $id_esatdo){
        $actualizar = new ModeloMesa();
        $res = $actualizar->actualizarEstadoMesaModelo($id_mesa, $id_esatdo);
        return $res;
    }
}