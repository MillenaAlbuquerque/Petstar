<?php
session_start();
require_once 'conexao.php';

// Verifica se o usuário está logado e recupera as informações
if (!isset($_SESSION['nome_usuario'])) {
    header('Location: login.html'); // Redireciona para a página de login se não estiver autenticado
    exit();
}

// Obtém o nome do usuário logado para exibição
$nome_usuario = $_SESSION['nome_usuario'];

// Prepara a consulta para selecionar o perfil do usuário
$sql = "SELECT * FROM usuarios WHERE nome = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro na preparação da consulta: " . $conn->error);
}

// Associa o parâmetro (nome) e executa a consulta
$stmt->bind_param("s", $nome_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se encontrou o usuário
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
} else {
    echo "Nenhum usuário encontrado.";
    exit();
}

// Fecha a consulta e a conexão
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <title>Perfil - <?php echo isset($usuario['nome']) ? $usuario['nome'] : 'Usuário'; ?></title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url('https://images.unsplash.com/photo-1450778869180-41d0601e046e?q=80&w=1972&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');

        }

        .perfil-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 700px;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 26px;
        }

        p.intro {
            color: #777;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .perfil-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
            
        }

        .info-card {
            display: flex;
            justify-content: space-between;
            background-color: #90d1ae;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .info-card i {
            text-align: center;
            font-size: 24px;
            color: #FF69B4; /* Cor fofa e suave */
        }

        .info-card span {
            text-align: center;
            font-size: 18px;
            color: #333;
        }

        .info-card .value {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
        }

        .edit-btn {
            padding: 10px 55px;
    background-color: var(--greendark);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
    margin-top: 10px;
        }

        .edit-btn:hover {
            background-color: #90d1ae;
        }

        .alterar-btn{
            padding: 10px 30px;
    background-color: var(--greendark);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
    margin-top: 10px;
        }

        /* Estilos do Modal */
        .modal {
            display: none; /* Escondido por padrão */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Estilos do Formulário */
        .modal input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .modal button {
            padding: 10px 20px;
            background-color: #38a269;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal button:hover {
            background-color: #218838;
        }

        /* Estilos básicos para o pop-up */
#success-popup {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border-radius: 5px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    transition: opacity 0.3s ease, transform 0.3s ease;
}

/* Classe para ocultar o pop-up */
.hidden {
    opacity: 0;
    transform: translateY(-20px);
    pointer-events: none;
}

/* Classe para tornar o pop-up visível */
.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Classe para dar um efeito de 'shake' */
.shake {
    animation: shake 0.3s;
}

@keyframes shake {
    0% { transform: translateX(-10px); }
    25% { transform: translateX(10px); }
    50% { transform: translateX(-10px); }
    75% { transform: translateX(10px); }
    100% { transform: translateX(0); }
}

    </style>
</head>
<body>
    <div class="perfil-container">
        <h1>Bem-vindo(a), <?php echo isset($usuario['nome']) ? $usuario['nome'] : 'Usuário'; ?>!</h1>
        <p class="intro">Aqui estão suas informações de perfil. Você pode editá-las se necessário.</p>

        <div class="perfil-info">
            <div class="info-card">
                <i class="fas fa-user"></i>
                <span>Nome:</span>
                <span class="value"><?php echo isset($usuario['nome']) ? htmlspecialchars($usuario['nome']) : 'N/A'; ?></span>
            </div>

            <div class="info-card">
                <i class="fas fa-envelope"></i>
                <span>Email:</span>
                <span class="value"><?php echo isset($usuario['email']) ? htmlspecialchars($usuario['email']) : 'N/A'; ?></span>
            </div>

            <div class="info-card">
                <i class="fas fa-calendar-alt"></i>
                <span>Data de Nascimento:</span>
                <span class="value"><?php echo isset($usuario['datanasc']) ? htmlspecialchars($usuario['datanasc']) : 'N/A'; ?></span>
            </div>

            <div class="info-card">
                <i class="fas fa-phone"></i>
                <span>Telefone:</span>
                <span class="value"><?php echo isset($usuario['fone']) ? htmlspecialchars($usuario['fone']) : 'N/A'; ?></span>
            </div>

            <div class="info-card">
                <i class="fas fa-map-marker-alt"></i>
                <span>Cidade:</span>
                <span class="value"><?php echo isset($usuario['cidade']) ? htmlspecialchars($usuario['cidade']) : 'N/A'; ?></span>
            </div>

            <div class="info-card">
                <i class="fas fa-home"></i>
                <span>Endereço:</span>
                <span class="value"><?php echo isset($usuario['endereco']) ? htmlspecialchars($usuario['endereco']) : 'N/A'; ?></span>
            </div>
        </div>

        <button class="alterar-btn" id="AlterarSenhaBtn">Alterar senha</button>
        <button class="edit-btn" id="openModalBtn">Editar Perfil</button>
    </div>

    <!-- Modal de Edição -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Editar Perfil</h2>
                <span class="close" id="closeModalBtn">&times;</span>
            </div>
            <form id="editForm">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo isset($usuario['nome']) ? htmlspecialchars($usuario['nome']) : ''; ?>">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo isset($usuario['email']) ? htmlspecialchars($usuario['email']) : ''; ?>">

                <label for="datanasc">Data de Nascimento:</label>
                <input type="date" id="datanasc" name="datanasc" value="<?php echo isset($usuario['datanasc']) ? htmlspecialchars($usuario['datanasc']) : ''; ?>">

                <label for="fone">Telefone:</label>
                <input type="text" id="fone" name="fone" value="<?php echo isset($usuario['fone']) ? htmlspecialchars($usuario['fone']) : ''; ?>">

                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" value="<?php echo isset($usuario['cidade']) ? htmlspecialchars($usuario['cidade']) : ''; ?>">

                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" value="<?php echo isset($usuario['endereco']) ? htmlspecialchars($usuario['endereco']) : ''; ?>">

                <button type="submit">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <div id="success-popup" class="hidden">Perfil atualizado com sucesso!</div>

    <!-- FontAwesome para ícones -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
    <script>
        // Funções do Modal
        var modal = document.getElementById("editModal");
        var btn = document.getElementById("openModalBtn");
        var span = document.getElementById("closeModalBtn");

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Envio do formulário via AJAX
        document.getElementById("editForm").onsubmit = function(event) {
            event.preventDefault();
            var formData = {
                nome: document.getElementById("nome").value,
                email: document.getElementById("email").value,
                datanasc: document.getElementById("datanasc").value,
                fone: document.getElementById("fone").value,
                cidade: document.getElementById("cidade").value,
                endereco: document.getElementById("endereco").value
            };

            fetch('editarperfil.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    showSuccessPopup();
                    location.reload(); // Atualiza a página para refletir as mudanças
                }
            })
            .catch((error) => {
                console.error('Erro:', error);
            });
        }

        // Função para mostrar o popup de sucesso
        function showSuccessPopup() {
            const popup = document.getElementById('success-popup');
            popup.classList.remove('hidden');
            popup.classList.add('visible', 'shake'); // Adiciona a classe shake

            // Oculta o pop-up após 3 segundos
            setTimeout(() => {
                popup.classList.remove('visible', 'shake'); // Remove a classe shake
                popup.classList.add('hidden');
            }, 3000);
        }
    </script>
</body>

</body>
</html>
