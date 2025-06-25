<?php
session_start();
require_once 'conexao.php';

$idOng = isset($_SESSION['idong']) ? $_SESSION['idong'] : 'Usuário não logado';

if ($idOng === 'Usuário não logado') {
    echo "Você precisa fazer login para acessar esta página.";
    exit(); // Encerra o script caso o usuário não esteja logado
}

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido."));
    exit();
}

// Lê os dados do formulário
$data = json_decode(file_get_contents("php://input"), true);
$camposParaAtualizar = [];
$parametros = [];

// Prepara a consulta apenas com os campos que foram preenchidos
if (!empty($data['nomeong'])) {
    $camposParaAtualizar[] = "nomeong = ?";
    $parametros[] = $data['nomeong'];
}
if (!empty($data['cidadeong'])) {
    $camposParaAtualizar[] = "cidadeong = ?";
    $parametros[] = $data['cidadeong'];
}
if (!empty($data['enderecoong'])) {
    $camposParaAtualizar[] = "enderecoong = ?";
    $parametros[] = $data['enderecoong'];
}
if (!empty($data['emailong'])) {
    $camposParaAtualizar[] = "emailong = ?";
    $parametros[] = $data['emailong'];
}
if (!empty($data['telong'])) {
    $camposParaAtualizar[] = "telong = ?";
    $parametros[] = $data['telong'];
}

// Verifica se há campos para atualizar
if (!empty($camposParaAtualizar)) {
    $sql = "UPDATE ongs SET " . implode(", ", $camposParaAtualizar) . " WHERE idong = ?";
    $parametros[] = $idOng;

    $stmt = $conn->prepare($sql);
    $tipos = str_repeat("s", count($parametros)); // Define o tipo de parâmetro (string) para cada campo
    $stmt->bind_param($tipos, ...$parametros);

    if ($stmt->execute()) {
        $response = array("success" => true, "message" => "Perfil atualizado com sucesso!");
    } else {
        $response = array("success" => false, "message" => "Erro ao atualizar o perfil.");
    }
    $stmt->close();
} else {
    $response = array("success" => false, "message" => "Nenhum campo para atualizar.");
}

$conn->close();

// Retorna a resposta em formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
