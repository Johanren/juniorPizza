<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "junior";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Nombre del archivo de copia de seguridad
$backup_file = 'backup '. date("Y-m-d_H-i-s") .'.sql';

// Comando SQL para realizar la copia de seguridad de todas las tablas
$sql = "SET FOREIGN_KEY_CHECKS=0;\n";
$sql .= "SET SQL_MODE=\"NO_AUTO_VALUE_ON_ZERO\";\n";
$sql .= "SET AUTOCOMMIT=0;\n";
$sql .= "START TRANSACTION;\n";
$sql .= "SET time_zone = \"+00:00\";\n\n";

// Obtener todas las tablas de la base de datos
$tables = array();
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Recorrer cada tabla y obtener su estructura y datos
foreach ($tables as $table) {
    $sql .= "DROP TABLE IF EXISTS `$table`;\n";
    $result = $conn->query("SHOW CREATE TABLE `$table`");
    $row = $result->fetch_row();
    $sql .= $row[1] . ";\n\n";

    $result = $conn->query("SELECT * FROM `$table`");
    while ($row = $result->fetch_assoc()) {
        $row_values = array_map('addslashes', $row);
        $sql .= "INSERT INTO `$table` VALUES ('" . implode("', '", $row_values) . "');\n";
    }
    $sql .= "\n";
}

$sql .= "COMMIT;\n";
$sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

// Guardar la copia de seguridad en un archivo
file_put_contents($backup_file, $sql);

echo "Copia de seguridad creada correctamente en $backup_file";

// Cerrar la conexión
$conn->close();
?>
