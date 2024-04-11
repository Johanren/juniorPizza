<?php

class ControladorPromocion{
    function agregarPromocion(){
        if (isset($_POST['agregarPromocion'])) {
            $id_producto = $_POST['id_producto'];
            $id_prodcu = $_POST['id_prodcu'];
            $cantidadPromocion = $_POST['cantidadPromocion'];
            $id_activa = 1;
            for ($i=0; $i < count($id_prodcu); $i++) { 
                $agregar = new ModeloPromocion();
                $res = $agregar->agregarPromocionModelo($id_producto,$id_prodcu[$i],$cantidadPromocion[$i],$id_activa);
                if ($res == true) {
                    echo '<script>window.location="agregarPromocion"</script>';
                }
            }
        }
    }

    function listarPromocionId(){
        $listar = new ModeloPromocion();
        $res = $listar->listarPromocionId();
        return $res;
    }

    function listarPromocion($id){
        $consultar = new ModeloPromocion();
        $res = $consultar->listarPromocionModelo($id);
        return $res;
    }
}