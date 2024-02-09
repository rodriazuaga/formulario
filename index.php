<?php
require_once('conexion.php');

$error = null;
$flash = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["inputNombre"])||empty($_POST["inputApellido"])||empty($_POST["inputEmail"])||empty($_POST["inputPassword"])){
        $error = "Por favor rellene todos los campos.";
    } else {
        $nombre = $_POST["inputNombre"];
        $apellido = $_POST["inputApellido"];
        $email = $_POST["inputEmail"];
        $password = $_POST["inputPassword"];

        $statement = $conn->prepare("INSERT INTO usuarios (nombre, apellido, email, contrasena) 
        VALUES ('$nombre', '$apellido', '$email', '$password')");
        if ($statement->execute()){
            $flash = "Usuario añadido correctamente.";
            
        } else {
            $error = "Error al añadir usuario.";
        }
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-image: url('patron.png'); 
            background-position: center;
            background-repeat: repeat; 
            
        }
    </style>
    <title>Registro de Alumnos</title>
</head>
<body class="col-12 col-md-6 col-lg-4 mx-auto my-5">
    <div class="card">
    <h1 class="card-header text-center">Registro de Alumnos</h1>
    <div class=" card-body container">
        <?php if ($error): ?>
            <p class="text-danger">
            <?= $error ?>
            </p>
        <?php endif ?>

        <form action="index.php" method="post"  class="row g-3">
            <div class="col-12">
                <label for="inputNombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="inputNombre" name="inputNombre">
            </div>
            <div class="col-12">
                <label for="inputApellido" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="inputApellido" name="inputApellido">
            </div>
            <div class="col-12">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="inputEmail">
            </div>
            <div class="col-12">
                <label for="inputPassword" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="inputPassword" name="inputPassword">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-lg">
                    Enviar
                </button>
            </div>
        </form>

        <?php if ($flash): ?> 
            <div class="alert alert-success">
                <?= $flash ?> 
            </div>
            <script>
                setTimeout(function(){
                    window.location.href = "index.php";
                }, 3000); // 2000 milisegundos (2 segundos)
            </script>
        <?php endif ?>
    </div>
    </div>
</body>
</html>
