<?php

class ControladorFactura
{
    function agregarFactura()
    {
        if (isset($_POST['agregarFactrua'])) {
            #Agregar Factura
            $factura  = (isset($_POST['factura'])) ? $_POST['factura'] : "false";
            $nombre = $_POST['nombre'];
            $placa = $_POST['placa'];
            $observacion = $_POST['observacion'];
            $id_usuario = $_SESSION['id_usuario'];
            $id_cliente = $_POST['id_cliente'];
            $id_articulo = $_POST['id_articulo'];
            $cantidad = $_POST['cantidad'];
            $porciento = (isset($_POST['porciento'])) ? $_POST['porciento'] : 0;
            $cuota = (isset($_POST['cuota'])) ? $_POST['cuota'] : 0;
            $pago = str_replace(',', '', $_POST['pago']);
            $pago1 = (isset($_POST['pago2'])) ? str_replace(',', '', $_POST['pago2']) : 0;
            $metodo = $_POST['metodo'];
            $total_factura = 0;
            $precio = str_replace(',', '', $_POST['precio']);
            $cambio = 0;
            for ($i = 0; $i < count($id_articulo); $i++) {
                $buscar = new ControladorProducto();
                $res = $buscar->mostrarArticulo($id_articulo[$i]);
                if ($metodo == 'member') {
                    if ($precio[$i] > 0) {
                        $multiplicar = $precio[$i] * 0;
                    } else {
                        $multiplicar = $res[0]['precio_unitario'] * 0;
                    }
                } else {
                    if (isset($_SESSION['dueda'])) {
                        if ($_SESSION['dueda'] == 'true') {
                            if ($precio[$i] > 0) {
                                $porcentaje = $porciento / 100;
                                $proje = $precio[$i] * $porcentaje;
                                $multiplicar = $precio[$i] + $proje;
                            } else {
                                $porcentaje = $porciento / 100;
                                $proje = $res[0]['precio_unitario'] * $porcentaje;
                                $multiplicar = $res[0]['precio_unitario'] + $proje;
                            }
                        } else {
                            if ($precio[$i] > 0) {
                                $multiplicar = $precio[$i] * $cantidad[$i];
                            } else {
                                $multiplicar = $res[0]['precio_unitario'] * $cantidad[$i];
                            }
                        }
                    } else {
                        if ($precio[$i] > 0) {
                            $multiplicar = $precio[$i] * $cantidad[$i];
                        } else {
                            $multiplicar = $res[0]['precio_unitario'] * $cantidad[$i];
                        }
                    }
                }
                $total_factura += $multiplicar;
            }
            $total_factura;
            if (isset($_POST['propina'])) {
                $total_factura = str_replace(',', '', $_POST['propina']) + $total_factura;
            }
            $cambio = $pago - $total_factura;
            $dato = array(
                'id_usuario' => $id_usuario,
                'total_factura' => $total_factura,
                'metodo_pago' => $metodo,
                'efectivo' => $pago,
                'cambio' => $cambio,
                'porcentaje' => (isset($porciento)) ? $porciento : 0,
                'cuotas' => (isset($cuota)) ? $cuota : 0,
                'factura' => $factura,
                'id_cliente' => $id_cliente
            );
            $agreagrFactura = new ModeloFactura();
            $resFactura = $agreagrFactura->agregarFacturaModelo($dato);
            $resUltimoId = $agreagrFactura->mostrarUltimoId();
            if (isset($_SESSION['taller'])) {
                if ($_SESSION['taller'] == 'true') {
                    //datos observacion
                    $datoObservacion = array(
                        'id_factura' => $resUltimoId[0]['MAX(id_factura)'],
                        'nombre' => $nombre,
                        'placa' => $placa,
                        'observacion' => $observacion
                    );
                    $agregarObservacion = new ControladorObservacionFactura();
                    $resObservacion = $agregarObservacion->agregarObservacionFactura($datoObservacion);
                }
            }
            if ($resUltimoId == true) {
                if (isset($_POST['propina'])) {
                    $dato = array(
                        'id_factura' => $resUltimoId[0]['MAX(id_factura)'],
                        'propina' => str_replace(',', '', $_POST['propina'])
                    );
                }
                $agregarpropitan = new ControladorPropina();
                $propina = $agregarpropitan->agregarPropina($dato);
                if ($resFactura) {
                    #Agregar Venta Factura
                    $idFactura = $resUltimoId[0]['MAX(id_factura)'];
                    for ($i = 0; $i < count($id_articulo); $i++) {
                        $buscar = new ControladorProducto();
                        $res = $buscar->mostrarArticulo($id_articulo[$i]);
                        $valor_unitario = $res[0]['precio_unitario'];
                        if ($metodo == 'member') {
                            if ($precio[$i] > 0) {
                                $multiplicar = $precio[$i] * 0;
                            } else {
                                $multiplicar = $res[0]['precio_unitario'] * 0;
                            }
                        } else {
                            if ($precio[$i] > 0) {
                                $multiplicar = $precio[$i] * $cantidad[$i];
                            } else {
                                $multiplicar = $res[0]['precio_unitario'] * $cantidad[$i];
                            }
                        }
                        $datoVenta = array(
                            'id_factura' => $idFactura,
                            'id_usuario' => $id_usuario,
                            'id_articulo' => $id_articulo[$i],
                            'peso' => null,
                            'cantidad' => $cantidad[$i],
                            'valor_unitario' => $valor_unitario,
                            'precio_compra' => $multiplicar
                        );
                        $agregarVenta = new ControladorVenta();
                        $resVenta = $agregarVenta->agregarVenta($datoVenta);
                        if ($resVenta == true) {
                            //buscar Promocion
                            $buscarPromocion = new ControladorPromocion();
                            $resPromocion = $buscarPromocion->listarPromocionProductoFactura($id_articulo[$i]);
                            if ($resPromocion != []) {
                                foreach ($resPromocion as $key => $value) {
                                    if ($resPromocion == true) {
                                        #Actualizar Productos promocionados
                                        $cantidadPromocion = $value['cantidad_promocion_producto'] * $cantidad[$i];
                                        $idProducto = $value['id_promocion_articulo'];
                                        $buscar = new ControladorProducto();
                                        $res = $buscar->mostrarArticulo($value['id_promocion_articulo']);
                                        #Actualizar Cantidad Producto
                                        $cantidad_producto = $res[0]['cantidad_producto'] - $cantidadPromocion;
                                        $datoProductoPromo = array(
                                            'cantidad' => $cantidad_producto,
                                            'id_producto' => $idProducto
                                        );
                                        $actualizarProducto = new ControladorProducto();
                                        $actualizarProducto->actualizarProductoFactura($datoProductoPromo);
                                    }
                                    $buscarIngrediente = new ControladorIngredienteProducto();
                                    $resIngredienteProducto = $buscarIngrediente->listarIngredienteProductoFactura($value['id_promocion_articulo']);
                                    if ($resIngredienteProducto != []) {
                                        foreach ($resIngredienteProducto as $key => $value) {
                                            #Actuaalizar Cantidad Ingrediente
                                            $id = $value['id_ingrediente'];
                                            $cantidadIngre = $value['cantidad'] * $cantidad[$i];
                                            $buscarIngre = new ControladorIngredientes();
                                            $resingre = $buscarIngre->mostrarIngrediente($id);
                                            $cantidad_ingrediente = $resingre[0]['cantidad'] - $cantidadIngre;
                                            $datoIngredientePromo = array(
                                                'cantidad' => $cantidad_ingrediente,
                                                'id_ingrediente' => $id
                                            );
                                            $actualizarIngre = new ControladorIngredientes();
                                            $actualizarIngre->actualizarIngredienteFactura($datoIngredientePromo);
                                        }
                                    } else {
                                        //print "no tiene ingrediente";
                                    }
                                }
                            } else {
                                $buscarIngrediente = new ControladorIngredienteProducto();
                                $resIngredienteProducto = $buscarIngrediente->listarIngredienteProductoFactura($id_articulo[$i]);
                                if ($resIngredienteProducto != []) {
                                    foreach ($resIngredienteProducto as $key => $value) {
                                        #Actuaalizar Cantidad Ingrediente
                                        $id = $value['id_ingrediente'];
                                        $cantidadIngre = $value['cantidad'] * $cantidad[$i];
                                        $buscarIngre = new ControladorIngredientes();
                                        $resingre = $buscarIngre->mostrarIngrediente($id);
                                        $cantidad_ingrediente = $resingre[0]['cantidad'] - $cantidadIngre;
                                        $datoIngredientePromo = array(
                                            'cantidad' => $cantidad_ingrediente,
                                            'id_ingrediente' => $id
                                        );
                                        $actualizarIngre = new ControladorIngredientes();
                                        $actualizarIngre->actualizarIngredienteFactura($datoIngredientePromo);
                                    }
                                } else {
                                    //print "no tiene ingrediente<br>";
                                }
                            }
                            #Actualizar Producto
                            $buscar = new ControladorProducto();
                            $res = $buscar->mostrarArticulo($id_articulo[$i]);
                            $cantidad_producto = $res[0]['cantidad_producto'] - $cantidad[$i];
                            $datoProductoPromo = array(
                                'cantidad' => $cantidad_producto,
                                'id_producto' => $id_articulo[$i]
                            );
                            $actualizarProducto = new ControladorProducto();
                            $resActualizarProducto = $actualizarProducto->actualizarProductoFactura($datoProductoPromo);
                        }
                        if (isset($_GET['id_mesa'])) {
                            #Mostrar Pedido Mesa
                            $listarid = new ModeloPedido();
                            $res = $listarid->listarPedidoFacturaModelo($_GET['id_mesa']);
                            foreach ($res as $key => $value) {
                                if ($value['id_producto'] == $id_articulo[$i]) {
                                    #Actualizar el pago pedido a 1
                                    $actualizarPagoPedido = new ControladorPedido();
                                    $rePedido = $actualizarPagoPedido->actualizarPagoPedido($id_articulo[$i], $value['fecha_ingreso']);
                                    #Actualizar estado mesa Disponible
                                    if ($rePedido == true) {
                                        $estadoDisponible = new ControladorMesa();
                                        $resestado = $estadoDisponible->estadoMesaFactura($value['id_mesa'], 1);
                                        if ($resestado == true) {
                                            echo '<script>window.location="factura_pdf"</script>';
                                        }
                                    }
                                } else {
                                    #Actualizar estado mesa Pago parcial
                                    $estadoDisponible = new ControladorMesa();
                                    $resestado = $estadoDisponible->estadoMesaFactura($_GET['id_mesa'], 5);
                                    if ($resestado == true) {
                                        echo '<script>window.location="factura_pdf"</script>';
                                    }
                                }
                            }
                        } else {
                            echo '<script>window.location="factura_pdf"</script>';
                        }
                    }
                }
            }
        }
    }

