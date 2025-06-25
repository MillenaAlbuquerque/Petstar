<?php
header('Content-Type: application/json');

// Configurações de conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'petstar';

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o parâmetro 'id' foi passado
$id = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : '';

if ($id) {
    // Consulta para buscar os detalhes do animal pelo id
    $sql = "SELECT idanimal, nomeanimal, idadeanimal, detalheanimal, porteanimal, onganimal, imagemanimal, generoanimal, racaanimal FROM animais WHERE idanimal = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $animal = $result->fetch_assoc();
        echo json_encode(['animal' => $animal]);
    } else {
        echo json_encode(['animal' => null]);
    }
} else {
    echo json_encode(['error' => 'ID do animal não fornecido']);
}

$conn->close();
?>
