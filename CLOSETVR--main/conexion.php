<?php
$host = "sql.freedb.tech";
$usuario = "freedb_micheelvr";
$contraseña = "?8hkarQUd7Rs?CN";
$base_de_datos = "freedb_closetvrbd";

try {
    $conn = new PDO("mysql:host=$host;dbname=$base_de_datos;charset=utf8", $usuario, $contraseña);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}
?>
