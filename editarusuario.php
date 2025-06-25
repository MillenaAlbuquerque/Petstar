<?php
session_start();
require_once 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['email_usuario'])) {
    header('Location: login.php'); // Redireciona para a página de login se não estiver autenticado
    exit();
}

// Obtém o e-mail do usuário logado
$email_usuario = $_SESSION['email_usuario'];

// Prepara a consulta para selecionar o perfil do usuário
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro na preparação da consulta: " . $conn->error);
}

// Associa o parâmetro (e-mail) e executa a consulta
$stmt->bind_param("s", $email_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se encontrou o usuário
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
} else {
    echo "Nenhum usuário encontrado.";
}

// Fecha a consulta
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil do Usuário</title>
</head>
<body>

<h1>Editar Perfil de <?php echo htmlspecialchars($usuario['nome']); ?></h1>

<form id="editar-form">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required><br><br>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required readonly><br><br>

    <label for="datanasc">Data de Nascimento:</label>
    <input type="date" id="datanasc" name="datanasc" value="<?php echo htmlspecialchars($usuario['datanasc']); ?>" required><br><br>

    <label for="fone">Telefone:</label>
    <input type="text" id="fone" name="fone" value="<?php echo htmlspecialchars($usuario['fone']); ?>" required><br><br>

    <label for="cidade">Cidade:</label>
    <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($usuario['cidade']); ?>" required><br><br>

    <label for="endereco">Endereço:</label>
    <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($usuario['endereco']); ?>" required><br><br>

    <button type="button" onclick="atualizarPerfil()">Salvar</button>
</form>

<script>
async function atualizarPerfil() {
    const nome = document.getElementById('nome').value;
    const datanasc = document.getElementById('datanasc').value;
    const fone = document.getElementById('fone').value;
    const cidade = document.getElementById('cidade').value;
    const endereco = document.getElementById('endereco').value;

    const data = {
        nome: nome,
        datanasc: datanasc,
        fone: fone,
        cidade: cidade,
        endereco: endereco
    };

    try {
        const response = await fetch('atualizarusuario.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        alert(result.message);
        if (result.success) {
           
            location.reload();
        }
    } catch (error) {
        console.error('Erro:', error);
    }
}
</script>

</body>
</html>
