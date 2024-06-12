<?php
$cosultarDeuda = new ControladorFactura();
$resConsul = $cosultarDeuda->listarDeudoresFactura();
if (isset($_GET['id_factura'])) {
    print "<script>$(document).ready(function() {
        $('#deudor').modal('toggle')
    });</script>";
}
?>
<h1 style="text-align: center;">Deudores</h1>
<div class="container mt-5">
    <table class="table mt-5" id="usuario">
        <thead>
            <tr>
                <th>Número factura</th>
                <th>Deudor</th>
                <th>Número Documento</th>
                <th>Deuda</th>
                <?php
                if (isset($_SESSION['dueda'])) {
                    if ($_SESSION['dueda'] == 'true') {

                ?>
                        <th>Cuotas</th>
                        <th>Cuotas * dueda</th>
                <?php
                    }
                }
                ?>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resConsul as $key => $value) {
                if ($value['cambio'] < 0) {
            ?>
                    <tr>
                        <td>
                            <?php echo $value['id_factura'] ?>
                        </td>
                        <td>
                            <?php echo $value['nomCli'] . " " . $value['apellCli'] ?>
                        </td>
                        <td>
                            <?php echo $value['numero_cc'] ?>
                        </td>
                        <td>
                            <?php echo number_format($value['cambio'], 0) ?>
                        </td>
                        <?php
                        if (isset($_SESSION['dueda'])) {
                            if ($_SESSION['dueda'] == 'true') {

                        ?>
                                <td><?php echo $value['cuotas'] ?></td>
                                <td><?php if ($value['cuotas'] == 0) {
                                    echo number_format(0, 0);
                                    } else {
                                        $cuota = abs($value['cambio']) / $value['cuotas'];
                                        echo number_format($cuota, 0);
                                    }
                                    ?></td>
                        <?php
                            }
                        }
                        ?>
                        <td>
                            <?php echo $value['nomUsu'] . " " . $value['usuApell'] ?>
                        </td>
                        <td>
                            <?php echo $value['fecha_factura'] ?>
                        </td>
                        <td><a href="index.php?action=deudores&id_factura=<?php echo $value['id_factura'] ?>"><i class="fas fa-print fa-lg"></i></a></td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="deudor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $local = new ControladorLocal();
                $res = $local->consultarLocal($_SESSION['id_local']);
                //
                $agregarFactura = new ModeloFactura();
                $resUltimoId = $agregarFactura->mostrarUltimoId();
                $id_factura = $_GET['id_factura'];
                //
                $mostrarVenta = new ControladorVenta();
                $resVenta = $mostrarVenta->mostrarFacturaVenta($id_factura);
                //
                $mostrarVenta = new ModeloFactura();
                $resFactura = $mostrarVenta->mostrarFacturaVentaModelo($id_factura);
                $id_cliente = $resFactura[0]['id_cliente'];
                //
                $mostrarCliente = new ModeloCliente();
                $resCliente = $mostrarCliente->mostrarClienteFacturaVentaModelo($id_cliente);

                date_default_timezone_set('America/Mexico_City');
                $fechaActal = date('Y-m-d');
                ?>
                <h1 style="text-align: center;">Factura deudora</h1>
                <form method="post">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div style="text-align: right;">
                                    <p>FACTURA N°<span id="nom_proeevedor">
                                            <?php echo $resFactura[0]['id_factura'] ?>
                                        </span></p>
                                </div>
                                <div style="text-align: right;">
                                    Fecha:
                                    <?php
                                    echo $resFactura[0]['fecha_factura']
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
                                            <th>Propinas</th>
                                            <th></th>
                                            <!--<th></th>-->
                                            <!--<th></th>-->
                                            <th></th>
                                            <th></th>
                                            <th><?php echo number_format((isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0), 0) ?></th>
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
                                    <th>Pago</th>
                                    <th>
                                        <?php echo number_format($resFactura[0]['efectivo'], 0) ?><input type="hidden" id="" name="efectivo" class="form-control" value="<?php echo number_format($resFactura[0]['efectivo'], 0) ?>">
                                    </th>
                                    <th></th>
                                    <th>Debe</th>
                                    <th>
                                        <input type="text" id="" name="" class="form-control" disabled value="<?php echo number_format($resFactura[0]['cambio'], 0) ?>">
                                        <input type="hidden" id="deuda" name="debe" class="form-control" value="<?php echo $resFactura[0]['cambio'] ?>">
                                        <?php
                                        if (isset($_SESSION['dueda'])) {
                                            if ($_SESSION['dueda'] == 'true') {

                                        ?>
                                                <input type="hidden" name="cuota" value="<?php echo $resFactura[0]['cuotas'] ?>">
                                        <?php
                                            }
                                        }
                                        ?>
                                    </th>
                                </tr>
                            </tbody>
                            <tbody>

                                <tr>
                                    <th>Abono deuda</th>
                                    <th>
                                        <input type="text" name="abono" id="abono" class="form-control abono" required>
                                    </th>
                                    <th></th>
                                    <th>Total a deber</th>
                                    <th>
                                        <input type="text" id="Total" class="form-control" disabled>
                                    </th>
                                </tr>

                            </tbody>
                        </table>
                        <div style="text-align: right;">
                            <button name="guardar" class="btn btn-primary"><i class="fas fa-save fa-lg"></i></button>
                        </div>
                    </div>
                </form>
                <?php
                $cosultarDeuda = new ControladorFactura();
                $cosultarDeuda->actualizarDeudaFactura();
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>