<?php
//rol
$rol = new ControladorRol();
$resRol = $rol->listarRol();
//activo
$activo = new ControladorActivo();
$resActivo = $activo->listarActivo();
//local
$activo = new ControladorLocal();
$resLocal = $activo->listarLocal();
if (isset($_GET['action'])) {
    if ($_GET['action'] == "agregarUsuario") {
        print '<script>
        swal("Hurra!!!", "El usuario ha sido generado correctamente", "success");
    </script>';
    }
    if ($_GET['action'] == "actualizarUsuario") {
        print '<script>
        swal("Hurra!!!", "El usuario ha sido actualizado correctamente", "success");
    </script>';
    }
    if ($_GET['action'] == "eliminarUsuario") {
        print '<script>
        swal("Hurra!!!", "El usuario ha sido eliminado correctamente", "success");
    </script>';
    }
}
if ($_SESSION['rol'] != "Administrador" && $_SESSION['rol'] != "Gerente") {
    echo '<script>window.location="inicio"</script>';
}

///Usuario
$user = new ControladorUsuario();
$user->agregarUsuario();
$res = $user->listarUsuario();
if (isset($_GET['id_usuario'])) {
    print "<script>$(document).ready(function() {
        $('#usuarioEdit').modal('toggle')
    });</script>";
    $listar = $user->listarUsuarioId();
}
if (isset($_GET['id'])) {
    $listar = $user->eliminarUsuarioId();
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                    <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
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
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Rol</th>
                    <th>Activo</th>
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
                            <?php echo $value['usuario'] ?>
                        </td>
                        <td>
                            <?php echo $value['clave'] ?>
                        </td>
                        <td>
                            <?php echo $value['nombre_rol'] ?>
                        </td>
                        <td>
                            <?php echo $value['nombre_activo'] ?>
                        </td>
                        <td>
                            <?php echo $value['nombre_local'] ?>
                        </td>
                        <td><a href="index.php?action=usuario&id_usuario=<?php echo $value['id_usuario'] ?>"><i class="fas fa-print fa-lg"></i></a><a href="index.php?action=usuario&id=<?php echo $value['id_usuario'] ?>"><i class="fas fa-trash-alt fa-lg"></i></a></td>
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
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Rol</th>
                    <th>Activo</th>
                    <th>Establecimiento</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Primer Nombre</label>
                            <input type="text" class="form-control" name="priNombre" id="inputEmail4" placeholder="Primer nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Segundo Nombre</label>
                            <input type="text" class="form-control" name="segNombre" id="inputPassword4" placeholder="Segundo Nombre">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Primer Apellido</label>
                            <input type="text" class="form-control" name="priApellido" id="inputEmail4" placeholder="Primer nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Segundo Apellido</label>
                            <input type="texr" class="form-control" name="segApellido" id="inputPassword4" placeholder="Segundo Nombre">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Usuario</label>
                            <input type="text" class="form-control" name="user" id="inputEmail4" placeholder="Nombre de Usuario">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Contraseña</label>
                            <input type="password" class="form-control" name="clave" id="inputPassword4" placeholder="Contraseña">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputState">Rol</label>
                            <select id="inputState" name="rol" class="form-control">
                                <option selected>Choose...</option>
                                <?php
                                foreach ($resRol as $key => $value) {
                                ?>
                                    <option value="<?php echo $value['id_rol'] ?>">
                                        <?php echo $value['nombre_rol'] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Activo</label>
                            <select id="" name="activo" class="form-control">
                                <option selected>Choose...</option>
                                <?php
                                foreach ($resActivo as $key => $value) {
                                ?>
                                    <option value="<?php echo $value['id_activo'] ?>">
                                        <?php echo $value['nombre_activo'] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                        /*if ($_SESSION['rol'] == "Administrador") {
                        ?>
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
                        <?php
                        }*/
                        ?>
                    </div>
                    <button type="submit" name="agregarUsuario" class="btn btn-primary">Agregar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Usuario-->
<div class="modal fade" id="usuarioEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eitar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Primer Nombre</label>
                            <input type="text" class="form-control" value="<?php echo $listar[0]['primer_nombre'] ?>" name="priNombreEdit" id="inputEmail4" placeholder="Primer nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Segundo Nombre</label>
                            <input type="text" class="form-control" value="<?php echo $listar[0]['segundo_nombre'] ?>" name="segNombreEdit" id="inputPassword4" placeholder="Segundo Nombre">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Primer Apellido</label>
                            <input type="text" class="form-control" value="<?php echo $listar[0]['primer_apellido'] ?>" name="priApellidoEdit" id="inputEmail4" placeholder="Primer nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Segundo Apellido</label>
                            <input type="texr" class="form-control" value="<?php echo $listar[0]['segundo_apellido'] ?>" name="segApellidoEdit" id="inputPassword4" placeholder="Segundo Nombre">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Usuario</label>
                            <input type="text" class="form-control" value="<?php echo $listar[0]['usuario'] ?>" name="userEdit" id="inputEmail4" placeholder="Nombre de Usuario">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Contraseña</label>
                            <input type="text" class="form-control" value="<?php echo $listar[0]['clave'] ?>" name="claveEdit" id="inputPassword4" placeholder="Contraseña">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputState">Rol</label>
                            <select id="inputState" name="rolEdit" class="form-control">
                                <option selected>Choose...</option>
                                <?php
                                foreach ($resRol as $key => $value) {
                                ?>
                                    <option value="<?php echo $value['id_rol'] ?>" <?php if ($value['id_rol'] == $listar[0]['id_rol']) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                        <?php echo $value['nombre_rol'] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Activo</label>
                            <select id="" name="activoEdit" class="form-control">
                                <option selected>Choose...</option>
                                <?php
                                foreach ($resActivo as $key => $value) {
                                ?>
                                    <option value="<?php echo $value['id_activo'] ?>" <?php if ($value['id_activo'] == $listar[0]['id_activo']) {
                                                                                            echo 'selected';
                                                                                        } ?>>
                                        <?php echo $value['nombre_activo'] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                        if ($_SESSION['rol'] == "Administrador") {
                        ?>
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
                        <?php
                        }
                        ?>
                    </div>
                    <button type="submit" name="ActualizarUsuario" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>