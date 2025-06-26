<?php
include_once("../connection.php");
$conn = getConn();
if($conn != null && !empty($_POST)){
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS); 
    $nomeFan = filter_input(INPUT_POST, 'nomeFan', FILTER_SANITIZE_SPECIAL_CHARS); 
    $tipoDoc = filter_input(INPUT_POST, 'tipoDoc', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipoDoc = ($tipoDoc === 'cpf') ? 'C' : 'J';
    $documento = filter_input(INPUT_POST, 'documento', FILTER_SANITIZE_SPECIAL_CHARS); 
    $documento = preg_replace('/\D/', '', $documento);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS); 
    
    if(!empty($nome) && !empty($nomeFan) && !empty($tipoDoc) && !empty($documento) && !empty($endereco)){
        $sql = "INSERT INTO `cliente`
                                (`nome`, `fantasia`, `documento`, `tipo_doc`, `endereco`)
                            VALUES
                                (:nome, :fantasia, :documento, :tipo_doc, :endereco)";
        $stmt = $conn->prepare($sql);
        if($stmt->execute(array(
            ":nome"         =>$nome,
            ":fantasia"     =>$nomeFan,
            ":documento"    =>$documento,
            ":tipo_doc"     =>$tipoDoc,
            ":endereco"     =>$endereco
        ))){
            echo '<p style="text-align:center; color: #48dc50">Cliente cadastrado com sucesso!</p>';
            header("Refresh: 1; URL=./index.php");
            exit();
        }else{
            echo '<p style="text-align:center; color: #ff0000">Erro ao cadastrar novo cliente!</p>';
        }
    }else{
        echo '<p style="text-align:center; color: #ff0000">Campos vazios!</p>';
    }
}else if(empty($_POST)){
    echo "Nenhum dado foi enviado!";
}else{
    echo "Erro na conexão!";
}