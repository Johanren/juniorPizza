<?php
$local = new ControladorLocal();
$res = $local->consultarLocal($_SESSION['id_local']);
$consumidor = new ControladorCliente();
$resConsu = $consumidor->consumidorFinalCompra();
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
<div class="container mt-2">
    <div class="row">
        <div class="col-sm-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-terminal-plus" viewBox="0 0 16 16">
                    <path d="M2 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h5.5a.5.5 0 0 1 0 1H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v4a.5.5 0 0 1-1 0V4a1 1 0 0 0-1-1z" />
                    <path d="M3.146 5.146a.5.5 0 0 1 .708 0L5.177 6.47a.75.75 0 0 1 0 1.06L3.854 8.854a.5.5 0 1 1-.708-.708L4.293 7 3.146 5.854a.5.5 0 0 1 0-.708M5.5 9a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5" />
                </svg>
            </button>
        </div>
    </div>
    <div style="text-align: right;">
        Fecha:
        <?php
        date_default_timezone_set('America/Mexico_City');
        print $fechaActal = date('Y-m-d');
        ?>
    </div>
    <form action="" method="post">
        <div class="row mt-3">
            <div class="col">
                <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $resConsu[0]['id_cliente'] ?>">
                <input type="text" name="cc" id="cc" placeholder="Ingresar número cc" class="form-control" required value="<?php echo $resConsu[0]['numero_cc'] ?>">
            </div>
            <div class="col">
                <input type="text" name="cliente" id="cliente" class="form-control" disabled value="<?php echo $resConsu[0]['primer_nombre'] . " " . $resConsu[0]['primer_apellido'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col">
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
        <a class="btn btn-primary mt-3" id="agregarFactura">Agregar</a>

        <div class="table-responsive">
            <?php
            if (isset($_GET['id_mesa'])) {
                $pedido = new ControladorPedido();
                $litarProducto = $pedido->listarPedidoFactura();
            ?>
                <table class="table mt-5 table-hover">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <!--<th>Precio descuento</th>-->
                            <!--<th>Peso</th>-->
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="factura">
                        <?php
                        foreach ($litarProducto as $key => $value) {
                        ?>
                            <tr class="eliminar_<?php echo $key + 1 ?>">
                                <td><input type="hidden" name="id_articulo[]" id="id_articulo_<?php echo $key + 1 ?>" value="<?php echo $value['id_producto'] ?>"><input type="text" name="codigo" class="form-control codigo_articulo" id="codigo_1" placeholder="Codigo producto" value="<?php echo $value['codigo_producto'] ?>"></td>
                                <td><input type="text" name="articulo" class="form-control nombre_articulo" id="nombre_<?php echo $key + 1 ?>" placeholder="Nombre producto" value="<?php echo $value['nombre_producto'] ?>"></td>
                                <td><input type="text" name="precio" class="form-control valor" id="valor_<?php echo $key + 1 ?>" value="<?php echo number_format($value['precio_unitario'], 0) ?>" disabled></td>
                                <!--<td><input type="text" name="descuento[]" class="form-control" id="descuento_1" value="0"></td>-->
                                <!--<td><input type="text" name="peso[]" class="form-control peso" id="peso_1" value="0" required>-->
                                <td><input type="text" name="cantidad[]" class="form-control cantidad" id="cantidad_<?php echo $key + 1 ?>" value="<?php echo $value['cantidad'] ?>" value="0" required>
                                </td>
                                <td><input type="text" name="total" class="form-control resultado" value="<?php echo number_format($value['precio_unitario'] * $value['cantidad'], 0) ?>" id="resultado_<?php echo $key + 1 ?>" disabled>
                                </td>
                                <td><a class="btn btn-primary mt-3 eliminar" id="eliminarFactura">Eliminar</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tbody>
                        <tr>
                            <th>SubTotal</th>
                            <th></th>
                            <!--<th></th>-->
                            <!--<th></th>-->
                            <th></th>
                            <th></th>
                            <th><input type="text" class="form-control factura" name="total_Factura" id="total" disabled>
                            </th>
                        </tr>
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
                                    <th><input type="text" class="form-control propina" name="propina" id="propina">
                                    </th>
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
                            <th><input type="text" class="form-control factura" name="total_Factura" id="total_1" disabled>
                            </th>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <th>Metodo Pago</th>
                            <th><select name="metodo" id="metodo" class="form-control" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="efectivo">Efectivo</option>
                                    <option value="nequi">Nequi</option>
                                    <option value="daviplata">Daviplata</option>
                                    <option value="transfferencia">Transferencia</option>
                                    <option value="member">Membrecia</option>
                                </select></th>
                            <th>Paga</th>
                            <th><input type="text" class="form-control pago" disabled name="pago" id="pago_1" required></th>
                            <!--<th></th>-->
                            <th>Cambio</th>
                            <th><input type="text" class="form-control" name="cambio" id="cambio_1" disabled></th>
                        </tr>
                    </tbody>
                </table>
            <?php
            } else {
            ?>
                <table class="table mt-5 table-hover">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <!--<th>Precio descuento</th>-->
                            <!--<th>Peso</th>-->
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="factura">
                        <tr class="eliminar_1">
                            <td><input type="hidden" name="id_articulo[]" id="id_articulo_1"><input type="text" name="codigo" <?php if (!isset($_SESSION['caja'])) {
                                                                                                                                    echo "disabled";
                                                                                                                                } ?> class="form-control codigo_articulo" id="codigo_1" placeholder="Codigo producto"></td>
                            <td><input type="text" name="articulo" class="form-control nombre_articulo" id="nombre_1" placeholder="Nombre producto" <?php if (!isset($_SESSION['caja'])) {
                                                                                                                                                        echo "disabled";
                                                                                                                                                    } ?>></td>
                            <td><input type="text" name="precio" class="form-control valor" id="valor_1" disabled></td>
                            <!--<td><input type="text" name="descuento[]" class="form-control" id="descuento_1" value="0"></td>-->
                            <!--<td><input type="text" name="peso[]" class="form-control peso" id="peso_1" value="0" required>-->
                            <td><input type="text" name="cantidad[]" class="form-control cantidad" id="cantidad_1" value="0" required>
                            </td>
                            <td><input type="text" name="total" class="form-control resultado" id="resultado_1" disabled>
                            </td>
                            <td><a class="btn btn-primary mt-3 eliminar" id="eliminarFactura">Eliminar</a></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <th>Total</th>
                            <th></th>
                            <!--<th></th>-->
                            <!--<th></th>-->
                            <th></th>
                            <th></th>
                            <th><input type="text" class="form-control factura" name="total_Factura" id="total_1" disabled>
                            </th>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <th>Metodo Pago</th>
                            <th><select name="metodo" id="metodo" class="form-control" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="efectivo">Efectivo</option>
                                    <option value="nequi">Nequi</option>
                                    <option value="daviplata">Daviplata</option>
                                    <option value="transfferencia">Transferencia</option>
                                    <option value="member">Membrecia</option>
                                </select></th>
                            <th>Paga</th>
                            <th><input type="text" class="form-control pago" name="pago" id="pago_1" required></th>
                            <!--<th></th>-->
                            <th>Cambio</th>
                            <th><input type="text" class="form-control" name="cambio" id="cambio_1" disabled></th>
                        </tr>
                        <!--<tr>
                            <th>Metodo Pago 2</th>
                            <th><select name="metodo2" id="metodo2" class="form-control" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="nequi">Nequi</option>
                                    <option value="daviplata">Daviplata</option>
                                    <option value="transferencia">Transferencia</option>
                                </select></th>
                            <th>Paga</th>
                            <th><input type="text" class="form-control pago" name="pago2" id="pago_2" required></th>
                            <th>Cambio</th>
                            <th><input type="text" class="form-control" name="cambio2" id="cambio_2" disabled></th>
                        </tr>-->
                    </tbody>
                </table>
            <?php
            }
            ?>

        </div>
        <div style="text-align: right;">
            <button id="Imprimir" class="btn btn-primary preFactrua"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-receipt-cutoff" viewBox="0 0 16 16">
                    <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z" />
                    <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118z" />
                </svg></button>
            <button name="agregarFactrua" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1" />
                </svg></button>
        </div>
    </form>

</div>
<?php
$agregarFactura = new ControladorFactura();
$agregarFactura->agregarFactura();
$mesa = new ControladorPedido();
$listar = $mesa->listarPedidoMesaFactura();
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Factura Mesa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="usuario" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Mesa</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listar as $key => $value) {
                        ?>
                            <tr>
                                <td><?php echo $value['nombre_mesa'] ?></td>
                                <th><a href="index.php?action=caja&id_mesa=<?php echo $value['id_mesa'] ?>"><i class="fas fa-fingerprint fa-lg"></i></a></th>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="columns">
        <div class="column">
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="select is-rounded">
                <select hidden id="listaDeImpresoras"></select>
            </div>
            <div class="field">
                <!--<label class="label">Separador</label>-->
                <div class="control">
                    <input hidden id="separador" value=" " class="input" type="text" maxlength="1" placeholder="El separador de columnas">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Relleno</label>-->
                <div class="control">
                    <input hidden id="relleno" value=" " class="input" type="text" maxlength="1" placeholder="El relleno de las celdas">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para el nombre</label>-->
                <div class="control">
                    <input hidden id="maximaLongitudNombre" value="20" class="input" type="number">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para la cantidad</label>-->
                <div class="control">
                    <input hidden id="maximaLongitudCantidad" value="8" class="input" type="number">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para el precio</label>-->
                <div class="control">
                    <input hidden id="maximaLongitudPrecio" value="8" class="input" type="number">
                </div>
            </div>
        </div>
    </div>
</div>