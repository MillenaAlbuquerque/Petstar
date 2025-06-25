<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir arquivo de conexão
require_once 'conexao.php';
session_start(); // Iniciar a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se os dados foram enviados corretamente
    if (
        isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['datanasc']) && 
        isset($_POST['fone']) && isset($_POST['cidade']) && isset($_POST['endereco']) && isset($_POST['senha'])
    ) {
        // Dados Pessoais
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $datanasc = $_POST['datanasc'];
        $fone = $_POST['fone'];
        $cidade = $_POST['cidade'];
        $endereco = $_POST['endereco'];
        $senha = $_POST['senha']; // Criptografar a senha

        // Inserir dados na tabela 'usuarios' usando prepared statements
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, datanasc, fone, cidade, endereco, senha) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nome, $email, $datanasc, $fone, $cidade, $endereco, $senha);

        if ($stmt->execute()) {
            // Armazenar informações do usuário na sessão
            $_SESSION['usuario_id'] = $stmt->insert_id; // ID do usuário recém-inserido
            $_SESSION['usuario_nome'] = $nome; // Nome do usuário
            
            echo "Dados inseridos com sucesso!";
        } else {
            echo "Erro ao inserir dados: " . $stmt->error;
        }
        $stmt->close(); // Fechar a declaração
    } else {
        echo "Todos os campos são obrigatórios.";
    }
} else {
    echo "Requisição não é do tipo POST.";
}

// Fechar conexão
$conn->close();
?>
