<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "        ") {
        print '<script>
        swal("Hurra!!!", "Pedido agregado exitosamente", "success");
    </script>';
    }
    if ($_GET['action'] == "actualizoMesa") {
        print '<script>
        swal("Hurra!!!", "Pedido cambio de mesa", "success");
    </script>';
    }
}
///Usuario
$user = new ControladorPedido();
$res = $user->listarPedidoMesa();
if (isset($_POST['actualizarMesa'])) {
    //mesa
    $mesa = new ControladorMesa();
    $mesa->actualizarEstadoMesa('', '');
}
if (isset($_GET['id'])) {
    print "<script>$(document).ready(function() {
        $('#mesa').modal('toggle')
    });</script>";
    //mesa
    $mesa = new ControladorMesa();
    $resMesa = $mesa->buscarMesaId($_GET['id']);
}
?>
<div class="container mt-5">
    <br>
    <div class="table-responsive">
        <table id="usuario" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Mesa</th>
                    <th>Descripción Pedido</th>
                    <th>Mesero</th>
                    <th>Estado</th>
                    <th>Fecha ingreso</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($res as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $value['nombre_mesa'] ?></td>
                        <td>
                            <?php
                            $listarPedidoDescripcion = $user->listarPedidoMesaDescripcion($value['id_mesa'], $value['fecha_ingreso']);
                            foreach ($listarPedidoDescripcion as $key => $pedido) {
                                $conn = $key + 1;
                                print "<br>" . $conn . ". Producto: " . $pedido['producto'] . " <br> Descripcion: " . $pedido['descripcion'] . " <br> Cantidad: " . $pedido['cantidad'];
                            }
                            ?>
                        </td>
                        <td><?php echo $value['primer_nombre'] . " " . $value['primer_apellido'] ?></td>
                        <td><?php echo $value['nombre_estado'] ?></td>
                        <td><?php echo $value['fecha_ingreso'] ?></td>
                        <td><a
                                href="index.php?action=pedido&id=<?php echo $value['id_mesa'] ?>&mesa=<?php echo $value['nombre_mesa'] ?>&estado=<?php echo $value['id_estado_mesa'] ?>"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg></a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Mesa</th>
                    <th>Descripción Pedido</th>
                    <th>Mesero</th>
                    <th>Estado</th>
                    <th>Fecha ingreso</th>
                    <th>Accion</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- Modal Pedido -->
<div class="modal fade" id="mesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar <?php echo $_GET['mesa'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" class="form-control" value="<?php echo $_GET['id'] ?>" name="id_mesa">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputState">Mesa</label>
                            <select id="inputState" name="mesa" class="form-control">
                                <option selected>Choose...</option>
                                <?php
                                foreach ($resMesa as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['id_mesa'] ?>" <?php if ($value['id_mesa'] == $_GET['id']) {
                                           echo 'selected';
                                       } ?>>
                                        <?php echo $value['nombre_mesa'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Estado</label>
                            <select id="" name="estado" class="form-control">
                                <option selected>Choose...</option>
                                <?php
                                foreach ($resMesa as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['id_estado_mesa'] ?>" <?php if ($value['id_estado_mesa'] == $_GET['estado']) {
                                           echo 'selected';
                                       } ?>>
                                        <?php echo $value['nombre_estado'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="actualizarMesa" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>