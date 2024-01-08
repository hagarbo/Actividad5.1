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
function findUser(string $email): array
{
    $conProyecto = getConnection();
    $pdostmt = $conProyecto->prepare("SELECT * FROM usuario where email = ?");
    $pdostmt->execute([$email]);
    //$pdostmt->debugDumpParams();
    $array = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
    return $array;
}
function crear_usuario(array $data): bool
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

        if ($data["users"] != null) {
            //Inserciones en bookauthors
            $pdostmt_c_book_authors = $conProyecto->prepare("INSERT INTO book_authors (book_id,author_id) 
                                            VALUES (:book_id,:author_id)");
            $pdostmt_c_book_authors->bindParam("book_id", $user_id);
            foreach ($data["users"] as $users_id) {
                $pdostmt_c_book_authors->bindParam("author_id", $users_id);
                if (!$pdostmt_c_book_authors->execute()) throw new Exception();
            }
        }

        $conProyecto->commit();
    } catch (Exception $e) {
        $conProyecto->rollBack();
        echo "Ocurrio un error al intentar crear el nuevo libro, mensaje: " . $e->getMessage();
        return false;
    }

    return true;
}
