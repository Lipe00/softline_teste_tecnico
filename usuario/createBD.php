<?php
include_once("../connection.php");
$conn = getConn();
if($conn != null && !empty($_POST)){
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS); 
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS); 
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS); 
    $senha = password_hash($senha, PASSWORD_DEFAULT);

    if(!empty($nome) && !empty($login) && !empty($senha)){
        $sql = "INSERT INTO `usuario`
                                (`nome`, `login`, `senha`)
                            VALUES
                                (:nome, :login, :senha)";
        $stmt = $conn->prepare($sql);
        if($stmt->execute(array(
            ":nome"     => $nome,
            ":login"    => $login,
            ":senha"    => $senha
        ))){
            echo '<p style="text-align:center; color: #48dc50">Usuário cadastrado com sucesso!</p>';
            header("Refresh: 1; URL=./index.php");
            exit();
        }else{
            echo '<p style="text-align:center; color: #ff0000">Erro ao cadastrar novo usuário!</p>';
        }
    }else{
        echo '<p style="text-align:center; color: #ff0000">Campos vazios!</p>';
    }
    
}else if(empty($_POST)){
    echo "Nenhum dado foi enviado!";
}else{
    echo "Erro na conexão!";
}