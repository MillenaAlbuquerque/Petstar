<?php
// Conecte-se ao banco de dados
require_once 'conexao.php';

// Verifique se o ID foi passado
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Consulta para buscar os detalhes da solicitação com base no ID
    $query = "SELECT idsolic, qcasa, qanimais, qpessoas, qsuporte FROM solicitacoes WHERE idsolic = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se a solicitação for encontrada
    if ($result->num_rows > 0) {
        $solicitacao = $result->fetch_assoc();

        // Retorna os dados em formato JSON
        echo json_encode($solicitacao);
    } else {
        // Caso a solicitação não seja encontrada, retorna um erro
        echo json_encode(["error" => "Solicitação não encontrada"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "ID não fornecido"]);
}

$conn->close();
?>
