<?php
require_once '../models/conexion.php';
foreach ($_POST as $key => $value) {
    
    $sql = "UPDATE funiones SET estado = ? WHERE nombre_campo = ?";
    $conn = new Conexion();
    $stms = $conn->conectar()->prepare($sql);
    $stms->bindParam(1, $value, PDO::PARAM_STR);
    $stms->bindParam(2, $key, PDO::PARAM_STR);
    try {
        if ($stms->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        print_r($e->getMessage());
    }
}