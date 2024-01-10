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
$exito = false;
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
    if (!$user && $pwd == $checkPwd) {
        //añadir usuario, comprobar contraseñas coincidan
        $data = array(
            "email" => $email,
            "pwd" => password_hash($pwd, PASSWORD_BCRYPT),
            "rol_id" => $rolId
        );
        $exito = createUser($data);
    }
}

?>

<body>
    <div class="container border border-3 rounded-4 mt-5 bg-light p-4 mb-3" id="form-container">
        <h1 class="h1">Registro de usuario</h1>
        <form class="p-3" method="post" action="register.php">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" required>
                <label for="inputEmail" class="form-label">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="inputPassword" name="inputPassword" required>
                <label for="inputPassword" class="form-label">Contraseña</label>

            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="checkPassword" name="checkPassword" required>
                <label for="checkPassword" class="form-label">Repita contraseña</label>

            </div>
            <div class="form-floating mb-3">
                <select id="inputRol" class="form-select" name="inputRol" required>
                    <?php
                    foreach ($roles as $rol) {
                        echo "<option value=" . $rol['id'] . ">" . $rol['name'] . "</option>";
                    }
                    ?>
                </select>
                <label class="form-label" for="inputRol">Seleccione el rol</label>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Usuario</button>
        </form>
    </div>
    <div id="mensajes" class="container mb-3">
        <?php
        if (isset($_POST["inputEmail"])) {
            if ($exito) {
                echo "<div class='alert alert-success' role='alert'>Usuario creado correctamente</div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>Error al crear el usuario</div>";
            }
        }
        ?></div>
</body>

</html>