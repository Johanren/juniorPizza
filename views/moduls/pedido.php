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
if (isset($_POST['actualizarMesa']) || isset($_POST['actualizarMesa_id'])) {
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
    $estado = new ControladorEstadoMesa();
    $resEstado = $estado->listarEstadoMesa();
} elseif (isset($_GET['id_mesa'])) {
    print "<script>$(document).ready(function() {
        $('#mesa_id').modal('toggle')
    });</script>";
    //mesa
    $mesa = new ControladorMesa();
    $resMesa = $mesa->buscarMesaId($_GET['id_mesa']);
    $estado = new ControladorEstadoMesa();
    $resEstado = $estado->listarEstadoMesa();
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
                                href="index.php?action=pedido&id=<?php echo $value['id_mesa'] ?>&mesa=<?php echo $value['nombre_mesa'] ?>&estado=<?php echo $value['id_estado_mesa'] ?>"><i
                                    class="fas fa-exchange-alt fa-lg"></i></a>
                            <a
                                href="index.php?action=pedido&id_mesa=<?php echo $value['id_mesa'] ?>&mesa=<?php echo $value['nombre_mesa'] ?>&estado=<?php echo $value['id_estado_mesa'] ?>&fecha=<?php echo $value['fecha_ingreso'] ?>"><i
                                    class="fas fa-edit fa-lg"></i></a>
                        </td>
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
                <h5 class="modal-title" id="exampleModalLabel">Cambiar <?php echo $_GET['mesa'] ?></h5>
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
                                foreach ($resEstado as $key => $value) {
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
<!--Modal actualizar Mesa-->
<div class="modal fade" id="mesa_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input type="hidden" class="form-control" value="<?php echo $_GET['id_mesa'] ?>" name="id_mesa">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputState">Mesa</label>
                            <select id="inputState" name="mesa" class="form-control">
                                <option selected>Choose...</option>
                                <?php
                                foreach ($resMesa as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['id_mesa'] ?>" <?php if ($value['id_mesa'] == $_GET['id_mesa']) {
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
                                foreach ($resEstado as $key => $value) {
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
                    <button type="submit" name="actualizarMesa_id" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>