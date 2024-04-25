<?php

require_once '../Models/conexion.php';
require_once '../models/modeloVenta.php';

$con = new ModeloVenta();
$listar = $con->listarPorMesModelo();
echo json_encode($listar);
