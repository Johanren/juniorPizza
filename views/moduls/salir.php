<?php
if (isset($_SESSION['caja'])) {
    //include("views/moduls/aperturaCaja.php");
} else {
}
session_destroy();
echo '<script>window.location="ingresar"</script>';