    function listarFacturaCliente()
    {
        if (isset($_POST['buscarr'])) {
            date_default_timezone_set('America/Mexico_City');
            $fechaActal = date('Y-m-d');
            if ($_POST['cc'] && $_POST['fecha'] != null) {
                $dato = array(
                    'cc' => $_POST['cc'],
                    'fecha' => $_POST['fecha']
                );
            } elseif ($_POST['cc'] != null) {
                $dato = array(
                    'cc' => $_POST['cc'],
                    'fecha' => $fechaActal
                );
            }
            $consultar = new ModeloFactura();
            $res = $consultar->listarFacturaClienteModelo($dato);
            if ($res) {
                print "<script>$(document).ready(function() {
                    $('#exampleModal').modal('toggle')
                });</script>";
            }
            return $res;
        } else {
            $consultar = new ModeloFactura();
            $res = $consultar->listarFacturaClienteModelo('');
            return $res;
        }
    }

    function listarDeudoresFactura()
    {
        $agregarFactura = new ModeloFactura();
        $res = $agregarFactura->listarDeudoresFacturaModelo();
        return $res;
    }

    function actualizarDeudaFactura()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        if (isset($_POST['guardar'])) {
            $total = str_replace(',', '', $_POST['debe']) + str_replace(',', '', $_POST['abono']);
            $abono = str_replace(',', '', $_POST['efectivo']) + str_replace(',', '', $_POST['abono']);
            $cuota = (isset($_POST['cuota'])) ? $_POST['cuota'] - 1 : 0;
            $dato = array(
                'pago' => $abono,
                'total' => $total,
                'id_factura' => $_GET['id_factura'],
                'id_usuario' => $_SESSION['id_usuario'],
                'cuota' => $cuota,
                'fecha' => $fechaActal
            );
            $agregarFactura = new ModeloFactura();
            $res = $agregarFactura->actualizarDeudaFacturaModelo($dato);
            if ($res == true) {
                echo '<script>window.location="deudores"</script>';
            }
        }
    }

    function restarEfectivoFactura($id, $efectivo)
    {
        $resFactura = new ModeloFactura();
        $res = $resFactura->restarEfectivoFacturaModelo($id, $efectivo);
        return $res;
    }

    function eliminarFactura($id)
    {
        $eliminar = new ModeloFactura();
        $res = $eliminar->eliminarFacturaModelo($id);
        return $res;
    }

    function actualizarTotalFacturaPropina($totalsinpropina, $id)
    {
        $actualizarFactura = new ModeloFactura();
        $act = $actualizarFactura->actualizarTotalFacturaPropinaModelo($totalsinpropina, $id);
        return $act;
    }
}
