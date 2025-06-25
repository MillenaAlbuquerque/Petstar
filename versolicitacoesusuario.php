<?php
session_start();

$idUsuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;

if (!$idUsuario) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit();
}

// Conexão ao banco de dados
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require_once 'conexao.php';

try {
    // Consulta SQL para retornar as solicitações do usuário
    $sql = "SELECT 
                s.idsolic AS id, 
                a.nomeanimal AS nome_animal, 
                a.onganimal AS ong_animal, 
                s.qcasa, 
                s.qanimais, 
                s.qpessoas, 
                s.qsuporte, 
                s.status
            FROM solicitacoes s
            JOIN animais a ON s.idanimal = a.idanimal
            WHERE s.id = ?"; // Filtra as solicitações do usuário

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $result = $stmt->get_result();

    $solicitacoes = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $solicitacoes[] = $row;
        }
    } else {
        $solicitacoes = []; // Adicione isso para garantir que seja um array
    }
    

    echo json_encode(['success' => true, 'solicitacoes' => $solicitacoes]);

} catch (mysqli_sql_exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao buscar solicitações: ' . $e->getMessage()]);
}

$conn->close();
?>
