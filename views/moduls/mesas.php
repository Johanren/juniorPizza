<?php

if (isset($_GET['action'])) {
    if ($_GET['action'] == "agregarMesa") {
        print '<script>
        swal("Hurra!!!", "Mesa agregada exitosamente", "success");
    </script>';
    }
}
///Usuario
$user = new ControladorMesa();
$user->agregarMesa();
$res = $user->listarMesa();
//piso
$piso = new ControladorPiso();
$resPiso = $piso->listarPiso();

if (isset($_GET['id'])) {
    print "<script>$(document).ready(function() {
        $('#pedido').modal('toggle')
    });</script>";
} else {
    echo "<script>
    $(document).ready(function () {
        $('#exampleModalCenter').modal('toggle')
    });
</script>";
}

$agregarPedido = new ControladorPedido();
$agregarPedido->agregarPedido();
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
        </div>
    </div>
    <div class="accordion mt-5" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="false" aria-controls="collapseOne">
                        Piso 1
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row">
                        <?php
                        foreach ($res as $key => $value) {
                            ?>
                            <div class="col-sm-3 mt-3">
                                <a href="index.php?action=mesas&id=<?php echo $value['id_mesa'] ?>&mesa=<?php echo $value['nombre_mesa'] ?>"
                                    class="<?php echo $value['color_estado'] ?>">
                                    <h1 style="text-align: center; color: black;"><?php echo $value['nombre_mesa'] ?></h1>
                                    <div class="card" style="width: 10rem;">
                                        <img class="card-img-top" src="views/img/mesa.png" alt="Card image cap">
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mesas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <?php
                    if ($_SESSION['rol'] != "Administrador" && $_SESSION['rol'] != "Gerente") {

                    } else {
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-terminal-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M2 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h5.5a.5.5 0 0 1 0 1H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v4a.5.5 0 0 1-1 0V4a1 1 0 0 0-1-1z" />
                                        <path
                                            d="M3.146 5.146a.5.5 0 0 1 .708 0L5.177 6.47a.75.75 0 0 1 0 1.06L3.854 8.854a.5.5 0 1 1-.708-.708L4.293 7 3.146 5.854a.5.5 0 0 1 0-.708M5.5 9a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <br>
                    <div class="table-responsive">
                        <table id="usuario" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre Mesa</th>
                                    <th>Estado Mesa</th>
                                    <th>Piso</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($res as $key => $value) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $value['nombre_mesa'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['nombre_estado'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['piso_nombre'] ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre Mesa</th>
                                    <th>Estado Mesa</th>
                                    <th>Piso</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Mesa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Nombre Mesa</label>
                            <input type="text" class="form-control" name="mesa" id="inputEmail4"
                                placeholder="Nombre_mesa">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Activo</label>
                            <select id="" name="id_piso" class="form-control">
                                <option selected>Choose...</option>
                                <?php
                                foreach ($resPiso as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['id_piso'] ?>">
                                        <?php echo $value['piso_nombre'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="agregarMesa" class="btn btn-primary">Agregar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Pedido -->
<div class="modal fade" id="pedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Pedido <?php echo $_GET['mesa'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a id="agregarPedido" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-node-plus" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8M6.025 7.5a5 5 0 1 1 0 1H4A1.5 1.5 0 0 1 2.5 10h-1A1.5 1.5 0 0 1 0 8.5v-1A1.5 1.5 0 0 1 1.5 6h1A1.5 1.5 0 0 1 4 7.5zM11 5a.5.5 0 0 1 .5.5v2h2a.5.5 0 0 1 0 1h-2v2a.5.5 0 0 1-1 0v-2h-2a.5.5 0 0 1 0-1h2v-2A.5.5 0 0 1 11 5M1.5 7a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                    </svg>
                </a>
                <form action="" method="post">
                    <input type="hidden" class="form-control" value="<?php echo $_GET['id'] ?>" name="id_mesa">
                    <div class="table-responsive">
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="pedidoProducto">
                                <tr class="eliminar_1">
                                    <td><input type="hidden" name="id_pedido[]" id="id_predido_1"><input type="text"
                                            name="producto[]" class="form-control producto" id="producto_1"
                                            placeholder="Producto"></td>
                                    <th><textarea name="descripcion[]" id="descripcion_1" class="form-control" cols="30"
                                            rows="1"></textarea></th>
                                    <th><input type="number" name="cantidad[]" class="form-control"
                                            placeholder="Cantidad Pedido"></th>
                                    <th><a class="btn btn-primary eliminar" id="eliminarFactura"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                            </svg></a></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" name="agregarPedido" class="btn btn-primary">Agregar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>