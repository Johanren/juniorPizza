<?php

class ControladorNomina
{
    function agregarPagoNomina()
    {
        if (isset($_POST['agregarNomina'])) {
            $dato = array(
                'id_usuario' => $_GET['id_usuario'],
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'rol' => $_POST['rol'],
                'dia' => $_POST['dia'],
                'pago' => $_POST['pago']
            );
            $nomina = new ModeloNomina();
            $res = $nomina->agregarPagoNominaModelo($dato);
            if ($res == true) {
                echo '<script>window.location="agregarNomina"</script>';
            }
        }
    }

    function ConsultarNomina($id)
    {
        $nomina = new ModeloNomina();
        $res = $nomina->ConsultarNominaModelo($id);
        return $res;
    }

    function deudaNomina()
    {
        $sum = new ModeloNomina();
        $res = $sum->deudaNominaModelo();
        return $res;
    }

    function consultarNominaPedidoAjax($id)
    {
        $sum = new ModeloNomina();
        $res = $sum->consultarNominaPedidoAjaxModelo($id);
        return $res;
    }
}