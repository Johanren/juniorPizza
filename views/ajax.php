<?php
session_start();
//controlador
foreach (glob("../controllers/*.php") as $filename) {
    require_once $filename;
}

// Requiere todos los archivos en la carpeta 'models'
foreach (glob("../models/*.php") as $filename) {
    require_once $filename;
}

class Ajax
{
    public $proeevedor;

    public $medida;
    public $categoria;
    public $local;
    public $producto;
    public $ingrediente;
    public $Pedido;
    public $id_local;
    public $id_mesa;
    public $fecha;
    public $print;
    public $printDomicilio;
    public $printUsuario;
    public $printCliente;
    public $respuestaPrint;
    public $respuestaPrintDomicilio;
    public $cc;
    public $articulo;
    public $idArticulo;
    public $id_nomina;
    public $factura;
    public $propina;
    public $id_factura;
    public $impuesto;

    function consultarProeevedorAjax()
    {
        $consultar = new ControladorProeevedor();
        $respuesta = $consultar->consultarProeevedorAjaxControlador($this->proeevedor);
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => $value['nombre_proeevedor'],
                'id' => $value['id_proeevedor'],
                'nom' => $value['nombre_proeevedor'],
                'nit' => $value['nit_proeevedor'],
                'tel' => $value['telefono_proeevedor'],
                'dire' => $value['direccion_proeevedor'],
            );
        }

        print json_encode($datos);
    }

    function consultarMedidaAjax()
    {
        $consultar = new ControladorMedida();
        $respuesta = $consultar->consultarMedidaAjaxControlador($this->medida);
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => $value['nombre_medida'],
                'id' => $value['id_medida'],
            );
        }

        print json_encode($datos);
    }

    function consultarCategoriaAjax()
    {
        $consultar = new ControladorCategoria();
        $respuesta = $consultar->consultarCategoriaAjaxControlador($this->categoria);
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => $value['nombre_categoria'],
                'id' => $value['id_categoria'],
            );
        }

        print json_encode($datos);
    }

    function consultarLocalAjax()
    {
        $consultar = new ControladorLocal();
        $respuesta = $consultar->consultarLocalAjaxControlador($this->local);
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => $value['nombre_local'],
                'id' => $value['id_local'],
            );
        }

        print json_encode($datos);
    }

    function consultarProductoAjax()
    {
        $consultar = new ControladorProducto();
        $respuesta = $consultar->consultarProductoAjaxControlador($this->producto, '');
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => $value['nombre_producto'],
                'id' => $value['id_producto'],
                'precio' => number_format($value['precio_unitario'], 0),
                'codigo' => $value['codigo_producto'],
                'cantidad' => $value['cantidad_producto'],
                'id_categoria' => $value['id_categoria'],
                'nombre_categoria' => $value['nombre_categoria'],
                'id_medida' => $value['id_medida'],
                'nombre_medida' => $value['nombre_medida'],
                'id_local' => $value['id_local'],
                'nombre_local' => $value['nombre_local']
            );
        }

        print json_encode($datos);
    }

    function consultarIngredienteAjax()
    {
        $consultar = new ControladorIngredientes();
        $respuesta = $consultar->consultarIngredeinteAjaxControlador($this->ingrediente);
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => $value['nombre_ingrediente'],
                'id' => $value['id_ingrediente'],
                'medida' => $value['nombre_medida'],
                'id_medida' => $value['id_medida'],
                'local' => $value['nombre_local'],
                'id_local' => $value['id_local'],
                'cantidad' => $value['cantidad']
            );
        }

        print json_encode($datos);
    }

    function consultarproductoPedidoAjax()
    {
        $consultar = new ControladorIngredienteProducto();
        $respuesta = $consultar->consultarIngredeinteAjaxControlador($this->Pedido, $this->id_local);
        $consultar = new ModeloIngredienteProducto();
        foreach ($respuesta as $key => $value) {
            $res = $consultar->consultarIngredeinteAjaxModelo($value['id_producto'], $this->id_local);
            if ($res[0]['id_producto'] == null) {
                $datos[] = array(
                    'label' => $value['nombre_producto'],
                    'id' => $value['id_producto'],
                    'descripcion' => (isset($value["GROUP_CONCAT(nombre_ingrediente SEPARATOR ', ')"])) ? $value["GROUP_CONCAT(nombre_ingrediente SEPARATOR ', ')"] : null,
                    'precio' => number_format($value['precio_unitario'], 0),
                );
            } else {
                foreach ($res as $key => $valu) {
                    $datos[] = array(
                        'precio' => number_format($value['precio_unitario'], 0),
                        'label' => $valu['nombre_producto'],
                        'id' => $valu['id_producto'],
                        'descripcion' => (isset($valu["GROUP_CONCAT(nombre_ingrediente SEPARATOR ', ')"])) ? $valu["GROUP_CONCAT(nombre_ingrediente SEPARATOR ', ')"] : null
                    );
                }
            }
        }

        print json_encode($datos);
    }

    function consultarPedidoPrintAjax()
    {
        $resPedido = new ControladorPedido();
        $respe = $resPedido->listarPedidoCocinaPrint($this->id_mesa, $this->fecha);
        foreach ($respe as $key => $value) {
            $datos[] = array('nombre' => $value['producto'], 'cantidad' => $value['cantidad'], 'descripcion' => (isset($value['descripcion'])) ? $value['descripcion'] : " ");
        }
        header('Content-Type: text/html; charset=UTF-8');
        print json_encode($datos);
    }

    function consultarMesaPrintAjax()
    {
        $resPedido = new ControladorPedido();
        $respe = $resPedido->buscarMesaUsuarioId($this->id_mesa, $this->fecha);
        foreach ($respe as $key => $value) {
            $datos[] = array('nombre' => $value['primer_nombre'], 'apellido' => $value['primer_apellido'], 'mesa' => $value['nombre_mesa']);
        }
        header('Content-Type: text/html; charset=UTF-8');
        print json_encode($datos);
    }

    function listarPedidoPrintAjax()
    {
        $resPedido = new ControladorPedido();
        $respe = $resPedido->listarPedidoPrintAjaxControlador($this->print);
        foreach ($respe as $key => $value) {
            $datos[] = array('nombre' => $value['producto'], 'cantidad' => $value['cantidad'], 'descripcion' => (isset($value['descripcion'])) ? $value['descripcion'] : " ", 'categoria' => $value['nombre_categoria']);
        }
        header('Content-Type: text/html; charset=UTF-8');
        print json_encode($datos);
    }

    function listarPedidoPrintDomicilioAjax()
    {
        $resDomicilio = new ControladorDomicilio();
        $res = $resDomicilio->listarPedidoDomicilioPrintAjaxControlador($this->printDomicilio);
        foreach ($res as $key => $value) {
            $datos[] = array('nombre' => $value['producto'], 'cantidad' => $value['cantidad'], 'descripcion' => (isset($value['descripcion'])) ? $value['descripcion'] : " ", 'categoria' => $value['nombre_categoria']);
        }
        header('Content-Type: text/html; charset=UTF-8');
        print json_encode($datos);
    }

    function listarPedidoPrintUsurioAjax()
    {
        $resPedido = new ControladorPedido();
        $respe = $resPedido->listarPedidoPirntFechaUsuarioIngresoAjaxControlador($this->printUsuario);
        foreach ($respe as $key => $value) {
            $datos[] = array('nombre' => $value['primer_nombre'], 'apellido' => $value['primer_apellido'], 'mesa' => $value['nombre_mesa']);
        }
        header('Content-Type: text/html; charset=UTF-8');
        print json_encode($datos);
    }

    function listarPedidoDomicilioPrintUsurioAjax()
    {
        $resPedido = new ControladorDomicilioPedido();
        $respe = $resPedido->listarPedidoPirntFechaUsuarioIngresoDomicilioAjaxControlador($this->printCliente);
        foreach ($respe as $key => $value) {
            $datos[] = array('nombre' => $value['nombre'], 'id' => $value['id_domicilio_pedido']);
        }
        header('Content-Type: text/html; charset=UTF-8');
        print json_encode($datos);
    }

    function ActualizarPedidoMesa()
    {
        $resPedido = new ControladorPedido();
        $respe = $resPedido->ActualizarPedidoMesaAjaxControlador($this->respuestaPrint, $this->id_mesa);
        print $respe;
    }

    function ActualizarPedidoDomicilio()
    {
        $resPedido = new ControladorDomicilio();
        $respe = $resPedido->ActualizarPedidoDomicilioAjaxControlador($this->respuestaPrintDomicilio, $this->id_mesa);
        print $respe;
    }

    function buscarClienteCC()
    {
        $consultar_cliente = new ControladorCLiente();
        $res = $consultar_cliente->consultarClienteAjax($this->cc);
        foreach ($res as $key => $value) {
            $datos[] = array(
                'label1' => $value['numero_cc'],
                'label' => $value['primer_nombre'] . " " . $value['primer_apellido'],
                'id' => $value['id_cliente']
            );
        }

        print json_encode($datos);
    }

    function consultarAritucloProeevedorNombre()
    {
        $consultar_id = new ControladorProducto();
        $res = $consultar_id->consultarAritucloProeevedoridAjax($this->articulo);
        foreach ($res as $key => $value) {
            $datos[] = array(
                'value' => $value['id_producto'],
                'label' => $value['nombre_producto']
            );
        }

        print json_encode($datos);
    }

    function consultarAritucloProeevedor()
    {
        $consultar_id = new ControladorProducto();
        $res = $consultar_id->consultarAritucloProeevedorAjax($this->idArticulo);

        print json_encode($res);
    }

    function consultarNominaPedidoAjax()
    {
        $resPedido = new ControladorNomina();
        $respe = $resPedido->consultarNominaPedidoAjax($this->id_nomina);
        foreach ($respe as $key => $value) {
            $datos[] = array('nombre' => $value['nombre'] . " " . $value['apellido'], 'dias' => $value['dias_trabajados'], 'ValorTotal' => $value['pago'],);
        }
        header('Content-Type: text/html; charset=UTF-8');
        print json_encode($datos);
    }

    function consultarFacturaDevolucionAjax()
    {
        $factura = new ControladorVenta();
        $res = $factura->consultarFacturaDevolucionAjax($this->factura);
        foreach ($res as $key => $value) {
            $datos[] = array('label' => $value['nombre_producto'], 'label1' => $value['codigo_producto'], 'label2' => $value['cantidad'], 'precio' => $value['valor_unitario'], 'total' => $value['precio_compra'], 'id' => $value['id_producto'], 'efectivo' => $value['total_factura'], 'id_factura' => $value['id_factura']);
        }
        print json_encode($datos);
    }

    function actualizarPropinaFacturaAjax()
    {
        $propina = new ControladorPropina();
        $res = $propina->actualizarPropinaAjax(str_replace(',', '', $this->propina), $this->id_factura);
    }

    function consultarAritucloProeevedorAgregarFactura()
    {
        $consultar_id = new ControladorProducto();
        $res = $consultar_id->consultarAritucloProeevedoridAjax($this->articulo);
        foreach ($res as $key => $value) {
            $datos[] = array(
                'value' => $value['id_producto'],
                'label' => $value['codigo_producto'],
            );
        }

        print json_encode($res);
    }

    function consultarImpuestoAjax()
    {
        $consultar = new ControladorImpuesto();
        $respuesta = $consultar->listarImpuestoAjaxControlador($this->impuesto);
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => "0" . $value['numero_impuesto'] . $value['nombre_impusto'],
                'id' => $value['id_impuesto'],
            );
        }

        print json_encode($datos);
    }
}

