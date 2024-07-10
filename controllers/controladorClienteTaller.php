<?php

class ControladorClienteTaller
{
    function agregarOrdenTrabajoCliente()
    {
        if (isset($_POST['agregarOrden'])) {
            $dato = array(
                'nombreCliente' => $_POST['nombreCliente'],
                'nombreempresa' => $_POST['nombreempresa'],
                'telefonoCliente' => $_POST['telefonoCliente'],
                'recibidoPor' => $_POST['recibidoPor']
            );
            $agregar = new ModeloClienteTaller();
            $res = $agregar->agregarOrdenTrabajoClienteModelo($dato);
            if ($res == true) {

                $ultimoidTaller = $agregar->mostrarUltimoId();
                $datoVehiculo = array(
                    'nivel' => $_POST['nivel'],
                    'estado' => $_POST['estado'],
                    'kilometro' => $_POST['kilometro'],
                    'marca' => $_POST['marca'],
                    'placa' => $_POST['placa'],
                    'linea' => $_POST['linea'],
                    'id' => $ultimoidTaller[0]['MAX(id_cliente_taller)']
                );
                $agregarVehiculo = new ControladorVehiculo();
                $resVehiculo = $agregarVehiculo->agregarVehiculoOrdenTrabajo($datoVehiculo);
                if ($resVehiculo == true) {
                    $ultimoidTaller = $agregar->mostrarUltimoId();
                    $datosestadovehiculo = array(
                        'grasa' => $_POST['grasa'],
                        'aceite' => $_POST['aceite'],
                        'desvare' => $_POST['desvare'],
                        'electrico' => $_POST['electrico'],
                        'llantas' => $_POST['llantas'],
                        'lavado' => $_POST['lavado'],
                        'frenos' => $_POST['frenos'],
                        'supencion' => $_POST['supencion'],
                        'motor' => $_POST['motor'],
                        'muelles' => $_POST['muelles'],
                        'pintura' => $_POST['pintura'],
                        'diferencial' => $_POST['diferencial'],
                        'direccion' => $_POST['direccion'],
                        'vidrios' => $_POST['vidrios'],
                        'tapizado' => $_POST['tapizado'],
                        'luces' => $_POST['luces'],
                        'soldadura' => $_POST['soldadura'],
                        'caja' => $_POST['caja'],
                        'descripcion' => $_POST['descripcion'],
                        'pendienevehiculo' => $_POST['pendienevehiculo'],
                        'id' => $ultimoidTaller[0]['MAX(id_cliente_taller)']
                    );
                    $estadoVehiculo = new ControladorEstadoVehiculo();
                    $resestadovehiculo = $estadoVehiculo->agregarEstadoVehiculoOrdenTrabajo($datosestadovehiculo);
                    if ($resestadovehiculo == true) {
                        $materiales = $_POST['materiales'];
                        $ultimoidTaller = $agregar->mostrarUltimoId();
                        for ($i = 0; $i < count($materiales); $i++) {
                            $datoMaterial = array(
                                'materiales' => $materiales[$i],
                                'id' => $ultimoidTaller[0]['MAX(id_cliente_taller)']
                            );
                            $agregarMaterial = new ControladorMateriales();
                            $resMaterial = $agregarMaterial->agregarMaterialesOrdenTrabajo($datoMaterial);
                        }
                        if ($resMaterial == true) {
                            $ultimoidTaller = $agregar->mostrarUltimoId();
                            $datofirma = array(
                                'clinte' => $_POST['clinte'],
                                'tecnico' => $_POST['tecnico'],
                                'entrega' => $_POST['entrega'],
                                'id' => $ultimoidTaller[0]['MAX(id_cliente_taller)']
                            );
                            $agregarFirma = new ControladorFirma();
                            $resFirma = $agregarFirma->agregarFirmaOrdenTrabajo($datofirma);
                            if ($resFirma == true) {
                                echo '<script>window.location="okOrden"</script>';
                            }
                        }
                    }
                }
            }
        }
        if (isset($_POST['actualizarOrden'])) {
            $dato = array(
                'nombreCliente' => $_POST['nombreClienteEdit'],
                'nombreempresa' => $_POST['nombreempresaEdit'],
                'telefonoCliente' => $_POST['telefonoClienteEdit'],
                'recibidoPor' => $_POST['recibidoPorEdit'],
                'fechaSalida' => $_POST['fechaSalidaEdit'],
                'id' => $_GET['id_cliente_taller']
            );
            $atualizar = new ModeloClienteTaller();
            $res = $atualizar->actualizarOrdenTrabajoClienteModelo($dato);
            if ($res == true) {
                $datoVehiculo = array(
                    'nivel' => $_POST['nivelEdit'],
                    'estado' => $_POST['estadoEdit'],
                    'kilometro' => $_POST['kilometroEdit'],
                    'marca' => $_POST['marcaEdit'],
                    'placa' => $_POST['placaEdit'],
                    'linea' => $_POST['lineaEdit'],
                    'id' => $_GET['id_cliente_taller']
                );
                $actualizarVehiculo = new ControladorVehiculo();
                $resVehiculo = $actualizarVehiculo->actualizarVehiculoOrdenTrabajo($datoVehiculo);
                if ($resVehiculo == true) {
                    $datosestadovehiculo = array(
                        'grasa' => $_POST['grasaEdit'],
                        'aceite' => $_POST['aceiteEdit'],
                        'desvare' => $_POST['desvareEdit'],
                        'electrico' => $_POST['electricoEdit'],
                        'llantas' => $_POST['llantasEdit'],
                        'lavado' => $_POST['lavadoEdit'],
                        'frenos' => $_POST['frenosEdit'],
                        'supencion' => $_POST['supencionEdit'],
                        'motor' => $_POST['motorEdit'],
                        'muelles' => $_POST['muellesEdit'],
                        'pintura' => $_POST['pinturaEdit'],
                        'diferencial' => $_POST['diferencialEdit'],
                        'direccion' => $_POST['direccionEdit'],
                        'vidrios' => $_POST['vidriosEdit'],
                        'tapizado' => $_POST['tapizadoEdit'],
                        'luces' => $_POST['lucesEdit'],
                        'soldadura' => $_POST['soldaduraEdit'],
                        'caja' => $_POST['cajaEdit'],
                        'descripcion' => $_POST['descripcionEdit'],
                        'pendienevehiculo' => $_POST['pendienevehiculoEdit'],
                        'id' => $_GET['id_cliente_taller']
                    );
                    $estadoVehiculo = new ControladorEstadoVehiculo();
                    $resestadovehiculo = $estadoVehiculo->actualizarEstadoVehiculoOrdenTrabajo($datosestadovehiculo);
                    if ($resestadovehiculo == true) {
                        $materialesEdit = $_POST['materialesEdit'];
                        $materiales = $_POST['materiales'];
                        $id = $_POST['id_material'];
                        if (isset($materialesEdit)) {
                            for ($i = 0; $i < count($materialesEdit); $i++) {
                                $datoMaterial = array(
                                    'materiales' => $materialesEdit[$i],
                                    'id' => $id[$i]
                                );
                                $actualizarMaterial = new ControladorMateriales();
                                $resMaterial = $actualizarMaterial->actualizarMaterialesOrdenTrabajo($datoMaterial);
                            }
                        }
                        if (isset($materiales)) {
                            for ($i = 0; $i < count($materiales); $i++) {
                                $datoMaterial = array(
                                    'materiales' => $materiales[$i],
                                    'id' => $_GET['id_cliente_taller']
                                );
                                $agregarMaterial = new ControladorMateriales();
                                $resMaterial = $agregarMaterial->agregarMaterialesOrdenTrabajo($datoMaterial);
                            }
                        }
                        if ($resMaterial == true) {
                            $datofirma = array(
                                'clinte' => $_POST['clinteEdit'],
                                'tecnico' => $_POST['tecnicoEdit'],
                                'entrega' => $_POST['entregaEdit'],
                                'id' => $_GET['id_cliente_taller']
                            );
                            $actualizarFirma = new ControladorFirma();
                            $resFirma = $actualizarFirma->actualizarFirmaOrdenTrabajo($datofirma);
                            if ($resFirma == true) {
                                echo '<script>window.location="actuaOrden"</script>';
                            }
                        }
                    }
                }
            }
        }
    }
}
