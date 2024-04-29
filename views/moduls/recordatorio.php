<script src="Views/js/jquery.min.js"></script>
<script src="Views/js/moment.min.js"></script>
<link rel="stylesheet" href="views/css/fullcalendar.css">
<script src="views/js/fullcalendar.js"></script>
<script src="views/js/es.js"></script>
<script>
    var host = window.location.hostname;
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            header: {
                left: 'today,prev,next',
                center: 'title',
                right: 'month, basicWeek, basicDay, agendaWeek, agendaDay'
            },
            dayClick: function (date, jsEvent, view) {
                $('#txtFecha').val(date.format());
                $("#modalEventos").modal();
            },
            events: 'http://'+host+'/dulce-salado/views/eventos.php',
            eventClick: function (calEvent, jsEvent, view) {
                $('#tituloEvento').html(calEvent.title);
                $('#txtDescripcion').val(calEvent.descripcion);
                $('#txtId').val(calEvent.id);
                $('#txtTitulo').val(calEvent.title);
                $('#txtColor').val(calEvent.color);
                FechaHora = calEvent.start._i.split(" ");
                $('#txtFecha').val(FechaHora[0]);
                $('#txtHora').val(FechaHora[1]);
                $("#modalEventos").modal();
            },
            editable: true,
            eventDrop: function (calEvent) {
                $('#txtId').val(calEvent.id);
                $('#txtTitulo').val(calEvent.title);
                $('#txtColor').val(calEvent.color);
                $('#txtDescripcion').val(calEvent.descripcion);
                var fechaHora = calEvent.start.format().split("T");
                $('#txtFecha').val(fechaHora[0]);
                $('#txtHora').val(fechaHora[1]);

                RecolectarDatosGUI();
                EnviarInformacion('modificar', NuevoEvento, true);
            }


        });
    })
</script>
<div class="container">
    <div id='calendar'></div>
</div>
<!-- Modal1 -->
<div class="modal fade" id="modalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloEvento"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="txtId" name="txtId"><br>
                Fecha: <input type="date" class="form-control" id="txtFecha" name="txtFecha"><br>
                Titulo: <input type="text" class="form-control" id="txtTitulo" name="txtTitulo"><br>
                Hora: <input type="time" class="form-control" id="txtHora" value=""><br>
                Descripcion: <textarea name="" class="form-control" id="txtDescripcion" cols="10"
                    rows="2"></textarea><br>
                Color: <input type="color" class="form-control" value="#FF0000" id="txtColor"><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btnAgregar">Agregar</button>
                <button type="button" class="btn btn-success" id="btnModificar">Modificar</button>
                <button type="button" class="btn btn-danger" id="btnEliminar">Borrar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<script>
    var NuevoEvento;
    $('#btnAgregar').click(function () {
        RecolectarDatosGUI();
        EnviarInformacion('agregar', NuevoEvento);

    });
    $('#btnEliminar').click(function () {
        RecolectarDatosGUI();
        EnviarInformacion('eliminar', NuevoEvento);

    });
    $('#btnModificar').click(function () {
        RecolectarDatosGUI();
        EnviarInformacion('modificar', NuevoEvento);

    });

    function RecolectarDatosGUI() {
        NuevoEvento = {
            id: $('#txtId').val(),
            title: $('#txtTitulo').val(),
            start: $('#txtFecha').val() + " " + $('#txtHora').val(),
            color: $('#txtColor').val(),
            descripcion: $('#txtDescripcion').val(),
            textColor: "#FFFFFF",
            end: $('#txtFecha').val() + " " + $('#txtHora').val(),
        };
    }

    function EnviarInformacion(accion, objEvento, modal) {
        $.ajax({
            type: 'POST',
            url: 'Views/eventos.php?accion=' + accion,
            data: objEvento,
            success: function (msg) {
                if (msg) {
                    $('#calendar').fullCalendar('refetchEvents');
                    if (!modal) {
                        $("#modalEventos").modal('toggle');
                    }
                }
            },
            error: function () {
                alert("Hay un error");
            }
        });
    }
</script>