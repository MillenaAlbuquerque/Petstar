<?php
session_start();
require_once 'conexao.php';

// Verifica se o usuário está autenticado
if (!isset($_SESSION['email_usuario'])) {
    echo json_encode(array("success" => false, "message" => "Usuário não autenticado."));
    exit();
}

// Obtém o e-mail do usuário logado
$email_usuario = $_SESSION['email_usuario'];

// Lê os dados do formulário
$data = json_decode(file_get_contents("php://input"), true);

// Verifica se todos os campos estão presentes
if (isset($data['nome']) && isset($data['datanasc']) && isset($data['fone']) && isset($data['cidade']) && isset($data['endereco'])) {
    $nome = $data['nome'];
    $datanasc = $data['datanasc'];
    $fone = $data['fone'];
    $cidade = $data['cidade'];
    $endereco = $data['endereco'];

    // Atualiza as informações no banco de dados
    $sql = "UPDATE usuarios SET nome = ?, datanasc = ?, fone = ?, cidade = ?, endereco = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    // Associa os parâmetros e executa a consulta
    $stmt->bind_param("ssssss", $nome, $datanasc, $fone, $cidade, $endereco, $email_usuario);
    
    if ($stmt->execute()) {
        $_SESSION['nome_usuario'] = $nome; // Atualiza o nome na sessão
        $response = array("success" => true, "message" => "Perfil atualizado com sucesso!");
    } else {
        $response = array("success" => false, "message" => "Erro ao atualizar o perfil.");
    }
    
    $stmt->close();
} else {
    $response = array("success" => false, "message" => "Todos os campos são obrigatórios.");
}

$conn->close();

// Retorna a resposta em formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
