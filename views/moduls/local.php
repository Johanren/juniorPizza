<?php

if (isset($_GET['action'])) {
    if ($_GET['action'] == "agregarLocal") {
        print '<script>
        swal("Hurra!!!", "El establecimiento ha sido agregado exitosamente", "success");
    </script>';
    }
    if ($_GET['action'] == "actualizarLocal") {
        print '<script>
        swal("Hurra!!!", "El establecimiento ha sido actualizado exitosamente", "success");
    </script>';
    }
}
///Usuario
$user = new ControladorLocal();
$user->agregarLocal();
$res = $user->listarLocal();
//
if ($_SESSION['rol'] != "Administrador") {
    echo '<script>window.location="inicio"</script>';
}
if (isset($_GET['id_local'])) {
    print "<script>$(document).ready(function() {
        $('#local').modal('toggle')
    });</script>";
    $listar = $user->consultarLocal($_GET['id_local']);
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-building-fill-add" viewBox="0 0 16 16">
                    <path
                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0" />
                    <path
                        d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v7.256A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-3.59 1.787A.5.5 0 0 0 9 9.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .39-.187A4.5 4.5 0 0 0 8.027 12H6.5a.5.5 0 0 0-.5.5V16H3a1 1 0 0 1-1-1zm2 1.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5m3 0v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5m3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5M7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5M4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                </svg>
            </button>
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table id="usuario" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nombre Local</th>
                    <th># Nit</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($res as $key => $value) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $value['nombre_local'] ?>
                        </td>
                        <td>
                            <?php echo $value['nit'] ?>
                        </td>
                        <td>
                            <?php echo $value['direccion'] ?>
                        </td>
                        <td>
                            <?php echo $value['telefono'] ?>
                        </td>
                        <td><a href="index.php?action=local&id_local=<?php echo $value['id_local'] ?>"><i
                                    class="fas fa-print fa-lg"></i></a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Nombre Local</th>
                    <th># Nit</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Local</label>
                            <input type="text" class="form-control" name="local" id="inputEmail4"
                                placeholder="Primer nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Nit</label>
                            <input type="text" class="form-control" name="nit" id="inputPassword4"
                                placeholder="Segundo Nombre">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Dirección</label>
                            <input type="text" class="form-control" name="dire" id="inputEmail4"
                                placeholder="Primer nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Telefono</label>
                            <input type="texr" class="form-control" name="tel" id="inputPassword4"
                                placeholder="Segundo Nombre">
                        </div>
                    </div>
                    <button type="submit" name="agregarLocal" class="btn btn-primary">Agregar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Editar Local-->
<div class="modal fade" id="local" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Agregar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Local</label>
                            <input type="text" class="form-control" value="<?php echo $listar[0]['nombre_local'] ?>" name="localEdit" id="inputEmail4"
                                placeholder="Primer nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Nit</label>
                            <input type="text" class="form-control" value="<?php echo $listar[0]['nit'] ?>" name="nitEdit" id="inputPassword4"
                                placeholder="Segundo Nombre">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Dirección</label>
                            <input type="text" class="form-control" value="<?php echo $listar[0]['direccion'] ?>" name="direEdit" id="inputEmail4"
                                placeholder="Primer nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Telefono</label>
                            <input type="texr" class="form-control" value="<?php echo $listar[0]['telefono'] ?>" name="telEdit" id="inputPassword4"
                                placeholder="Segundo Nombre">
                        </div>
                    </div>
                    <button type="submit" name="actualizarLocal" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>