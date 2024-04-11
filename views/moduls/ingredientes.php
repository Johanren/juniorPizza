<?php

if (isset($_GET['action'])) {
    if ($_GET['action'] == "agregarIngrediente") {
        print '<script>
        swal("Hurra!!!", "Ingrediente agregado exitosamente", "success");
    </script>';
    }
}
///Usuario
$user = new ControladorIngredientes();
$user->agregarIngrediente();
$res = $user->listarIngredinte();
if ($_SESSION['rol'] != "Administrador" && $_SESSION['rol'] != "Gerente") {
    echo '<script>window.location="inicio"</script>';
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-terminal-plus" viewBox="0 0 16 16">
                    <path
                        d="M2 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h5.5a.5.5 0 0 1 0 1H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v4a.5.5 0 0 1-1 0V4a1 1 0 0 0-1-1z" />
                    <path
                        d="M3.146 5.146a.5.5 0 0 1 .708 0L5.177 6.47a.75.75 0 0 1 0 1.06L3.854 8.854a.5.5 0 1 1-.708-.708L4.293 7 3.146 5.854a.5.5 0 0 1 0-.708M5.5 9a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5" />
                </svg>
            </button>
            <button id="miBoton" onclick="habilitarInput()" class="btn btn-primary">
                Habilitar Inputs
            </button>
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table id="usuario" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Ingrediente</th>
                    <th>Medida</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($res as $key => $value) {
                    ?>
                    <tr>
                        <td>
                            <input type="hidden" class="form-control" name="id"
                                value="<?php echo $value['id_ingrediente'] ?>">
                            <input type="text" class="form-control inputs" name="ingredi"
                                value="<?php echo $value['nombre_ingrediente'] ?>" disabled>
                        </td>
                        <td>
                            <input type="hidden" class="form-control" name="id_med" id="id_medida">
                            <input type="text" class="form-control inputs" name="medida" id="nom_medida"
                                placeholder="Medida" value="<?php echo $value['nombre_medida'] ?>" disabled>
                        </td>
                        <td>
                            <input type="text" class="form-control inputs" value="<?php echo $value['cantidad'] ?>"
                                disabled>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Ingrediente</th>
                    <th>Medida</th>
                    <th>Cantidad</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <a id="agregarIngrediente" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-node-plus" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M11 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8M6.025 7.5a5 5 0 1 1 0 1H4A1.5 1.5 0 0 1 2.5 10h-1A1.5 1.5 0 0 1 0 8.5v-1A1.5 1.5 0 0 1 1.5 6h1A1.5 1.5 0 0 1 4 7.5zM11 5a.5.5 0 0 1 .5.5v2h2a.5.5 0 0 1 0 1h-2v2a.5.5 0 0 1-1 0v-2h-2a.5.5 0 0 1 0-1h2v-2A.5.5 0 0 1 11 5M1.5 7a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                        </svg>
                    </a>
                    <div class="table-responsive mt-3">
                        <table class="table mt-2" id="producto">
                            <thead>
                                <tr>
                                    <th>Ingrediente</th>
                                    <th>Cantidad</th>
                                    <th>Medida</th>
                                </tr>
                            </thead>
                            <tbody id="ingrediente">
                                <tr>
                                    <td><input type="text" class="form-control" name="nom_ingre[]"></td>
                                    <td><input type="text" class="form-control" name="cant[]"></td>
                                    <td><input type="hidden" class="form-control" name="id_medida[]"
                                            id="id_medida_1"><input type="text" class="form-control medida" name=""
                                            id="medida_1"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" name="agregarIngrediente" class="btn btn-primary">Agregar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>