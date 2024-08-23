<?php

require_once '../models/conexion.php';
require_once '../models/modeloVenta.php';
require_once '../models/modeloGasto.php';

if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
    switch ($accion) {
        case 'ventas':
            $con = new ModeloVenta();
            $listar = $con->listarPorMesModelo();
            echo json_encode($listar);
            break;
        case 'gastos':
            $con = new ModeloGasto();
            $listarGasto = $con->listarPorMesModelo();

            echo json_encode($listarGasto);
            break;
        case 'vendido':
            $con = new ModeloVenta();
            $listarProducto = $con->listarProductosVendidos();

            echo json_encode($listarProducto);
            break;
        default:
            // Acción por defecto si no coincide con ninguno de los casos anteriores
            echo "Acción no reconocida.";
            break;
    }
}
