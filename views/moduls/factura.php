<?php

if (isset($_GET['action'])) {
    if ($_GET['action'] == "agregarGasto") {
        print '<script>
        swal("Hurra!!!", "Gasto agregardo exitosamente", "success");
    </script>';
    }
    if ($_GET['action'] == "actualizarGasto") {
        print '<script>
        swal("Hurra!!!", "Gasto actualizado exitosamente", "success");
    </script>';
    }
    if ($_GET['action'] == "eliminarGasto") {
        print '<script>
        swal("Hurra!!!", "Gasto eliminado exitosamente", "success");
    </script>';
    }
}
///Usuario
$user = new ControladorObservacionFactura();
$res = $user->listarObservacionFactura();
if (isset($_GET['id_factura'])) {
    print "<script>$(document).ready(function() {
        $('#verFactura').modal('toggle')
    });</script>";
    $listar = $user->listarObservacionFacturaId();

}
?>
<div class="container mt-5">
    <form method="post" class="mt-3">
        <div class="row mt-3">
            <div class="col-sm-3">
                <input type="text" class="form-control" id="plateNumber" required placeholder="Número De Placa" name="placa">
            </div>
            <div class="col-sm-3">
                <button type="hidden" name="consultar" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
    <br>
    <div class="table-responsive">
        <table id="usuario" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>N °Factura</th>
                    <th>Placa</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['consultar'])) {
                    foreach ($res as $key => $value) {

                ?>
                        <tr>
                            <td>
                                <?php echo $value['id_factura'] ?>
                            </td>
                            <td>
                                <?php echo $value['placa'] ?>
                            </td>
                            <td>
                                <?php echo $value['fecha_factura'] ?>
                            </td>
                            <td>
                                <?php echo number_format($value['total_factura'], 0) ?>
                            </td>
                            <td><a href="index.php?action=factura&id_factura=<?php echo $value['id_factura'] ?>"><i class="fas fa-print fa-lg"></i></a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>N °Factura</th>
                    <th>Placa</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php
$local = new ControladorLocal();
$res = $local->consultarLocal($_SESSION['id_local']);
//
$agregarFactura = new ModeloFactura();
$resUltimoId = $agregarFactura->mostrarUltimoId();
if (isset($_GET['id_factura'])) {
    $id_factura = $_GET['id_factura'];
} else {
    $id_factura = $resUltimoId[0]['MAX(id_factura)'];
}
//
$mostrarVenta = new ControladorVenta();
$resVenta = $mostrarVenta->mostrarFacturaVenta($id_factura);
//
$mostrarPropina = new ControladorPropina();
$resPropina = $mostrarPropina->listarPropina($id_factura);
//
$mostrarVenta = new ModeloFactura();
$resFactura = $mostrarVenta->mostrarFacturaVentaModelo($id_factura);
$id_cliente = $resFactura[0]['id_cliente'];
//
$mostrarCliente = new ModeloCliente();
$resCliente = $mostrarCliente->mostrarClienteFacturaVentaModelo($id_cliente);

date_default_timezone_set('America/Mexico_City');
$fechaActal = date('Y-m-d');
if ($res != null) {
    $nombreSistema = $res[0]['nombre_local'];
    $nit = $res[0]['nit'];
    $tel = $res[0]['telefono'];
    $dire = $res[0]['direccion'];
} else {
    $nombreSistema = "Inventario";
    $nit = "1111";
    $tel = "1111";
    $dire = "NNNN";
}
?>
<!-- Modal ditar-->
<div class="modal fade" id="verFactura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Factura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div style="text-align: right;">
                                <p>FACTURA N°<span id="num_factura"><?php echo $resFactura[0]['id_factura'] ?></span></p>
                            </div>
                            <div style="text-align: right;">
                                Fecha:
                                <?php
                                print $fechaActal;
                                ?>
                            </div>
                            <div class="mt-3" style="text-align: center;">
                                Sistema: <span id="nom_proeevedor">
                                    <?php if ($res != null) {
                                        echo $res[0]['nombre_local'];
                                    } else {
                                        echo "Inventario";
                                    } ?>
                                </span><br>
                                Nit: <span id="nit_proeevedor">
                                    <?php if ($res != null) {
                                        echo $res[0]['nit'];
                                    } else {
                                        echo "1111";
                                    } ?>
                                </span><br>
                                Telefono: <span id="tel_proeevedor">
                                    <?php if ($res != null) {
                                        echo $res[0]['telefono'];
                                    } else {
                                        echo "11111";
                                    } ?>
                                </span><br>
                                Dirección: <span id="dir_proeevedor">
                                    <?php if ($res != null) {
                                        echo $res[0]['direccion'];
                                    } else {
                                        echo "NNNNN";
                                    } ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="factura">
                            <?php
                            foreach ($resVenta as $key => $value) {
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $value['codigo_producto'] ?>
                                    </td>
                                    <td>
                                        <?php echo $value['nombre_producto'] ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($value['valor_unitario'], 0) ?>
                                    </td>
                                    <td>
                                        <?php if ($value['cantidad'] > 0) {
                                            echo $value['cantidad'];
                                        } else {
                                            echo $value['peso'] . " GR";
                                        } ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($value['precio_compra'], 0) ?>
                                    </td>
                                </tr>
                            <?php
                            }

                            ?>
                        </tbody>
                        <?php if (isset($_SESSION['propina'])) {
                            if ($_SESSION['propina'] == 'true') {
                        ?>
                                <tbody>
                                    <tr>
                                        <th>SubTotal</th>
                                        <th></th>
                                        <!--<th></th>-->
                                        <!--<th></th>-->
                                        <th></th>
                                        <th></th>
                                        <th><?php echo number_format($resFactura[0]['total_factura'] - (isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0), 0) ?></th>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <th>Propinas</th>
                                        <th></th>
                                        <!--<th></th>-->
                                        <!--<th></th>-->
                                        <th></th>
                                        <th></th>
                                        <th <?php if (isset($_GET['id_factura'])) {
                                                echo 'class="miTabla"';
                                            } ?>><?php echo number_format(isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0, 0) ?></th>
                                    </tr>
                                </tbody>
                        <?php }
                        } ?>
                        <tbody>
                            <tr>
                                <th>Total</th>
                                <th></th>
                                <!--<th></th>-->
                                <!--<th></th>-->
                                <th></th>
                                <th></th>
                                <th><?php echo number_format($resFactura[0]['total_factura'], 0) ?></th>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <th>Paga</th>
                                <th>
                                    <?php echo number_format($resFactura[0]['efectivo'], 0) ?>
                                </th>
                                <th></th>
                                <th>Cambio</th>
                                <th>
                                    <?php echo number_format($resFactura[0]['cambio'], 0) ?>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <h1>Datós del vehiculo</h1>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Nombre</label>
                            <input type="text" class="form-control" name="nombre" disabled value="<?php echo $listar[0]['nombre'] ?>" id="" required placeholder="Nombre encargado">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Número Placa</label>
                            <input type="text" class="form-control" name="placa" disabled value="<?php echo $listar[0]['placa'] ?>" id="plateNumber" required placeholder="Número de placa">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Observación</label>
                            <textarea name="observacion" class="form-control" disabled id="" required><?php echo $listar[0]['observacion'] ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>