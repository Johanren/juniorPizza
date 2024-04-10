<?php

class ControladorIngredientes
{
    function agregarIngrediente()
    {
        if (isset($_POST['agregarIngrediente'])) {
            $nom_ingre = $_POST['nom_ingre'];
            $id_medida = $_POST['id_medida'];
            $cant = $_POST['cant'];
            for ($i = 0; $i < count($nom_ingre); $i++) {
                $agregar = new ModeloIngrediente();
                $res = $agregar->agregarIngredienteModelo($nom_ingre[$i], $id_medida[$i], $cant[$i]);
                if ($res == true) {
                    echo '<script>window.location="agregarIngrediente"</script>';
                }
            }

        }
    }

    function listarIngredinte()
    {
        $listar = new ModeloIngrediente();
        $res = $listar->listarIngredinteModelo();
        return $res;
    }

    function consultarIngredeinteAjaxControlador($dato){
        $consultar = new ModeloIngrediente();
        $res = $consultar->consultarIngredeinteAjaxModelo($dato);
        return $res;
    }
}