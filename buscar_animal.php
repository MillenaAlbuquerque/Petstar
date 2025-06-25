<?php
// buscar_animal.php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


header('Content-Type: application/json');

require_once 'conexao.php';

// Verifica se foi recebido um ID válido via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta SQL para buscar os dados do animal pelo ID
    $sql = "SELECT * FROM animais WHERE idanimal = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Extrai os dados do animal do resultado da consulta
        $animal = $result->fetch_assoc();

        // Retorna os dados do animal como JSON
        echo json_encode($animal);
    } else {
        // Caso não encontre o animal com o ID especificado
        http_response_code(404); 
        echo json_encode(array('message' => 'Animal não encontrado.'));
    }
} else {

    http_response_code(400); 
    echo json_encode(array('message' => 'ID do animal não fornecido.'));
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
