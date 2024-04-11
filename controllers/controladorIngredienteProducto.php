<?php

class ControladorIngredienteProducto{
    function agregarIngredienteProducto(){
        if (isset($_POST['agregarIngredienteProducto'])) {
            $id_producto = $_POST['id_producto'];
            $id_ingre = $_POST['id_ingre'];
            $cantidad = $_POST['cantidad'];
            for ($i=0; $i < count($cantidad); $i++) { 
                $agregar = new ModeloIngredienteProducto();
                $res = $agregar->agregarIngredienteProductoModelo($id_producto, $id_ingre[$i], $cantidad[$i]);
                if ($res == true) {
                    echo '<script>window.location="agregarIngredienteProducto"</script>';
                }
            }
        }
    }

    function listarIngredinteProductoId(){
        $listar = new ModeloIngredienteProducto();
        $res = $listar->listarIngredinteProductoIdModelo();
        return $res;
    }

    function listarIngredinteProducto($id){
        $listar = new ModeloIngredienteProducto();
        $res = $listar->listarIngredinteProductoModelo($id);
        return $res;
    }

    function consultarIngredeinteAjaxControlador($dato){
        $consultar = new ModeloIngredienteProducto();
        $res = $consultar->consultarIngredeinteAjaxModelo($dato);
        if($res[0]['id_producto'] == null){
            $consultarPro = new ControladorProducto();
            $res = $consultarPro->consultarProductoAjaxControlador($dato);
            return $res;
        }
        return $res;
    }
}