<?php 
require_once 'conexion.php';
class ModeloEvento{
    public $tabla = 'eventos';
    function consultarEventoModelo($dato){
        $dato = $dato."%";
        $sql = "SELECT * FROM $this->tabla WHERE start like ?";
        $conn = new Conexion();
        $stms = $conn->conectar()->prepare($sql);
        if($dato != ''){
            $stms->bindParam(1, $dato, PDO::PARAM_STR);
        }
        try{
            if($stms->execute()){
                return $stms->fetchAll();
            }else{
                return false;
            }
        }catch(PDOException $e){
            print_r($e->getMessage());
        }
    }
}