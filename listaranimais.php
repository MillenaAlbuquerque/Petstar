<?php
// Inclua o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Consulta SQL para obter os animais cadastrados
$sql = "SELECT * FROM animais";

// Executar a consulta
$result = $conn->query($sql);

// Verificar se há resultados
if ($result->num_rows > 0) {
    // Array para armazenar os animais
    $animais = array();

    // Iterar sobre os resultados e adicionar os animais ao array
    while ($row = $result->fetch_assoc()) {
        $animais[] = $row;
    }

    // Retornar os animais no formato JSON
    echo json_encode($animais);
} else {
    // Se não houver animais cadastrados, retornar uma mensagem de erro
    echo json_encode(array('mensagem' => 'Nenhum animal cadastrado.'));
}

// Fechar a conexão com o banco de dados
$conn->close();


// Obter filtros
$genero = isset($_GET['genero']) ? $_GET['genero'] : 'todos';
$idade = isset($_?>