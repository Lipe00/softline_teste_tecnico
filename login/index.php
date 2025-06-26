<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/create.css">
</head>
<body>
    <?php
        if(!isset($_SESSION['login'])){
    ?>
        <section class="container">
            <form action="" class="form" method="POST">
                <h1 style="display: flex;justify-content: center;">Login</h1>
                <?php
                    if (isset($_POST['btn'])) {

                        include_once('./indexBD.php');
                    }
                    ?>
            <div class="input-box">
                <label>Login</label>
                <input type="text" placeholder="Informe seu login" name="login" required />
            </div>
            <div class="input-box password-box">
            <label>Senha</label>
            <div class="password-wrapper">
                <input type="password" placeholder="Informe sua senha" name="password" id="password" required/>
                <i class="ri-eye-off-fill toggle-password" id="toggle-password"></i>
            </div>
        </div>
                <button name="btn">L O G A R</button>
            </form>
        </section>
    <?php
        }else{
            header("Refresh: 1; URL=.http://localhost/softlineapp/index.php");
            exit();
        }
    ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="../js/nav.js"></script>
    <script>
        $('#toggle-password').click(function () {
                const passwordInput = $('#password');

                // Alternar tipo de entrada
                const isPassword = passwordInput.attr('type') === 'password';
                passwordInput.attr('type', isPassword ? 'text' : 'password');

                // Atualizar o ícone
                $(this).toggleClass('ri-eye-fill', isPassword);
                $(this).toggleClass('ri-eye-off-fill', !isPassword);
            });
    </script>
</body>
</html>