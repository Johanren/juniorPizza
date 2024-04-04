<?php

if (isset($_GET['action'])) {
    if ($_GET['action'] == "agregarProeevedor") {
        print '<script>
        swal("Hurra!!!", "El proeevedor ha sido registrado correctamente", "success");
    </script>';
    }
}
///Usuario
$user = new ControladorProeevedor();
$user->agregarProeevedor();
$res = $user->listarProeevedor();
//local
$activo = new ControladorLocal();
$resLocal = $activo->listarLocal();
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
    <table id="usuario" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th># Nit</th>
                <th>Nombre Proeevedor</th>
                <th>Telefono</th>
                <th>Dirección</th>
                <th>Establecimiento</th>
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
                        <?php echo $value['telefono_proeevedor'] ?>
                    </td>
                    <td>
                        <?php echo $value['direccion_proeevedor'] ?>
                    </td>
                    <td>
                        <?php echo $value['nombre_local'] ?>
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
                <th>Telefono</th>
                <th>Dirección</th>
                <th>Establecimiento</th>
            </tr>
        </tfoot>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Proeevedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Proeevedor</label>
                            <input type="text" class="form-control" name="proe" id="inputEmail4"
                                placeholder="Proeevedor">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Nit</label>
                            <input type="text" class="form-control" name="nit" id="inputPassword4"
                                placeholder="Nit">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Dirección</label>
                            <input type="text" class="form-control" name="dire" id="inputEmail4"
                                placeholder="Dirección">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Telefono</label>
                            <input type="texr" class="form-control" name="tel" id="inputPassword4"
                                placeholder="Telefono">
                        </div>
                    </div>
                    <div class="form-row">
                        <?php
                        if ($_SESSION['rol'] == "Administrador") {
                            ?>
                            <div class="form-group col-md-6">
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
                        }
                        ?>
                    </div>
                    <button type="submit" name="agregarProeevedor" class="btn btn-primary">Agregar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>