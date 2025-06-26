<?php
require_once("../connection.php");
$conn = getConn();
if($conn != null && !empty($_POST["id"])){
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS); 
    $nomeFan = filter_input(INPUT_POST, 'nomeFan', FILTER_SANITIZE_SPECIAL_CHARS); 
    $tipoDoc = filter_input(INPUT_POST, 'tipoDoc', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipoDoc = ($tipoDoc === 'cpf') ? 'C' : 'J';
    $documento = filter_input(INPUT_POST, 'documento', FILTER_SANITIZE_SPECIAL_CHARS); 
    $documento = preg_replace('/\D/', '', $documento);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS); 
    
    $sql = "UPDATE `cliente`
                        SET 
                            `nome`       = :nome,
                            `fantasia`   = :fantasia,
                            `documento`  = :documento,
                            `tipo_doc`   = :tipo_doc,
                            `endereco`   = :endereco
                        WHERE
                            `id`         = :id";
        $stmt = $conn->prepare($sql);
        if($stmt->execute(array(
            ":nome"         =>$nome,
            ":fantasia"     =>$nomeFan,
            ":documento"    =>$documento,
            ":tipo_doc"     =>$tipoDoc,
            ":endereco"     =>$endereco,
            ":id"            => $id
        ))){
            echo '<p style="text-align:center; color: #48dc50">Cliente atualizado com sucesso!</p>';
            header("Refresh: 1; URL=./index.php");
            exit();
        }else{
            echo '<p style="text-align:center; color: #ff0000">Erro ao atualizar o cliente!</p>';
        }
    
}else if(empty($_POST)){
    echo "Nenhum dado foi enviado!";
}else{
    echo "Erro na conexão!";
}