$ajax = new Ajax();

if (isset($_GET['proeevedor'])) {
    $ajax->proeevedor = $_GET['proeevedor'];
    $ajax->consultarProeevedorAjax();
}

if (isset($_GET['medida'])) {
    $ajax->medida = $_GET['medida'];
    $ajax->consultarMedidaAjax();
}

if (isset($_GET['categoria'])) {
    $ajax->categoria = $_GET['categoria'];
    $ajax->consultarCategoriaAjax();
}

if (isset($_GET['local'])) {
    $ajax->local = $_GET['local'];
    $ajax->consultarLocalAjax();
}

if (isset($_GET['producto'])) {
    $ajax->producto = $_GET['producto'];
    $ajax->consultarProductoAjax();
}

if (isset($_GET['ingrediente'])) {
    $ajax->ingrediente = $_GET['ingrediente'];
    $ajax->consultarIngredienteAjax();
}

if (isset($_GET['productoPedido'])) {
    $ajax->Pedido = $_GET['productoPedido'];
    $ajax->id_local = '';
    $ajax->consultarproductoPedidoAjax();
}

if (isset($_GET['productoDomicilio']) && isset($_GET['id'])) {
    $ajax->Pedido = $_GET['productoDomicilio'];
    $ajax->id_local = $_GET['id'];
    $ajax->consultarproductoPedidoAjax();
}

