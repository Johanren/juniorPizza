<?php  

// Requiere todos los archivos en la carpeta 'controllers'
foreach (glob("controllers/*.php") as $filename) {
    require_once $filename;
}

// Requiere todos los archivos en la carpeta 'models'
foreach (glob("models/*.php") as $filename) {
    require_once $filename;
}
//fpdf


$views = new controladorViews();
$views->cargarTemplate();