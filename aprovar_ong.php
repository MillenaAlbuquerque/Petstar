<?php
require_once 'conexao.php'; // Inclui a conexão com o banco de dados

// Variável para controlar a mensagem de status
$message = "";

if (isset($_GET['idong'])) {
    $idong = $_GET['idong'];

    // Atualiza o status para aprovado
    $stmt = $conn->prepare("UPDATE ongs SET status = 'aprovado' WHERE idong = ?");
    
    if (!$stmt) {
        $message = "Erro ao preparar a consulta.";
    } else {
        $stmt->bind_param("i", $idong);

        if ($stmt->execute()) {
            $message = "ONG aprovada com sucesso!";
        } else {
            $message = "Erro ao aprovar a ONG.";
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

    <title>ONG Aprovada!</title>
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
            text-align: center;
            background-color: #fff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.9);

        }
        h1 {
            color: #28a745;
            font-size: 2rem;
        }
/* Estilo para os rótulos (labels) */
h2 {
    font-family: 'Poppins', sans-serif;
    font-weight: 400; /* Peso normal */
    font-size: 1.5rem; /* Tamanho da fonte ajustado */
    color: black; /* Cor do texto */
    margin-top: 2rem; /* Espaçamento inferior */
}
        /* Estilo para o botão "Cadastrar-se" */
.entrar-btn {
    background-color: transparent;
    color: var(--primary-color); 
    border: none;
    font-size: 1.5rem; /* Tamanho menor */
    margin-top: 10px; /* Espaçamento superior para separá-lo dos outros botões */
    cursor: pointer;
    text-decoration: underline; /* Sublinhado para parecer um link */
    font-family: 'Poppins', sans-serif; 
}

.entrar-btn:hover {
    color: var(--secondary-color); /* Mudar a cor no hover */
    text-decoration: none; 
}
    </style>
</head>
<body>
    <div class="message-container">
        <h1><?php echo htmlspecialchars($message); ?></h1>
        <h2><button type="button" class="entrar-btn" id="entrarButton" onclick="window.location.href='login.html'">Entre</button> e comece a cadastrar os pets disponiveis para adoção.</h2>
    </div>
</body>
</html>

