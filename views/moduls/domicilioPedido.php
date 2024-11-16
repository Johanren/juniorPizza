<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "pedidoCancelado") {
        print '<script>
                swal("Ops!", "Tu Pedido Fue Cancelado Con Exito", "success");
            </script>';
    }
}
?>
<script>
    $(document).ready(function() {
        // Abre el modal `#reporte` al hacer clic en el botón `#reportes`
        $('#boton').on('click', function() {
            $('#modal').modal('toggle');
        });
        $('#clouse').on('click', function() {
            $('#modal').modal('hide');
        });
        $('#cerrar').on('click', function() {
            $('#modal').modal('hide');
        });
    })
</script>
<div class="container mt-5">
    <!-- Button trigger modal -->
    <button type="button" id="boton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Consultar Domicilio
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Domicilio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="clouse" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="number" name="numero" class="form-control" placeholder="Digite Numero De Domicilio" required>
                        <button name="consult" class="btn btn-primary mt-3">Consultar</button>
                    </form>
                    <?php
                    if (isset($_POST['consult'])) {
                        echo '<script>window.location="index.php?action=domicilioEnviado&domicilio=' . $_POST['numero'] . '"</script>';
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cerrar" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <form action="" method="post">
        <div class="row">
            <div class="col">
                <h1 style="text-align: center;">Generar Pedido</h1>
                <input type="hidden" class="form-control" name="id_local" id="id_local_1">
                <input type="text" class="form-control nom_local mt-5" id="local_1" placeholder="Escriba el local para domicilio" required>
                <div class="form-row mt-3">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="nombre" placeholder="Digite Su nombre" required>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="number" class="form-control" name="tel1" placeholder="Digite Su Numero Telefonico" required>
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="number" class="form-control" name="tel2" placeholder="Digite Su Numero Telefono (Opcional)">
                    </div>
                    <div class="form-group col-md-6">
                        <input name="direccion" id="" class="form-control" required placeholder="Su Dirección"></input>
                    </div>
                    <div class="form-group col-md-6">
                        <select name="metodo" id="metodo" class="form-control" required>
                            <option value="">Seleccionar Metodo Pago...</option>
                            <option value="efectivo">Efectivo</option>
                            <option value="nequi">Nequi</option>
                            <option value="daviplata">Daviplata</option>
                            <option value="transfferencia">Transferencia</option>
                        </select>
                    </div>
                </div>
            </div>
            <a id="agregarPedido" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-node-plus" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8M6.025 7.5a5 5 0 1 1 0 1H4A1.5 1.5 0 0 1 2.5 10h-1A1.5 1.5 0 0 1 0 8.5v-1A1.5 1.5 0 0 1 1.5 6h1A1.5 1.5 0 0 1 4 7.5zM11 5a.5.5 0 0 1 .5.5v2h2a.5.5 0 0 1 0 1h-2v2a.5.5 0 0 1-1 0v-2h-2a.5.5 0 0 1 0-1h2v-2A.5.5 0 0 1 11 5M1.5 7a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                </svg>
            </a>
            <div class="table-responsive">
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="pedidoProducto">
                        <tr class="eliminar_1">
                            <td><input type="hidden" name="id_pedido[]" id="id_predido_1"><input type="text" name="producto[]" class="form-control productoDomicilio" required id="producto_1" placeholder="Producto"></td>
                            <th><textarea name="descripcion[]" id="descripcion_1" class="form-control" cols="30" rows="1"></textarea></th>
                            <th><input type="hidden" name="precio[]" class="form-control valor" id="precio_1" placeholder="Precio"><input type="text" name="" class="form-control valor" id="valor_1" placeholder="Precio" disabled></th>
                            <th><input type="text" name="cantidad[]" class="form-control cantidad" placeholder="Cantidad Pedido" id="cantidad_1" value="0" required></th>
                            <th><input type="text" name="total" class="form-control resultado" id="resultado_1" disabled></th>
                            <th><a class="btn btn-primary eliminar" id="eliminarFactura"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                    </svg></a></th>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td><input type="text" value="Domicilio" class="form-control" disabled></td>
                            <th><textarea name="" id="descripcion_1" class="form-control" cols="30" rows="1" disabled></textarea></th>
                            <th><input type="text" name="" class="form-control valor" id="valor_50" placeholder="Precio" value="5,000" disabled></th>
                            <th><input type="text" name="" class="form-control cantidad" placeholder="Cantidad Pedido" id="cantidad_50" value="1" required></th>
                            <th><input type="text" name="total" class="form-control resultado" id="resultado_50" value="<?php echo number_format($total = 5000 * 1, 0) ?>" disabled></th>
                            <th></th>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><input type="text" class="form-control factura" name="total_Factura" id="total_1" disabled>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="submit" name="agregarPedido" class="btn btn-primary">Agregar</button>
        </div>
    </form>
</div>
<?php
$agregar = new ControladorDomicilioPedido();
$agregar->agregarDomicilioPedido();
?>