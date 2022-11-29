<?php
    session_start(); //inicializo session para poder usar sesiones

    require 'database_connect.php';

    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email'); //Consulta para seleccionar los datos que coicinan con el parametro email, OBTENGO
        $records->bindParam(':email', $_POST['email']); //VINCULO
        $records->execute(); //EJECUTAMOS CONSULTA
        $results = $records->fetch(PDO::FETCH_ASSOC); //obtenemos datos del usuario asociandolo

        $message = '';

        if (is_countable($results) && count($results) > 0 && password_verify($_POST['password'], $results['password'])) { //COMPARAMOS CONTRASEÑA DEL NAVEGADOR A LA ALMACENADA EN BASE DE DATOS
            $_SESSION['user_id'] = $results['id'];
            header('location: home.php');
        } else {
            $message = 'Las credenciales no son correctas';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <title>Iniciar sesión</title>
</head>

<body>

    <?php if (!empty($message)) : ?>
        <p><?= $message ?></p>
    <?php endif;?>

    <div class="login">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="email">
                <i class="fas fa-envelope"></i>
            </label>
            <input type="text" name="email" placeholder="Email" id="email" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>

</html>