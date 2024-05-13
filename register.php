<?php
// Verificar si el usuario está intentando registrar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar campos
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Conectar a la base de datos
    $conn = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=Database11.accdb");

    // Consulta SQL para insertar nuevo usuario
    $query = $conn->prepare("INSERT INTO usuarios (usser, password, mail) VALUES (:username, :password, :email)");
    $query->bindParam(":username", $username);
    $query->bindParam(":password", $password);
    $query->bindParam(":email", $email);

    // Ejecutar consulta
    if ($query->execute()) {
        // Usuario registrado exitosamente, redirigir a la página de login
        header("Location: login.php");
    } else {
        // Error al registrar usuario, mostrar mensaje de error
        $error_message = "Error al registrar usuario";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Contenido HTML -->
    <div class="container">
        <h2>Registro</h2>
        <!-- Formulario de registro -->
        <form action="" method="POST">
            <!-- Campos de usuario, contraseña y correo electrónico -->
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <button type="submit">Registrarse</button>
        </form>
        <!-- Enlace para redirigir al usuario al login -->
        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        <!-- Mensaje de error (si es necesario) -->
        <?php if (isset($error_message)) { ?>
            <p><?php echo $error_message; ?></p>
        <?php } ?>
    </div>
</body>
</html>
