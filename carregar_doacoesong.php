<?php
session_start();
require_once 'conexao.php';
// Verificar se a ONG está logada
$idOng = isset($_SESSION['idong']) ? $_SESSION['idong'] : 'Usuário não logado';

if ($idOng === 'Usuário não logado') {
    echo "Você precisa fazer login para acessar esta página.";
    exit(); // Encerra o script caso o usuário não esteja logado
}


// Consulta para buscar as doações recebidas pela ONG logada
$sql = "SELECT d.tipodoacao, d.quantdoacao, u.nome, u.fone, u.email, d.datadoacao
        FROM doacoes d
        JOIN usuarios u ON d.id = u.id
        WHERE d.idong = ?"; // Filtrar pelas doações recebidas pela ONG

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idOng);
$stmt->execute();
$result = $stmt->get_result();

// Exibir as doações
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['tipodoacao']}</td>";
        echo "<td>{$row['quantdoacao']}</td>";
        echo "<td>{$row['nome']}</td>";
        echo "<td>{$row['fone']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['datadoacao']}</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Nenhuma doação recebida.</td></tr>";
}

$stmt->close();
$conn->close();
?>
