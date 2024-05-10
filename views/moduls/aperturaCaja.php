<!-- Modal Apertura-->
<div class="modal fade" id="abrirCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apertura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <label for="monto">Monto Inicial:</label>
                    <input type="text" id="monto" class="form-control monto" name="monto" required>
                    <label for="monto">Fecha:</label>
                    <input type="datetime-local" id="" class="form-control monto" name="fecha" required>
                    <button class="btn btn-primary mt-2 abrir" name="abrir">Abrir Caja</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>