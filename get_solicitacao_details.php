<?php
session_start();
require_once 'conexao.php';

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID da solicitação não fornecido.']);
    exit;
}

$id = $_GET['id'];
$sql = "SELECT a.nome AS animal_name, u.nome AS user_name, u.contato AS user_contact, 
               s.residence, s.other_animals, s.people_count, s.support 
        FROM solicitacoes s 
        JOIN animais a ON s.idanimal = a.idanimal 
        JOIN usuarios u ON s.idusuario = u.id 
        WHERE s.id = '$id'";

$result = $conn->query($sql);
$data = $result->fetch_assoc();

echo json_encode($data);

$conn->close();
?>
