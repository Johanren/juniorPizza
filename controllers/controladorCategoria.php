<?php

class ControladorCategoria
{
    function agregarCategoria()
    {
        if (isset($_POST['agregarCategoria'])) {
            $dato = array('cate' => $_POST['cate'], 'activo' => $_POST['activo']);
            $agregar = new ModeloCategoria();
            $res = $agregar->agregarCategoriaModelo($dato);
            if ($res == true) {
                echo '<script>window.location="agregarCategoria"</script>';
            }
        }
    }

    function listarCategoria()
    {
        $listar = new ModeloCategoria();
        $res = $listar->listarCategoriaModelo();
        return $res;
    }

    function consultarCategoriaAjaxControlador($dato){
        $consultar = new ModeloCategoria();
        $res = $consultar->consultarCategoriaAjaxModelo($dato);
        return $res;
    }
}