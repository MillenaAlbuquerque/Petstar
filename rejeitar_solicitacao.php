<?php
require 'conexao.php';
$idsolic = $_GET['id'];

$query = "UPDATE solicitacoes SET status = 'Rejeitada' WHERE idsolic = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $idsolic);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Erro ao atualizar o status."]);
}
?>