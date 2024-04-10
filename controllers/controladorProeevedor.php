<?php

class ControladorProeevedor
{
    function agregarProeevedor()
    {
        if (isset($_POST['agregarProeevedor'])) {
            if ($_SESSION['rol'] == "Administrador") {
                $dato = array(
                    'proe' => $_POST['proe'],
                    'nit' => $_POST['nit'],
                    'dire' => $_POST['dire'],
                    'tel' => $_POST['tel'],
                    'id_local' => $_POST['local']
                );
            } else {
                $dato = array(
                    'proe' => $_POST['proe'],
                    'nit' => $_POST['nit'],
                    'dire' => $_POST['dire'],
                    'tel' => $_POST['tel'],
                    'id_local' => $_SESSION['id_local']
                );
            }
            $agregar = new ModeloProeevedor();
            $res = $agregar->agregarProeevedorModelo($dato);
            if ($res == true) {
                echo '<script>window.location="agregarProeevedor"</script>';
            }
        }
    }

    function listarProeevedor()
    {
        $listar = new ModeloProeevedor();
        $res = $listar->listarProeevedorModelo();
        return $res;
    }

    function consultarProeevedorAjaxControlador($dato)
    {
        $consultar = new ModeloProeevedor();
        $res = $consultar->consultarProeevedorAjaxModelo($dato);
        return $res;
    }

    function consultarProeevedor(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $mostrar = new ModeloProeevedor();
            $res = $mostrar->consultarProeevedorModelo($id);
            return $res;
        }
    }
}