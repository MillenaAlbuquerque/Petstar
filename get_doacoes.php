<?php
session_start();
require_once 'conexao.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit();
}

$idUsuario = $_SESSION['id_usuario'];

$sql = "SELECT tipodoacao, quantdoacao, datadoacao FROM doacoes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();

$doacoes = [];

while ($row = $result->fetch_assoc()) {
    $doacoes[] = $row;
}

echo json_encode(['success' => true, 'doacoes' => $doacoes]);

$stmt->close();
$conn->close();
?>
