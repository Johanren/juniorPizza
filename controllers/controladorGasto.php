<?php

class ControladorGasto
{
    function agregarGasto()
    {
        if (isset($_POST['agregarGasto'])) {
            $dato = array(
                'gasto' => $_POST['gasto'],
                'descripcion' => $_POST['descripcion'],
                'total' => str_replace(',', '', $_POST['total'])
            );
            $agrear = new ModeloGasto();
            $res = $agrear->agregarGastoModelo($dato);
            if ($res == true) {
                echo '<script>window.location="agregarGasto"</script>';
            }
        } elseif (isset($_POST['actualizarGasto'])) {
            $dato = array(
                'gasto' => $_POST['gastoEdit'],
                'descripcion' => $_POST['descripcionEdit'],
                'total' => str_replace(',', '', $_POST['totalEdit']),
                'id' => $_GET['id_gasto']
            );
            $agrear = new ModeloGasto();
            $res = $agrear->actualizarGastoModelo($dato);
            if ($res == true) {
                echo '<script>window.location="actualizarGasto"</script>';
            }
        }
    }

    function listarGasto()
    {
        $agrear = new ModeloGasto();
        $res = $agrear->listarGastoModelo();
        return $res;
    }

    function listarGastoId()
    {
        if (isset($_GET['id_gasto'])) {
            $id = $_GET['id_gasto'];
            $agrear = new ModeloGasto();
            $res = $agrear->listarGastoIdModelo($id);
            return $res;
        }
    }

    function TotalGasto()
    {
        $sum = new ModeloGasto();
        $res = $sum->TotalGastoModelo();
        return $res;
    }
}
