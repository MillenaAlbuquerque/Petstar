<?php
// Incluir arquivo de conexão
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se os dados foram enviados corretamente
    if (
        isset($_POST['nomeAnimal']) && isset($_POST['idadeAnimal']) && isset($_POST['detalheAnimal']) && 
        isset($_POST['porteAnimal']) && isset($_POST['ongAnimal'])
    ) {
        // Dados do formulário
        $nome = $_POST['nomeAnimal'];
        $idade = $_POST['idadeAnimal'];
        $detalhe = $_POST['detalheAnimal'];
        $porte = $_POST['porteAnimal'];
        $ong = $_POST['ongAnimal'];

        // Inserir dados na tabela 'animais'
        $sql = "INSERT INTO animais (nomeanimal, idadeanimal, detalheanimal, porteanimal, onganimal) 
                VALUES ('$nome', '$idade', '$detalhe', '$porte', '$ong')";

        if ($conn->query($sql) === TRUE) {
            echo "Animal adicionado com sucesso!";
        } else {
            echo "Erro ao adicionar animal: " . $conn->error;
        }
    } else {
        echo "Todos os campos são obrigatórios.";
    }
} else {
    echo "Requisição não é do tipo POST.";
}

// Fechar conexão
$conn->close();
?>
