<?php
session_start();

$idOng = isset($_SESSION['idong']) ? $_SESSION['idong'] : null;

if (!$idOng) {
    echo json_encode(['error' => 'Usuário não autenticado.']);
    exit();
}

// Conexão ao banco de dados
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require_once 'conexao.php';

try {
    // Consulta SQL simplificada para retornar todas as solicitações
    $sql = "SELECT 
                s.idsolic AS id, 
                a.nomeanimal AS nome_animal, 
                u.nome AS nome_usuario, 
                u.email AS email_usuario, 
                u.fone AS telefone_usuario,
                s.qcasa, 
                s.qanimais, 
                s.qpessoas, 
                s.qsuporte
            FROM solicitacoes s
            JOIN animais a ON s.idanimal = a.idanimal
            JOIN usuarios u ON s.id = u.id";

    $result = $conn->query($sql);
    
    $solicitacoes = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $solicitacoes[] = $row;
        }
    }

    echo json_encode($solicitacoes);

} catch (mysqli_sql_exception $e) {
    echo json_encode(['error' => 'Erro ao buscar solicitações: ' . $e->getMessage()]);
}

$conn->close();
?>
