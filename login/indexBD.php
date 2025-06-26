<?php
require_once("../connection.php");
$conn = getConn();

$flag = 1;

if($_SERVER['REQUEST_METHOD']=="POST"){
        $login    = filter_input(INPUT_POST, "login", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $senha     = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Remover Espaços 
        $login = trim(strip_tags($login));
        $senha = trim(strip_tags($senha));
        //Validação PHP
        if (empty($login) or empty($senha)){
            echo"<script>alert(Campo em Branco)</script>";
        }else{
            // Variável para descriptografar senha 
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            //require faz o select no banco
            $sql = "SELECT *
                    FROM `usuario`
                    WHERE `login`=:login
                    LIMIT 1";

            $result = $conn->prepare($sql);
            $result-> bindParam(':login', $login, PDO::PARAM_STR);
            $result->execute();

            
            if(($result) and ($result->rowCount() != 0)) {
                $row_result = $result->fetch(PDO::FETCH_ASSOC);

                //password_verify($dados['password'], $row_result['senhaUser'])
                if(password_verify($senha, $row_result['senha'])){
                        if(!isset($_SESSION)){
                            session_start();
                        }
                        $_SESSION['id'] = $row_result['id'];
                        $_SESSION['nome'] = $row_result['nome'];
                        $_SESSION['login'] = $row_result['login'];

                        echo'<center style="color: lime;">Logado com sucesso</center>';
                        header("Refresh: 1; url=http://localhost/softlineapp/index.php");
                        exit();
                }else{
                    echo'<script>alert("Senha inválida")</script>';
                }
            } else{
                echo'<script>alert("Login inválido")</script>';
            }
    }
    }else{
        echo("O envio não foi pelo método POST!");
    }
?>