<?php
require_once "conexion.php";

/**
 * findAllPublishers
 * Crea una consulta con PDO y obtiene todos los datos de la tabla publishers
 * @return array Array con todas las tuplas de la tabla publishers como array asociativo
 */
function findAllRols(): array
{
    $conProyecto = getConnection();
    $pdostmt = $conProyecto->prepare("SELECT * FROM rol");

    $pdostmt->execute();
    //$pdostmt->debugDumpParams();
    $array = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
    return $array;
}
function findUser(string $email): array | bool
{
    $conProyecto = getConnection();
    $pdostmt = $conProyecto->prepare("SELECT * FROM usuario where email = ?");
    $pdostmt->execute([$email]);
    //$pdostmt->debugDumpParams();
    $array = $pdostmt->fetch(PDO::FETCH_ASSOC);
    return $array;
}

function findRolsById(int $user_id): array
{
    $conProyecto = getConnection();
    $pdostmt = $conProyecto->prepare("SELECT idRol, name from usuario_rol join rol 
                                    ON usuario_rol.idRol = rol.id 
                                    WHERE usuario_rol.idUsuario = ?");
    $pdostmt->execute([$user_id]);
    //$pdostmt->debugDumpParams();
    $array = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
    return $array;
}
function createUser(array $data): bool
{
    try {
        $conProyecto = getConnection();
        $conProyecto->beginTransaction();
        //Insercion en usuario
        $pdostmt_user = $conProyecto->prepare("INSERT INTO usuario (email,pwdhash) 
                                VALUES (:email,:pwd)");
        //Parametros
        $pdostmt_user->bindParam("email", $data["email"]);
        $pdostmt_user->bindParam("pwd", $data["pwd"]);

        //Creamos el usuario y recuperamos el id
        if ($pdostmt_user->execute()) $user_id = $conProyecto->lastInsertId();
        else throw new Exception();

        //Creamos la referencia en la tabla usuario_rol
        $pdostmt_user_rol = $conProyecto->prepare("INSERT INTO usuario_rol (idUsuario,idRol) 
                                    VALUES (:user_id,:rol_id)");
        $pdostmt_user_rol->bindParam("user_id", $user_id);
        $pdostmt_user_rol->bindParam("rol_id", $data["rol_id"]);
        if (!$pdostmt_user_rol->execute()) throw new Exception();

        //Finaliza la transaccion
        $conProyecto->commit();
    } catch (Exception $e) {
        $conProyecto->rollBack();
        echo "Ocurrio un error al intentar crear el usuario, mensaje: " . $e->getMessage();
        return false;
    }

    return true;
}
