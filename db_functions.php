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
    $pdostmt->debugDumpParams();
    $array = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
    return $array;
}
