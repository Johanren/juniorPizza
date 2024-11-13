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
$user = new ControladorGasto();
$user->agregarGasto();
$res = $user->listarGasto();
if (isset($_GET['id_gasto'])) {
    print "<script>$(document).ready(function() {
        $('#verGasto').modal('toggle')
    });</script>";
    $listar = $user->listarGastoId();
}
if (isset($_GET['id'])) {
    $listar = $user->eliminarGastoId();
}
?>
<div class="container mt-5">
    <form method="post" class="mt-3">
        <div class="row">
            <div class="col-sm-6">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-comment-dollar fa-lg"></i>
                </button>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-3">
                <input type="date" class="form-control" name="buscar">
            </div>
            <div class="col-sm-3">
                <button type="hidden" name="consultar" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
    <br>
    <div class="table-responsive">
        <table id="usuario" class="table">
            <thead>
                <tr>
                    <th>Nombre Gasto</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($res as $key => $value) {
                ?>
                    <tr>
                        <td>
                            <?php echo $value['nombre_gasto'] ?>
                        </td>
                        <td>
                            <?php echo $value['descripcion'] ?>
                        </td>
                        <td>
                            <?php echo number_format($value['total'], 0) ?>
                        </td>
                        <td>
                            <?php echo $value['fecha_ingreso'] ?>
                        </td>
                        <td><a href="index.php?action=gastos&id_gasto=<?php echo $value['id_gasto'] ?>"><i class="fas fa-print fa-lg"></i></a><a href="index.php?action=gastos&id_gasto=<?php echo $value['id_gasto'] ?>"><a href="index.php?action=gastos&id=<?php echo $value['id_gasto'] ?>"><i class="fas fa-trash-alt fa-lg"></i></a></a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nombre Gasto</th>
                    <th>Descripcion</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Gasto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Gasto</label>
                            <input type="text" class="form-control" name="gasto" id="inputEmail4" placeholder="Nombre Gasto">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Total Gastado</label>
                            <input type="text" class="form-control abono" name="total" id="abono" placeholder="Total">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Descripcion</label>
                            <textarea name="descripcion" class="form-control" id="" placeholder="Descripcion"></textarea>
                        </div>
                    </div>
                    <button type="submit" name="agregarGasto" class="btn btn-primary">Agregar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal ditar-->
<div class="modal fade" id="verGasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Gasto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Gasto</label>
                            <input type="text" class="form-control" name="gastoEdit" id="inputEmail4" placeholder="Nombre Gasto" value="<?php echo $listar[0]['nombre_gasto'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Total Gastado</label>
                            <input type="text" class="form-control monto" name="totalEdit" id="monto" placeholder="Total" value="<?php echo number_format($listar[0]['total'], 0) ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Descripcion</label>
                            <textarea name="descripcionEdit" class="form-control" id="" placeholder="Descripcion"><?php echo $listar[0]['descripcion'] ?></textarea>
                        </div>
                    </div>
                    <button type="submit" name="actualizarGasto" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>