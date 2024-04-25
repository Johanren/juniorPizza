<?php

if (isset($_GET['action'])) {
    if ($_GET['action'] == "agregarCliente") {
        print '<script>
        swal("Hurra!!!", "El usuario ha sido generado correctamente", "success");
    </script>';
    }
    if ($_GET['action'] == "actualizarCliente") {
        print '<script>
        swal("Hurra!!!", "El usuario ha sido actualizado correctamente", "success");
    </script>';
    }
}
//local
$activo = new ControladorLocal();
$resLocal = $activo->listarLocal();
///Usuario
$user = new ControladorCliente();
$user->agregarCLiente();
$res = $user->listarCliente();
if ($_SESSION['rol'] != "Administrador" && $_SESSION['rol'] != "Gerente") {
    echo '<script>window.location="inicio"</script>';
}
if (isset($_GET['id_cliente'])) {
    print "<script>$(document).ready(function() {
        $('#clienteEdit').modal('toggle')
    });</script>";
    $listar = $user->listarClienteId();
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-person-add" viewBox="0 0 16 16">
                    <path
                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                    <path
                        d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                </svg>
            </button>
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table id="usuario" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Primer Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Número documento</th>
                    <th>Email</th>
                    <th>Establecimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($res as $key => $value) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $value['primer_nombre'] ?>
                        </td>
                        <td>
                            <?php echo $value['segundo_nombre'] ?>
                        </td>
                        <td>
                            <?php echo $value['primer_apellido'] ?>
                        </td>
                        <td>
                            <?php echo $value['segundo_apellido'] ?>
                        </td>
                        <td>
                            <?php echo $value['numero_cc'] ?>
                        </td>
                        <td>
                            <?php echo $value['correo'] ?>
                        </td>
                        <td>
                            <?php echo $value['nombre_local'] ?>
                        </td>
                        <td><a href="index.php?action=cliente&id_cliente=<?php echo $value['id_cliente'] ?>"><i
                                    class="fas fa-print fa-lg"></i></a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Primer Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Número documento</th>
                    <th>Email</th>
                    <th>Establecimiento</th>
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
                            <label for="inputEmail4">Primer Nombre</label>
                            <input type="text" class="form-control" name="priNombre" id="inputEmail4"
                                placeholder="Primer nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Segundo Nombre</label>
                            <input type="text" class="form-control" name="segNombre" id="inputPassword4"
                                placeholder="Segundo Nombre">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Primer Apellido</label>
                            <input type="text" class="form-control" name="priApellido" id="inputEmail4"
                                placeholder="Primer nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Segundo Apellido</label>
                            <input type="texr" class="form-control" name="segApellido" id="inputPassword4"
                                placeholder="Segundo Nombre">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Número de Documento</label>
                            <input type="text" class="form-control" name="cc" id="inputEmail4"
                                placeholder="Número de Documento">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Email</label>
                            <input type="email" class="form-control" name="email" id="inputPassword4"
                                placeholder="Correo">
                        </div>
                    </div>
                    <?php
                    if ($_SESSION['rol'] == "Administrador") {
                        ?>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="">Establecimiento</label>
                                <select id="" name="local" class="form-control">
                                    <option selected>Choose...</option>
                                    <?php
                                    foreach ($resLocal as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id_local'] ?>">
                                            <?php echo $value['nombre_local'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <button type="submit" name="agregarCliente" class="btn btn-primary">Agregar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Actualizar Cliente-->
<div class="modal fade" id="clienteEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Editar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Primer Nombre</label>
                            <input type="text" class="form-control" value="<?php echo $listar[0]['primer_nombre'] ?>"
                                name="priNombreEdit" id="inputEmail4" placeholder="Primer nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Segundo Nombre</label>
                            <input type="text" class="form-control" value="<?php echo $listar[0]['segundo_nombre'] ?>"
                                name="segNombreEdit" id="inputPassword4" placeholder="Segundo Nombre">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Primer Apellido</label>
                            <input type="text" class="form-control" value="<?php echo $listar[0]['primer_apellido'] ?>"
                                name="priApellidoEdit" id="inputEmail4" placeholder="Primer nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Segundo Apellido</label>
                            <input type="texr" class="form-control" value="<?php echo $listar[0]['segundo_apellido'] ?>"
                                name="segApellidoEdit" id="inputPassword4" placeholder="Segundo Nombre">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Número de Documento</label>
                            <input type="text" class="form-control" value="<?php echo $listar[0]['numero_cc'] ?>"
                                name="ccEdit" id="inputEmail4" placeholder="Número de Documento">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Email</label>
                            <input type="email" class="form-control" value="<?php echo $listar[0]['correo'] ?>"
                                name="emailEdit" id="inputPassword4" placeholder="Correo">
                        </div>
                    </div>
                    <?php
                    if ($_SESSION['rol'] == "Administrador") {
                        ?>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="">Establecimiento</label>
                                <select id="" name="localEdit" class="form-control">
                                    <option selected>Choose...</option>
                                    <?php
                                    foreach ($resLocal as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id_local'] ?>" <?php if ($value['id_local'] == $listar[0]['id_local']) {
                                               echo 'selected';
                                           } ?>>
                                            <?php echo $value['nombre_local'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <button type="submit" name="actualizarCliente" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>