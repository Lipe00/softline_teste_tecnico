<?php
header('Content-Type: application/json; charset=utf-8');
require_once("../connection.php");
$conn = getConn();

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'ID não enviado']);
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

try {
    $sql = "DELETE FROM `usuario` WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $success = $stmt->execute([":id" => $id]);

    if ($success) {
        echo json_encode(["success" => true, "message" => "Registro excluído com sucesso."]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao excluir o registro."]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Erro ao excluir o registro: " . $e->getMessage()]);
}
