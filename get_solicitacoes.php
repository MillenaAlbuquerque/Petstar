<?php
session_start();
require_once 'conexao.php';

if (!isset($_SESSION['id_ong'])) {
    echo json_encode(['success' => false, 'message' => 'ONG não autenticada.']);
    exit;
}

$sql = "SELECT s.id, a.nome AS nome_animal, u.nome AS nome_usuario 
        FROM solicitacoes s 
        JOIN animais a ON s.idanimal = a.idanimal 
        JOIN usuarios u ON s.idusuario = u.id 
        WHERE s.idong = {$_SESSION['id_ong']}";

$result = $conn->query($sql);

$solicitacoes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $solicitacoes[] = $row;
    }
}

echo json_encode(['solicitacoes' => $solicitacoes]);

$conn->close();
?>
