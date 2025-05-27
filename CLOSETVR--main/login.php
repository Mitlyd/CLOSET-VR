<?php
include("conexion.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($contrasena, $usuario['contraseña'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            header("Location: catalogo.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Correo no registrado.";
    }
}
?>

<form method="POST">
    <input type="email" name="correo" placeholder="Correo" required><br>
    <input type="password" name="contrasena" placeholder="Contraseña" required><br>
    <button type="submit">Iniciar Sesión</button>
</form>
