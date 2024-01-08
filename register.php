<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<?php
    require_once "db_functions.php";
    // Traer los roles de la bd
$roles = findAllRols();

// Leer los datos del formulario y comprobar que esten bien

if ($_POST['inputEmail'] && $_POST['inputPassword'] && $_POST['checkPassword'] && $_POST['inputRol']){
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
    } 
    else { //error de que existe usuario
    };
}

// Comprobar que el usuario no exista ya

// Si existe, mensaje de error. y si no existe lo insertamos


?>

<body>
    <div class="container">
        <form>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="inputPassword">
            </div>
            <div class="mb-3">
                <label for="checkPassword" class="form-label">Repita contraseña</label>
                <input type="password" class="form-control" id="checkPassword">
            </div>
            <div class="mb-3">
                <label class="" for="inputRol">Seleccione el rol:</label>
                <select id="inputRol">
                    <?php
                        foreach ($roles as $rol) {
                        echo "<option value=".$rol['id'] .">". $rol['name'] ."</option>";
                        }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Usuario</button>
        </form>
    </div>
    <div id="mensajes"></div>
</body>
</html>

