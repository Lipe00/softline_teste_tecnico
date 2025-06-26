<?php
require_once('../connection.php');
$conn = getConn();

if ($conn != null) {
    $sql = "SELECT * FROM produto ORDER BY id";
    $select = $conn->prepare($sql);

    try{
        $select->execute();
        $result = $select->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    };
} else {
    echo json_encode(["erro" => "Erro ao conectar com banco de dados"]);
}