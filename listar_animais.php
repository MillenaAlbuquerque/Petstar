<?php 
session_start();
header('Content-Type: application/json');

// Configurações de conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'petstar';

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $database);

if (!isset($_SESSION['idong'])) {
    echo json_encode(['response' => ['success' => false, 'message' => 'Acesso não autorizado.']]);
    exit();
}

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['response' => ['success' => false, 'message' => 'Requisição não é do tipo POST.']]);
    exit();
}

// Inicialização dos filtros
$nome = isset($_GET['nome']) ? $conn->real_escape_string($_GET['nome']) : '';
$porte = isset($_GET['porte']) ? $conn->real_escape_string($_GET['porte']) : '';
$genero = isset($_GET['genero']) ? $conn->real_escape_string($_GET['genero']) : '';

// Montagem da consulta SQL com filtros e restrição da ONG logada
$sql = "SELECT idanimal, nomeanimal, idadeanimal, detalheanimal, porteanimal, onganimal, imagemanimal, generoanimal, racaanimal 
        FROM animais 
        WHERE onganimal = '{$_SESSION['idong']}'";

if ($nome !== '') {
    $sql .= " AND nomeanimal LIKE '%$nome%'";
}
if ($porte !== '') {
    $sql .= " AND porteanimal = '$porte'";
}
if ($genero !== '') {
    $sql .= " AND generoanimal = '$genero'";
}

$result = $conn->query($sql);

$animais = array();

// Verifique se a consulta retornou resultados
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $animais[] = $row;
    }
}

// Retorne os dados como JSON
echo json_encode(['animais' => $animais]);

// Fechar a conexão
$conn->close();
?>
