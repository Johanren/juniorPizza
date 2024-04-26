<?php

if (isset($_GET['action'])) {
    if ($_GET['action'] == "agregarProeevedor") {
        print '<script>
        swal("Hurra!!!", "El proeevedor ha sido registrado correctamente", "success");
    </script>';
    }
}
if (isset($_GET['id'])) {
    print "<script>$(document).ready(function() {
        $('#exampleModal').modal('toggle')
    });</script>";
    $mostrarProee = new ControladorProeevedor();
    $resProee = $mostrarProee->consultarProeevedor();

    $mostrarProducto = new ControladorFacturaProeevedor();
    $resProducto = $mostrarProducto->listarFacturaProducto();
}
///Usuario
$user = new ControladorFacturaProeevedor();
$res = $user->listarProeevedorFactura();

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6">
            <form action="" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="date" name="fecha" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <button class="btn btn-primary" name="buscar">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table id="proevedor" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th># Nit</th>
                    <th>Nombre Proeevedor</th>
                    <th>Fecha Factura</th>
                    <th>Total a pagar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($res as $key => $value) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $value['nit_proeevedor'] ?>
                        </td>
                        <td>
                            <?php echo $value['nombre_proeevedor'] ?>
                        </td>
                        <td>
                            <?php echo $value['pago_factura'] ?>
                        </td>
                        <td>
                            <?php echo $value['fecha_ingreso'] ?>
                        </td>
                        <td>
                            <a
                                href="index.php?action=facturaProeevedor&id=<?php echo $value['id_proeevedor'] ?>&fecha=<?php echo $value['fecha_ingreso'] ?>"><button
                                    class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                    </svg></button></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th># Nit</th>
                    <th>Nombre Proeevedor</th>
                    <th>Fecha Factura</th>
                    <th>Total a pagar</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Factura Proeevedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row mt-2" style="text-align: center;">
                        <div class="form-group col-md-3"></div>
                        <div class="form-group col-md-6">
                            Proeevedor: <span id="nom_proeevedor">
                                <?php echo $resProee[0]['nombre_proeevedor'] ?>
                            </span><br>
                            Nit: <span id="nit_proeevedor">
                                <?php echo $resProee[0]['nit_proeevedor'] ?>
                            </span><br>
                            Telefono: <span id="tel_proeevedor">
                                <?php echo $resProee[0]['telefono_proeevedor'] ?>
                            </span><br>
                            Dirección: <span id="dir_proeevedor">
                                <?php echo $resProee[0]['direccion_proeevedor'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table mt-2" id="producto">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Categoria</th>
                                    <th>Medida</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($resProducto as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value['codigo_producto'] ?></td>
                                        <td><?php echo $value['nombre_producto'] ?></td>
                                        <td><?php echo $value['precio_unitario'] ?></td>
                                        <td><?php echo $value['cantidad_producto'] ?></td>
                                        <td><?php echo $value['nombre_categoria'] ?></td>
                                        <td><?php echo $value['nombre_medida'] ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>