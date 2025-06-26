<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['id'])){
    header("Location: http://localhost/softlineapp/login/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/nav.css">
    <title>SoftlineApp</title>
</head>
<body>
    <?php
        include('./navbar.php');
    ?>
    <div class="body-container">
        <h1>Bem-vindo(a)</h1>
        <br>
        <div class="buttons-menu">
            <a href="./cliente/" class="btn">Ir para Clientes</a>
            <a href="./usuario/" class="btn">Ir para Usuários</a>
            <a href="./produto/" class="btn">Ir para Produtos</a>
            <br>
            <a href="./login/logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
    <script src="./js/nav.js"></script>
</body>
</html>