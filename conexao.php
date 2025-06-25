<?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "petstar"; 

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
} else {
    //echo "Conexão bem-sucedida!";
}


// $conn->close();
?>
