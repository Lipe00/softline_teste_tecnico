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
    <link rel="stylesheet" href="../css/create.css">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <div class="container">
        <h1 class="title-text">Cadastro de Usuários</h1>
        <form action="" class="form" id="form" method="POST">
            <?php
            if(isset($_POST['btn-cad'])){
                include('./createBD.php');
            }
            ?>
            <div class="input-box">
                <label>Nome</label>
                <input type="text" placeholder="Informe o nome do usuário" name="nome" id="nome" required />
            </div>

            <div class="input-box">
                <label>Login</label>
                <input type="text" placeholder="Informe o login do usuário" name="login" id="login" required />
            </div>

            <div class="input-box password-box">
            <label>Senha</label>
                <div class="password-wrapper">
                    <input type="password" placeholder="Senha do usuário" name="senha" id="senha" required/>
                    <i class="ri-eye-off-fill toggle-password" id="toggle-password"></i>
                </div>
            </div>

            <div class="input-box password-box">
            <label>Confirmar senha</label>
                <div class="password-wrapper">
                    <input type="password" placeholder="Confirmar senha do usuário" name="confSenha" id="confSenha" required/>
                    <i class="ri-eye-off-fill toggle-password" id="toggle-conf-password"></i>
                </div>
            </div>
            <button name="btn-cad">Cadastrar</button>
            <button class="btn-cancel" type="button" onclick="history.back()">Voltar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function (){
            $('#toggle-password').click(function () {   
                const input = $('#senha');

                // Alternar tipo de entrada
                const isPassword = input.attr('type') === 'password';
                input.attr('type', isPassword ? 'text' : 'password');

                // Atualizar o ícone
                $(this).toggleClass('ri-eye-fill', isPassword);
                $(this).toggleClass('ri-eye-off-fill', !isPassword);
            });
            $('#toggle-conf-password').click(function () {
                const input = $('#confSenha');

                // Alternar tipo de entrada
                const isPassword = input.attr('type') === 'password';
                input.attr('type', isPassword ? 'text' : 'password');

                // Atualizar o ícone
                $(this).toggleClass('ri-eye-fill', isPassword);
                $(this).toggleClass('ri-eye-off-fill', !isPassword);
            });
        });
        
    </script>
</body>
</html>