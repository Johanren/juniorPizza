<?php
$devolucion = new ControladorVenta();
$devolucion->realizarDevolucionCancelacion();
if (isset($_GET['action'])) {
    if ($_GET['action'] == "productoDevuelto") {
        print '<script>
        swal("Hurra!!!", "Producto Devuelto exitosamente", "success");
    </script>';
    }
    if ($_GET['action'] == "FacturaCancelada") {
        print '<script>
        swal("Hurra!!!", "Factura Cancelada exitosamente", "success");
    </script>';
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Devolución de Producto / Cancelación de Factura</h2>
            <!-- Formulario para devolución de producto -->
            <h3>Devolución de Producto</h3>
            <form action="" method="post">
                <div class="form-group mt-3">
                    <label for="codigo_producto">Número factura:</label>
                    <input type="text" class="form-control factura" id="factura_1" name="id_factura" required>
                </div>
                <div class="form-group mt-3">
                    <label for="codigo_producto">Total factura:</label>
                    <input type="text" class="form-control" id="efectivo" name="efectivo" required>
                </div>

                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="hidden" class="form-control" id="id" name="id" required><input type="text" class="form-control" id="codigoProducto_1" name="codigo_producto" required></td>
                            <td><input type="text" class="form-control" id="producto_1" name="producto" required></td>
                            <td><input type="hidden" class="form-control" id="cant" name="cant" required><input type="number" class="form-control" id="cantidad_1" name="cantidad_devuelta" required><input type="hidden" class="form-control" id="precio_1" name="precio" required><input type="hidden" class="form-control" id="total_1" name="total" required></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary" name="devolucion"> Registrar Devolución</button>
            </form>
            <hr>
            <!-- Formulario para cancelación de factura -->
            <h3>Cancelar Factura</h3>
            <form action="" method="post">
                <input type="text" class="form-control factura mt-2" id="factura" name="id_factura" required>
                <input type="hidden" name="cancelar_factura" value="true">
                <button type="submit" class="btn btn-danger mt-2">Cancelar Factura</button>
            </form>
        </div>
    </div>
</div>