<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_GET['producto'])) {
    $id = $_GET['producto'];
    // Crear una nueva instancia de Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar los encabezados de la tabla
    $sheet->setCellValue('A1', 'Proveedor');
    $sheet->setCellValue('B1', 'Codigo');
    $sheet->setCellValue('C1', 'Producto');
    $sheet->setCellValue('D1', 'Precio unitario');
    $sheet->setCellValue('E1', 'Cantidad');
    $sheet->setCellValue('F1', 'Categoria');
    $sheet->setCellValue('G1', 'Medida');
    $sheet->setCellValue('H1', 'Local');

    // Conectar a la base de datos y recuperar los datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "junior";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT proeevedor.nombre_proeevedor AS nombre_proveedor, producto.codigo_producto, producto.nombre_producto, producto.precio_unitario, producto.cantidad_producto, categoria.nombre_categoria, medida.nombre_medida, local.nombre_local FROM producto INNER JOIN proeevedor ON proeevedor.id_proeevedor = producto.id_proeevedor INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria INNER JOIN medida ON medida.id_medida = producto.id_medida INNER JOIN local ON local.id_local = producto.id_local WHERE producto.id_local = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = 2; // Empezar desde la fila 2 ya que la fila 1 contiene los encabezados
        while ($data = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $data['nombre_proveedor']);
            $sheet->setCellValue('B' . $row, $data['codigo_producto']);
            $sheet->setCellValue('C' . $row, $data['nombre_producto']);
            $sheet->setCellValue('D' . $row, number_format($data['precio_unitario'], 2));
            $sheet->setCellValue('E' . $row, $data['cantidad_producto']);
            $sheet->setCellValue('F' . $row, $data['nombre_categoria']);
            $sheet->setCellValue('G' . $row, $data['nombre_medida']);
            $sheet->setCellValue('H' . $row, $data['nombre_local']);
            $row++;
        }
    }

    $conn->close();

    // Crear el archivo Excel
    $writer = new Xlsx($spreadsheet);

    // Configurar los encabezados HTTP para la descarga del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="productos.xlsx"');
    header('Cache-Control: max-age=0');

    // Enviar el archivo al navegador
    $writer->save('php://output');
    exit;
}
if (isset($_GET['ingrediente'])) {
    $id = $_GET['ingrediente'];
    // Crear una nueva instancia de Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar los encabezados de la tabla
    $sheet->setCellValue('A1', 'Ingrediente');
    $sheet->setCellValue('B1', 'Medida');
    $sheet->setCellValue('C1', 'Cantidad');

    // Conectar a la base de datos y recuperar los datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "junior";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT ingrediente.nombre_ingrediente, ingrediente.cantidad, medida.nombre_medida FROM ingrediente INNER JOIN medida ON medida.id_medida = ingrediente.id_medida WHERE ingrediente.id_local = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = 2; // Empezar desde la fila 2 ya que la fila 1 contiene los encabezados
        while ($data = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $data['nombre_ingrediente']);
            $sheet->setCellValue('B' . $row, $data['nombre_medida']);
            $sheet->setCellValue('C' . $row, $data['cantidad']);
            $row++;
        }
    }

    $conn->close();

    // Crear el archivo Excel
    $writer = new Xlsx($spreadsheet);

    // Configurar los encabezados HTTP para la descarga del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="productos.xlsx"');
    header('Cache-Control: max-age=0');

    // Enviar el archivo al navegador
    $writer->save('php://output');
    exit;
}
if (isset($_GET['productoMes'])) {
    $id = $_GET['productoMes'];
    // Crear una nueva instancia de Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar los encabezados de la tabla
    $sheet->setCellValue('A1', 'Producto');
    $sheet->setCellValue('B1', 'Total Vendido');

    // Conectar a la base de datos y recuperar los datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "junior";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    $fecha = date('Y-m') . "%";
    $sql = "SELECT producto.nombre_producto, SUM(cantidad) AS total_vendido FROM `venta` INNER JOIN producto ON producto.id_producto = venta.id_producto WHERE fecha_ingreso like '$fecha' AND venta.id_local = $id GROUP BY producto.nombre_producto ORDER BY total_vendido";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = 2; // Empezar desde la fila 2 ya que la fila 1 contiene los encabezados
        while ($data = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $data['nombre_producto']);
            $sheet->setCellValue('B' . $row, number_format($data['total_vendido'], 0));
            $row++;
        }
    }

    $conn->close();

    // Crear el archivo Excel
    $writer = new Xlsx($spreadsheet);

    // Configurar los encabezados HTTP para la descarga del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="productosVendidoMes.xlsx"');
    header('Cache-Control: max-age=0');

    // Enviar el archivo al navegador
    $writer->save('php://output');
    exit;
}

