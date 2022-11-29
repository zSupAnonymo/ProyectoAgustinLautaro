<?php
 require 'database_connect.php';
 
 if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id,mail,password FROM users where id = :id');
    $records->bindParam(':id',$_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (is_countable($results) && count($results) > 0) {
        $user = $results;
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="styles/index.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<?php if(!empty($user)): ?>
      <br> Bienvenido, <?= $user['email']; ?>
      <br>Has iniciado sesión correctamente
      <a href="logout.php">
        Cerrar Sesión
      </a>
    <?php else: ?>
    <section class="welcome d-flex flex-column justify-content-center">
      <div class="box-welcome container-fluid text-center">
        <h1 class="fs-2 fw-bold">Por favor inicia sesión o regístrate.</h1>

        <div class="btn-grid d-grid gap-2">
          <a href="login.php" class="btn-login btn btn-primary py-3 fs-4" role="button">Iniciar Sesión</a>
          <a href="signup.php" class="btn-signup btn btn-primary py-3 fs-4" role="button">Registrarse</a>
        </div>

      </div>
    </section>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>