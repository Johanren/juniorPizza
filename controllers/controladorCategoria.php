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
        } elseif (isset($_POST['actualizarCategoria'])) {
            $dato = array('cate' => $_POST['cate'], 'activo' => $_POST['activo'], 'id' => $_GET['id']);
            $agregar = new ModeloCategoria();
            $res = $agregar->actualizarCategoriaModelo($dato);
            if ($res == true) {
                echo '<script>window.location="actualizarCategoria"</script>';
            }
        }
    }

    function listarCategoria()
    {
        $listar = new ModeloCategoria();
        $res = $listar->listarCategoriaModelo();
        return $res;
    }

    function consultarCategoriaAjaxControlador($dato)
    {
        $consultar = new ModeloCategoria();
        $res = $consultar->consultarCategoriaAjaxModelo($dato);
        return $res;
    }

    function listarCategoriaId()
    {
        $id = $_GET['id'];
        $listar = new ModeloCategoria();
        $res = $listar->listarCategoriaIdModelo($id);
        return $res;
    }
}