<!DOCTYPE html>
<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['id'])){
    header("Location: http://localhost/softlineapp/login/index.php");
    exit();
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/create.css">
    <title>Editar Usuário</title>
</head>
<body>
    <div class="container">
        <?php
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        if(!empty($id)){
            require_once('../connection.php');
            $conn = getConn();
            $sql = "SELECT * FROM usuario";
            $select = $conn->prepare($sql);
            $select->execute();
            $result = $select->fetch(PDO::FETCH_ASSOC);
        ?>
        <h1 class="title-text">Editar Usuário</h1>
        <form action="" class="form" id="form" method="POST">
            <?php
                if(isset($_POST['btn-edit'])){
                    include('./editBD.php');
                }
            ?>
            <input type="hidden" name="id" value="<?= $result['id'] ?>">
            <div class="input-box">
                <label>Nome</label>
                <input type="text" placeholder="Informe o nome do usuário" name="nome" id="nome" value="<?=$result['nome'];?>" />
            </div>

            <div class="input-box">
                <label>Login</label>
                <input type="text" placeholder="Informe o login do usuário" name="login" id="login" value="<?=$result['login'];?>" />
            </div>

            <div class="input-box password-box">
            <label>Senha</label>
                <div class="password-wrapper">
                    <input type="password" placeholder="Senha do usuário" name="senha" id="senha"/>
                    <i class="ri-eye-off-fill toggle-password" id="toggle-password"></i>
                </div>
                <span class="hint">Deixe vazio caso não queira trocar!</span>
            </div>

            <div class="input-box password-box">
            <label>Confirmar senha</label>
                <div class="password-wrapper">
                    <input type="password" placeholder="Confirmar senha do usuário" name="confSenha" id="confSenha"/>
                    <i class="ri-eye-off-fill toggle-password" id="toggle-conf-password"></i>
                </div>
                <span class="hint">Deixe vazio caso não queira trocar!</span>
            </div>
            <button name="btn-edit">Cadastrar</button>
            <button class="btn-cancel" type="button" onclick="history.back()">Voltar</button>
            
        </form>
        <?php    
        }else{
        ?>
        <h1>Nenhum registro selecionado!</h1>
        <?php
        }
        ?>
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