<?php
function conectar()
{
    $user = "root";
    $password = "";
    $server = "localhost";
    $db_name = "proyectoagustinlautaro";
    $conn = mysqli_connect($server, $user, $password) or die("Error al conectar");
    mysqli_connect($server, $user, $password, $db_name);

    return $conn;
}
