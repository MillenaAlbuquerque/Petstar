<?php
require_once 'conexao.php'; // Inclui a conexão com o banco de dados

// Variável para mensagem de status
$message = "";

if (isset($_GET['idong'])) {
    $idong = $_GET['idong'];

    // Atualiza o status para rejeitado
    $stmt = $conn->prepare("UPDATE ongs SET status = 'rejeitado' WHERE idong = ?");
    
    if (!$stmt) {
        $message = "Erro ao preparar a consulta.";
    } else {
        $stmt->bind_param("i", $idong);

        if ($stmt->execute()) {
            $message = "ONG rejeitada.";
        } else {
            $message = "Erro ao rejeitar a ONG.";
        }

        $stmt->close();
    }
} else {
    $message = "ID da ONG não especificado.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">

    <title>ONG Rejeitada!</title>
    <style>
        :root {
            --primary-color: #28a745; /* Cor primária */
            --secondary-color: #218838; /* Cor secundária */
            --background-color: #f0f0f0; /* Cor de fundo */
            --text-color: #333; /* Cor do texto */
            --input-border-color: #ccc; /* Cor da borda dos inputs */
            --button-hover-color: #218838; /* Cor do botão ao passar o mouse */
        }
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('https://images.unsplash.com/photo-1415369629372-26f2fe60c467?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjJ8fGFkb3B0aW9uJTIwYW5pbWFsfGVufDB8fDB8fHww');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .message-container {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: ;
            font-size: 2rem;
        }
        h2 {
            font-size: 1.5rem;
            margin-top: 20px;
        }
        .entrar-btn {
            font-family: 'Poppins', sans-serif;
            background-color: #dc3545;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }
        .entrar-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h1><?php echo htmlspecialchars($message); ?></h1>
        <h2><button type="button" class="entrar-btn" id="entrarButton" onclick="window.location.href='cadastroong.html'">Voltar ao Cadastro</button></h2>
        <h2>Infelizmente sua ONG não se encontra nos nossos padrões, para saber mais entre em contato conosco!</h2> 
    </div>
</body>
</html>
