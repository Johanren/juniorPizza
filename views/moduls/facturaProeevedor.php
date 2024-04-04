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