if (isset($_GET['id_mesa']) && isset($_GET['fecha'])) {
    $ajax->id_mesa = $_GET['id_mesa'];
    $ajax->fecha = $_GET['fecha'];
    $ajax->consultarPedidoPrintAjax();
}

if (isset($_GET['id_mesa']) && isset($_GET['fechaActual'])) {
    $ajax->id_mesa = $_GET['id_mesa'];
    $ajax->fecha = $_GET['fechaActual'];
    $ajax->consultarMesaPrintAjax();
}

if (isset($_GET['print'])) {
    $ajax->print = $_GET['print'];
    $ajax->listarPedidoPrintAjax();
}

if (isset($_GET['printDomicilio'])) {
    $ajax->printDomicilio = $_GET['printDomicilio'];
    $ajax->listarPedidoPrintDomicilioAjax();
}

if (isset($_GET['printUsuario'])) {
    $ajax->printUsuario = $_GET['printUsuario'];
    $ajax->listarPedidoPrintUsurioAjax();
}

if (isset($_GET['printCliente'])) {
    $ajax->printCliente = $_GET['printCliente'];
    $ajax->listarPedidoDomicilioPrintUsurioAjax();
}

if (isset($_GET['respuestaPrint']) && isset($_GET['id'])) {
    $ajax->respuestaPrint = $_GET['respuestaPrint'];
    $ajax->id_mesa = $_GET['id'];
    $ajax->ActualizarPedidoMesa();
}

