<?php
require_once("../connection.php");
$conn = getConn();
if($conn != null && !empty($_POST["id"])){
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
    $codBar = filter_input(INPUT_POST, 'codBar', FILTER_SANITIZE_NUMBER_INT);
    $valorVenda = filter_input(INPUT_POST, 'valorVenda', FILTER_SANITIZE_NUMBER_FLOAT);
    $pesoBruto = filter_input(INPUT_POST, 'pesoBruto', FILTER_SANITIZE_NUMBER_FLOAT);
    $pesoLiquido = filter_input(INPUT_POST, 'pesoLiquido', FILTER_SANITIZE_NUMBER_FLOAT);
    
    $sql = "UPDATE `produto` SET
                                `descricao` = :descricao,
                                `codigoBarras` = :codBar,
                                `valorVenda` = :valorVenda,
                                `pesoBruto` = :pesoBruto,
                                `pesoLiquido` = :pesoLiquido
                            WHERE `id` = :id";
        $stmt = $conn->prepare($sql);
        if($stmt->execute(array(
            ":descricao"     => $descricao,
            ":codBar"    => $codBar,
            ":valorVenda"    => $valorVenda,
            ":pesoBruto"    => $pesoBruto,
            ":pesoLiquido"    => $pesoLiquido,
            ":id"            => $id
        ))){
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
