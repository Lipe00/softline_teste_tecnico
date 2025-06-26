<?php
require_once("../connection.php");
$conn = getConn();
if($conn != null && !empty($_POST)){
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
    $codBar = filter_input(INPUT_POST, 'codBar', FILTER_SANITIZE_NUMBER_INT);
    $valorVenda = filter_input(INPUT_POST, 'valorVenda', FILTER_SANITIZE_NUMBER_FLOAT);
    $pesoBruto = filter_input(INPUT_POST, 'pesoBruto', FILTER_SANITIZE_NUMBER_FLOAT);
    $pesoLiquido = filter_input(INPUT_POST, 'pesoLiquido', FILTER_SANITIZE_NUMBER_FLOAT);
    if(!empty($descricao) && !empty($codBar) && !empty($valorVenda) && !empty($pesoBruto) && !empty($pesoLiquido)){
        $sql = "INSERT INTO `produto`
                                (`descricao`, `codigoBarras`, `valorVenda`, `pesoBruto`, `pesoLiquido`)
                            VALUES
                            (:descricao, :codBar, :valorVenda, :pesoBruto, :pesoLiquido)";
        $stmt = $conn->prepare($sql);
        if($stmt->execute(array(
            ":descricao"     => $descricao,
            ":codBar"    => $codBar,
            ":valorVenda"    => $valorVenda,
            ":pesoBruto"    => $pesoBruto,
            ":pesoLiquido"    => $pesoLiquido
        ))){
            echo '<p style="text-align:center; color: #48dc50">Produto cadastrado com sucesso!</p>';
            header("Refresh: 1; URL=./index.php");
            exit();
        }else{
            echo '<p style="text-align:center; color: #ff0000">Erro ao cadastrar novo produto!</p>';
        }
    }else{
        echo '<p style="text-align:center; color: #ff0000">Campos vazios!</p>';
    }
    
}else if(empty($_POST)){
    echo "Nenhum dado foi enviado!";
}else{
    echo "Erro na conexão!";
}
