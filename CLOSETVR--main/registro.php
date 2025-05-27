<?php
// Verificar que el método sea POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "freedb_closetvrbd");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Recibir datos del formulario
    $nombre = $_POST['nombre_usuario'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Encriptar la contraseña
    $hash = password_hash($contraseña, PASSWORD_DEFAULT);

    // Preparar y ejecutar consulta
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, correo, contraseña) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $hash);

    if ($stmt->execute()) {
        echo "✅ Usuario registrado con éxito";
        // Puedes redirigir con: header("Location: login.php"); exit();
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();

} else {
    // Si alguien accede directamente al archivo sin usar POST
    http_response_code(405);
    echo "⚠️ Método no permitido";
}
?>