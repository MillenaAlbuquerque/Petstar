<?php
session_start();
require_once 'conexao.php';

// Verificar se a ONG está logada
if (!isset($_SESSION['id_ong'])) {
    echo "Usuário não está logado.";
    exit();
}

$idOng = $_SESSION['id_ong']; // ID da ONG logada

// Consulta para buscar as doações recebidas pela ONG logada
$sql = "SELECT d.tipodoacao, d.quantdoacao, u.nome_usuario, d.datadoacao
        FROM doacoes d
        JOIN usuarios u ON d.id = u.id
        WHERE d.idong = ?"; // Filtrar pelas doações recebidas pela ONG

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idOng);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitações de Doação Recebidas</title>
</head>
<body>
    <h1>Solicitações de Doação Recebidas</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Tipo de Doação</th>
                <th>Quantidade</th>
                <th>Nome do Doador</th>
                <th>Data da Doação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Exibir as doações recebidas
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['tipodoacao']}</td>";
                    echo "<td>{$row['quantdoacao']}</td>";
                    echo "<td>{$row['nome_usuario']}</td>";
                    echo "<td>{$row['datadoacao']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhuma doação recebida.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