if (isset($_GET['ventaMes'])) {
    $id = $_GET['ventaMes'];
    // Crear una nueva instancia de Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar los encabezados de la tabla
    $sheet->setCellValue('A1', 'Fecha');
    $sheet->setCellValue('B1', 'Total Vendido');

    // Conectar a la base de datos y recuperar los datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "junior";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    $fecha = date('Y-m') . "%";
    $sql = "SELECT DATE(fecha_ingreso) AS dia_facturado, SUM(precio_compra) AS total FROM `venta` WHERE fecha_ingreso LIKE '$fecha' AND id_local = $id GROUP BY DATE(fecha_ingreso) ORDER BY DATE(fecha_ingreso)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = 2; // Empezar desde la fila 2 ya que la fila 1 contiene los encabezados
        while ($data = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $data['dia_facturado']);
            $sheet->setCellValue('B' . $row, number_format($data['total'], 0));
            $row++;
        }
    }

    $conn->close();

    // Crear el archivo Excel
    $writer = new Xlsx($spreadsheet);

    // Configurar los encabezados HTTP para la descarga del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ventaMes.xlsx"');
    header('Cache-Control: max-age=0');

    // Enviar el archivo al navegador
    $writer->save('php://output');
    exit;
}

use PhpOffice\PhpSpreadsheet\IOFactory;

$servername = "localhost";
$username = "root"; // Cambia esto por tu usuario de MySQL
$password = ""; // Cambia esto por tu contraseña de MySQL
$dbname = "junior"; // Cambia esto por tu base de datos

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha subido un archivo
if (isset($_FILES['file']['name'])) {
    $fileName = $_FILES['file']['tmp_name'];

    // Obtener el id_local enviado por el formulario
    $id_local = isset($_POST['id_local']) ? (int)$_POST['id_local'] : 0;

    // Cargar el archivo de Excel
    $spreadsheet = IOFactory::load($fileName);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();
    // Recorrer los datos del archivo Excel y guardarlos en la base de datos
    foreach ($data as $key => $row) {
        if ($key == 0) continue; // Saltar la primera fila (encabezado)
        // Verificar que todos los campos obligatorios tengan datos
        if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[3]) && !empty($row[4]) && !empty($row[5]) && !empty($row[6])) {

            $id_proveedor = $row[0];
            $codigo = $row[1];
            $nombre = $row[2];
            $precio = $row[3];
            $cantidad = $row[4];
            $id_categoria = $row[5];
            $id_medida = $row[6];

            // Preparar la consulta SQL para insertar el producto
            $sql = "INSERT INTO producto (id_proeevedor, codigo_producto, nombre_producto, precio_unitario, cantidad_producto, id_categoria, id_medida, id_local)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            //var_dump($id_proveedor, $codigo, $nombre, $precio, $cantidad, $id_categoria, $id_medida, $id_local);
            // Depuración: Verificar si la consulta se prepara correctamente
            if ($stmt = $conn->prepare($sql)) {
                // Si la preparación es exitosa, enlazar los parámetros
                $stmt->bind_param("issdiiii", $id_proveedor, $codigo, $nombre, $precio, $cantidad, $id_categoria, $id_medida, $id_local);

                // Ejecutar la consulta
                if (!$stmt->execute()) {
                    echo "Error al insertar el producto: " . $stmt->error;
                }
            } else {
                // Si hay un error en la preparación de la consulta, mostrar el mensaje de error
                echo "Error en la preparación de la consulta: " . $conn->error;
            }
        }
    }

    echo "Cargue completado";
} else {
    echo "No se ha subido ningún archivo.";
}

$conn->close();
