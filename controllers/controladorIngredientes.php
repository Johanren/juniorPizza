<?php

class ControladorIngredientes
{
    function agregarIngrediente()
    {
        if (isset($_POST['agregarIngrediente'])) {
            $id = $_POST['id_ingre'];
            $id_categoria = 1;
            $codigo = 0;
            $precio = 0;
            $nom_ingre = $_POST['nom_ingre'];
            $id_medida = $_POST['id_medida'];
            $cant = $_POST['cant'];
            $cantidadIngre = $_POST['cantidadIngre'];
            $id_proeevedor = $_POST['id_proeevedor'];
            $totalFactura = $_POST['totalFactura'];
            if ($_SESSION['rol'] == "Administrador") {
                $id_local = $_SESSION['id_local'];
            } else {
                $id_local = $_SESSION['id_local'];
            }
            for ($i = 0; $i < count($nom_ingre); $i++) {
                if ($id[$i] != null) {
                    $cantidad = $cantidadIngre[$i] + $cant[$i];
                    $agregar = new ModeloIngrediente();
                    $res = $agregar->actualizarIngredienteModelo($id[$i], $nom_ingre[$i], $id_medida[$i], $cantidad, $id_local);
                    if ($res == true) {
                        $agregarFactura = new ControladorFacturaProeevedor();
                        $resFactura = $agregarFactura->agregarFacturaProeevedor($id_categoria, $id_proeevedor, $_SESSION['id_usuario'], $id_medida, $codigo, $nom_ingre[$i], $precio, $cant[$i], $id_local, $totalFactura, 0, 0);
                        if ($resFactura == true) {
                            echo '<script>window.location="actualizarIngrediente"</script>';
                        }
                    }
                } else {
                    $agregar = new ModeloIngrediente();
                    $res = $agregar->agregarIngredienteModelo($nom_ingre[$i], $id_medida[$i], $cant[$i], $id_local);
                    if ($res == true) {
                        $agregarFactura = new ControladorFacturaProeevedor();
                        $resFactura = $agregarFactura->agregarFacturaProeevedor($id_categoria, $id_proeevedor, $_SESSION['id_usuario'], $id_medida, $codigo, $nom_ingre[$i], $precio, $cant[$i], $id_local, $totalFactura, 0, 0);
                        if ($resFactura == true) {
                            echo '<script>window.location="agregarIngrediente"</script>';
                        }
                    }
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

    function consultarIngredeinteAjaxControlador($dato)
    {
        $consultar = new ModeloIngrediente();
        $res = $consultar->consultarIngredeinteAjaxModelo($dato);
        return $res;
    }

    function mostrarIngrediente($id)
    {
        $buscar = new ModeloIngrediente();
        $res = $buscar->mostrarIngredienteModelo($id);
        return $res;
    }

    function actualizarIngredienteFactura($dato)
    {
        $buscar = new ModeloIngrediente();
        $res = $buscar->actualizarIngredienteFacturaModelo($dato);
        return $res;
    }

    function eliminaIngredienteId()
    {
        $id = $_GET['id'];
        $listar = new ModeloIngrediente();
        $res = $listar->eliminaIngredienteIdModelo($id);
        if ($res == true) {
            echo '<script>window.location="eliminarProducto"</script>';
        }
    }
}
