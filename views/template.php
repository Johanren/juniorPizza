<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puerto Magdalena</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="views/css/bootstrap.css">
    <link rel="stylesheet" href="views/css/dataTables.bootstrap4.min.css">
    <script src="views/js/jquery-3.3.1.js"></script>
    <script src="views/js/jquery.dataTables.min.js"></script>
    <script src="views/js/dataTables.bootstrap4.min.js"></script>
    <script src="views/js/sweetalert.min.js"></script>
    <link rel="stylesheet" href="views/css/login.css">
    <link rel="stylesheet" href="views/css/perfil.css">
    <link rel="stylesheet" href="views/css/cocina.css">
    <link rel="stylesheet" href="views/css/config.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="views/img/logo.png">
    <link rel="stylesheet" href="views/css/jquery-ui.css">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        session_start();
        if (isset($_SESSION['validar'])) {
            include ("views/moduls/narvar.php");
        }
        ?>
        <?php
        $mvc = new controladorViews();
        $mvc->enlacesPaginaControlador();
        ?>
    </div>
    <?php
    if (isset($_SESSION['validar'])) {
        include ("views/moduls/footer.php");
    }
    ?>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Recordatorio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <?php
                    $evento = new ControladorEvento();
                    $res = $evento->consultarEventoVentanaControlador();
                    if (empty($res)) {
                        ?>
                        <h4 style="text-align: center;">No tienes eventos para hoy</h4>
                        <?php
                    } else {
                        ?>
                        <div class="table-responsive">
                            <table class="table" id="usuario">
                                <thead>
                                    <tr>
                                        <th>Evento</th>
                                        <th>Descripcion</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($res as $key => $value) {
                                        $matriz = explode(" ", $value['start']);
                                        ?>
                                        <tr>
                                            <td><?php echo $value['title'] ?></td>
                                            <td><?php echo $value['descripcion'] ?></td>
                                            <td><?php echo $matriz[0] ?></td>
                                            <td><?php echo $matriz[1] ?></td>
                                        </tr>
                                    <?php }
                    } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<script src="views/js/table.js"></script>

<!-- Bootstrap core JavaScript-->
<!--<script src="vendor/jquery/jquery.min.js"></script>-->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<!--<script src="vendor/jquery-easing/jquery.easing.min.js"></script>-->

<!-- Custom scripts for all pages-->
<script src="views/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="views/js/demo/chart-area-demo.js"></script>
<script src="views/js/demo/chart-pie-demo.js"></script>
<script src="views/js/jquery-ui.js"></script>
<script src="Views/js/ConectorJavaScript.js"></script>
<script src="views/js/js.js"></script>




</html>