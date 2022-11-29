<?php
    require 'database_connect.php';

    $message = '';

    if (!empty($_POST['email']) && !empty($_POST['password'])) { //COMPRUEBA QUE LOS CAMPOS NO ESTEN VACIOS
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)"; // INSERTA DATOS DENTRO DE LA BASE DE DATOS
        $stmt = $conn->prepare($sql); //EJECUTA METODO PREPARE QUE EJECUTA UNA QUERY EN SQL
        $stmt->bindParam(':email',$_POST['email']); //VINCULA DATOS
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //CIFRA CONTRASEÑA
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            $message = 'Usuario creado satisfactoriamente';
        } else {
            $message = 'El usuario no se ha podido crear';
        }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registro</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <!-- BOOTSTRAP -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- CSS -->
        <link rel="stylesheet" href="styles/register.css">
	</head>
	<body>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p> <!--Escribir mensaje si la variable no está vacia!-->
    <?php endif; ?>

        <div class="login container-fluid d-flex align-items-center justify-content-center">
            <div class="register text-center">
                <h1>Registro</h1>
                <form action="signup.php" method="post" autocomplete="off" class="d-flex flex-wrap justify-content-center">
                    <label for="username" class="icon d-flex justify-content-center align-items-center">
                        <i class="fas fa-user"></i>
                    </label>
                    <input type="text" name="username" placeholder="Username" id="username" required>
                    <label for="password" class="icon d-flex justify-content-center align-items-center">
                        <i class="fas fa-lock"></i>
                    </label>
                    <input type="password" name="password" placeholder="Password" id="password" required>
                    <label for="email" class="icon d-flex justify-content-center align-items-center">
                        <i class="fas fa-envelope"></i>
                    </label>
                    <input type="email" name="email" placeholder="Email" id="email" required>
                    <input type="submit" value="Register">
                </form>
            </div>
        </div>

    <!-- SCRIPT BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>