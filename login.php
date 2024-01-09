<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <div class="container border border-3 rounded-4 mt-5  p-4" id="form-container">
        <h1 class="h1 text-center pb-3 border-bottom">Inicio de sesión</h1>
        <form class="row g-3 p-5 fs-5">
            <div class="col-md-12 mb-3 form-floating">
                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="algo@example.com" required>
                <label for="inputEmail">Correo Electrónico</label>
            </div>
            <div class="col-md-12 mb-3 form-floating">
                <input type="password" class="form-control" id="inputPassword" placeholder="contraseña" required>
                <label for="inputPassword">Contraseña</label>
            </div>
            <div class="col-md-3 mb-3"></div>
            <button type="submit" class="btn btn-lg btn-info fs-5 col-md-2 mx-auto mt-5 mb-5">Iniciar sesión</button>
            <a href="register.php" class="btn btn-secondary btn-link fs-5 col-md-2 mx-auto mt-5 mb-5">Regístrese aquí</a>
            <div class="col-md-3 mb-3"></div>
    </div>
    </form>
    <div id="mensajes"></div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>