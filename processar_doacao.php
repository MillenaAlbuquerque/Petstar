<?php
session_start();
require_once 'conexao.php';
header('Content-Type: text/html; charset=utf-8');

// Verificar se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não está logado.']);
    exit();
}

// Capturar os dados do formulário
$idUsuario = $_SESSION['id_usuario']; // O ID do usuário logado
$idOng = $_POST['ong'];  // O ID da ONG selecionada
$tipoDoacao = $_POST['tipoDoacao'];  // O tipo de doação
$quantidade = $_POST['quantidade'];  // A quantidade de itens doados

// Verificar se os dados foram enviados corretamente
if (empty($idOng) || empty($tipoDoacao) || empty($quantidade)) {
    echo json_encode(['success' => false, 'message' => 'Por favor, preencha todos os campos.']);
    exit();
}

try {
    // Preparar a consulta para inserir a doação
    $sql = "INSERT INTO doacoes (id, idong, tipodoacao, quantdoacao) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        // Exibe erro se houver problema na preparação da consulta
        echo json_encode(['success' => false, 'message' => 'Erro na preparação da consulta: ' . $conn->error]);
        exit();
    }

    $stmt->bind_param("iisi", $idUsuario, $idOng, $tipoDoacao, $quantidade);

    // Executar a consulta
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Doação registrada com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao registrar a doação: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
    
} catch (mysqli_sql_exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erro: ' . $e->getMessage()]);
}
?>

