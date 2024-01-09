<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
    <div class="container border border-3 rounded-4 mt-5  p-4" id="form-container">
        <h1 class="h1 text-center pb-3 border-bottom">Registro de usuario</h1>
        <form class="row g-3 p-5 fs-5">
            <div class="col-md-12 mb-3 form-floating">
                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="algo@example.com" required>
                <label for="inputEmail">Correo Electrónico</label>
            </div>
            <div class="col-md-6 mb-3 form-floating">
                <input type="password" class="form-control" id="inputPassword" placeholder="contraseña" required>
                <label for="inputPassword">Contraseña</label>
            </div>
            <div class="col-md-6 mb-3 form-floating">
                <input type="password" class="form-control" id="checkPassword" placeholder="contraseña" required>
                <label for="checkPassword">Repita contraseña</label>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="inputRol">Seleccione el rol:</label>
                <select id="inputRol" class="form-select fs-5" required>
                    <?php
                    foreach ($roles as $rol) {
                        echo "<option value=" . $rol['id'] . ">" . $rol['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3 mb-3">

            </div>

            <button type="submit" class="btn btn-lg btn-info fs-5 col-md-3 mx-auto mt-5 mb-5">Registrar Usuario</button>

    </div>
    </form>
    <div id="mensajes"></div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>