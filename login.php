<?php
// Verificar si el usuario está intentando iniciar sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar campos
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Conectar a la base de datos
    $conn = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb, *.accdb)}; DBQ=Database11.accdb");

    // Consulta SQL para verificar credenciales
    $query = $conn->prepare("SELECT * FROM usuarios WHERE usser = :username AND password = :password");
    $query->bindParam(":username", $username);
    $query->bindParam(":password", $password);
    $query->execute();

    // Verificar si se encontraron resultados
    if ($query->rowCount() > 0) {
        // Usuario autenticado, redirigir a la página de inicio
        header("Location: index.php");
    } else {
        // Credenciales inválidas, mostrar mensaje de error
        $error_message = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Contenido HTML -->
    <div class="container">
        <h2>Login</h2>
        <!-- Formulario de inicio de sesión -->
        <form action="" method="POST">
            <!-- Campos de usuario y contraseña -->
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar sesión</button>
        </form>
        <!-- Enlace para redirigir a la página de registro -->
        <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
        <!-- Mensaje de error (si es necesario) -->
        <?php if (isset($error_message)) { ?>
            <p><?php echo $error_message; ?></p>
        <?php } ?>
    </div>
</body>
</html>

