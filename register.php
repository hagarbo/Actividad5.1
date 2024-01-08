<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Register</title>
</head>

<?php
require_once "db_functions.php";
// Traer los roles de la bd
$roles = findAllRols();

// Leer los datos del formulario y comprobar que esten bien

if (isset(
    $_POST['inputEmail'],
    $_POST['inputPassword'],
    $_POST['checkPassword'],
    $_POST['inputRol']
)) {
    $email = $_POST['inputEmail'];
    $pwd = $_POST['inputPassword'];
    $checkPwd = $_POST['checkPassword'];
    $rolId = $_POST['inputRol'];

    // Comprobar que el usuario no exista ya
    $user = findUser($email);
    if ($user == null) {
        //añadir usuario, comprobar contraseñas coincidan
        if ($pwd == $checkPwd) {
        }
    } else { //error de que existe usuario
    };
}

?>

<body>
    <div class="container border border-3 rounded-4 mt-5 bg-light p-4" id="form-container">
        <h1 class="h1">Registro de usuario</h1>
        <form class="p-3">
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email:</label>
                <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="inputPassword">
            </div>
            <div class="mb-3">
                <label for="checkPassword" class="form-label">Repita contraseña:</label>
                <input type="password" class="form-control" id="checkPassword">
            </div>
            <div class="mb-3">
                <label class="form-label" for="inputRol">Seleccione el rol:</label>
                <select id="inputRol" class="form-select" required>
                    <?php
                    foreach ($roles as $rol) {
                        echo "<option value=" . $rol['id'] . ">" . $rol['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Usuario</button>
    </div>
    </form>
    <div id="mensajes"></div>
</body>

</html>