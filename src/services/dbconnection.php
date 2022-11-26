<?php
function conectar()
{
    $user = "root";
    $password = "";
    $server = "localhost";
    $db_name = "proyectoagustinlautaro";
    $conn = mysqli_connect($server, $user, $password, $db_name) or die("Error al conectar");

    return $conn;
}