if (isset($_GET['respuestaPrintDomicilio']) && isset($_GET['id'])) {
    $ajax->respuestaPrintDomicilio = $_GET['respuestaPrintDomicilio'];
    $ajax->id_mesa = $_GET['id'];
    $ajax->ActualizarPedidoDomicilio();
}

if (isset($_GET['cc'])) {
    $ajax->cc = $_GET['cc'];
    $ajax->buscarClienteCC();
}

if (isset($_GET['nombre'])) {
    $ajax->articulo = $_GET['nombre'];
    $ajax->consultarAritucloProeevedorNombre();
}

if (isset($_GET['id_nomina'])) {
    $ajax->id_nomina = $_GET['id_nomina'];
    $ajax->consultarNominaPedidoAjax();
}

if (isset($_GET['factura'])) {
    $ajax->factura = $_GET['factura'];
    $ajax->consultarFacturaDevolucionAjax();
}

$request = 0;
if (isset($_GET['request'])) {
    $request = $_GET['request'];
}
if ($request == 2) {
    $userid = 0;
    if (isset($_GET['userid'])) {
        $ajax->idArticulo = $_GET['userid'];
        $ajax->consultarAritucloProeevedor();
    }
}

if (isset($_GET['nuevo_valor']) && isset($_GET['id_factura'])) {
    $ajax->propina = $_GET['nuevo_valor'];
    $ajax->id_factura = $_GET['id_factura'];
    $ajax->actualizarPropinaFacturaAjax();
}

if (isset($_GET['codigo1'])) {
    $ajax->articulo = $_GET['codigo1'];
    $ajax->consultarAritucloProeevedorAgregarFactura();
}

if (isset($_GET['impuesto'])) {
    $ajax->impuesto = $_GET['impuesto'];
    $ajax->consultarImpuestoAjax();
}

////
try {
    // Leer el cuerpo de la solicitud
    $input = json_decode(file_get_contents('php://input'), true);

    // Verificar la acción solicitada
    if (isset($input['action']) && $input['action'] === 'actualizarPrint') {
        $id = $input['id_domicilio_pedido'] ?? null;

        if ($id) {
            // Llamar al modelo para realizar la actualización
            $modeloPedidos = new ModeloDomicilio();
            $resultado = $modeloPedidos->actualizarPrintDomicilio($id);

            if ($resultado) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No se pudo actualizar la base de datos.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'ID no válido.']);
        }
    } elseif (isset($input['action']) && $input['action'] === 'actualizarCancel') {
        $id = $input['id_domicilio_pedido'] ?? null;

        if ($id) {
            // Llamar al modelo para realizar la actualización
            $modeloPedidos = new ModeloDomicilio();
            $resultado = $modeloPedidos->actualizarCanceDomicilio($id);

            if ($resultado) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No se pudo actualizar la base de datos.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'ID no válido.']);
        }
    } elseif (isset($input['action']) && $input['action'] === 'actualizarLlevar') {
        $id = $input['id_domicilio_pedido'] ?? null;

        if ($id) {
            // Llamar al modelo para realizar la actualización
            $modeloPedidos = new ModeloDomicilio();
            $resultado = $modeloPedidos->actualizarLlevarDomicilio($id);

            if ($resultado) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No se pudo actualizar la base de datos.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'ID no válido.']);
        }
    } elseif (isset($input['action']) && $input['action'] === 'actualizarEntrega') {
        $id = $input['id_domicilio_pedido'] ?? null;

        if ($id) {
            // Llamar al modelo para realizar la actualización
            $modeloPedidos = new ModeloDomicilio();
            $resultado = $modeloPedidos->actualizarEntregaDomicilio($id);

            if ($resultado) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No se pudo actualizar la base de datos.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'ID no válido.']);
        }
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
////Notificacion de domicilio
// Verificar la acción solicitada

try {
    if (isset($_POST['action']) && $_POST['action'] === 'verificarNuevosDomicilios') {
        // Obtener el último ID del domicilio
        $ultimoId = isset($_POST['ultimoId']) ? (int)$_POST['ultimoId'] : 0;

        // Llamar a un modelo o consulta que busque nuevos domicilios
        $modeloPedidos = new ModeloDomicilio();
        $nuevosDomicilios = $modeloPedidos->obtenerNuevosDomicilios($ultimoId);
        foreach ($nuevosDomicilios as $key => $value) {
            $notificado = new ModeloDomicilioPedido();
            $notificado->actualziarNotificación($value['id_domicilio_pedido']);
        }
        // Retornar los nuevos domicilios en formato JSON
        echo json_encode([
            'success' => true,
            'nuevos' => $nuevosDomicilios,
        ]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
exit;

