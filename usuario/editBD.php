<?php
require_once("../connection.php");
$conn = getConn();
if($conn != null && !empty($_POST["id"])){
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS); 
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS); 
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS); 

    if(empty($senha)){
        $sql = "UPDATE `usuario`
                        SET 
                            `nome`  = :nome,
                            `login` = :login
                        WHERE
                            `id`    = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ":nome"     => $nome,
            ":login"    => $login,
            ":id"       => $id
        ));
    }else{
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE `usuario`
                        SET 
                            `nome`  = :nome,
                            `login` = :login,
                            `senha` = :senha
                        WHERE
                            `id`    = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
        ":nome"     => $nome,
        ":login"    => $login,
        ":senha"    => $senha,
        ":id"       => $id
        ));
    }
        
        if($stmt->rowCount() > 0){
            echo '<p style="text-align:center; color: #48dc50">Produto atualizado com sucesso!</p>';
            header("Refresh: 1; URL=./index.php");
            exit();
        }else{
            echo '<p style="text-align:center; color: #ff0000">Erro ao atualizar o produto!</p>';
        }
    
}else if(empty($_POST)){
    echo "Nenhum dado foi enviado!";
}else{
    echo "Erro na conexão!";
}
