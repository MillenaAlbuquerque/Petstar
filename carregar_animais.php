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

// Inicialização dos filtros
$nome = isset($_GET['nome']) ? $conn->real_escape_string($_GET['nome']) : '';
$porte = isset($_GET['porte']) ? $conn->real_escape_string($_GET['porte']) : '';
$genero = isset($_GET['genero']) ? $conn->real_escape_string($_GET['genero']) : '';

$sql = "SELECT 
            a.idanimal, 
            a.nomeanimal, 
            a.idadeanimal, 
            a.detalheanimal, 
            a.porteanimal, 
            a.imagemanimal, 
            a.generoanimal, 
            a.racaanimal,
            o.nomeong AS onganimal_nome 
        FROM animais a
        JOIN ongs o ON a.onganimal = o.idong
        WHERE 1=1";

// Montagem da consulta SQL com filtros
//$sql = "SELECT idanimal, nomeanimal, idadeanimal, detalheanimal, porteanimal, onganimal, imagemanimal, generoanimal, racaanimal FROM animais WHERE 1=1";

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

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $animais[] = $row;
    }
} else {
    echo json_encode(['animais' => []]);
    exit();
}

echo json_encode(['animais' => $animais]);

$conn->close();
?>

