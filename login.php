<?php
header('Content-Type: application/json');

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "petstar";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Erro de conexão: ' . $conn->connect_error]);
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
    $senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : '';

    if (!empty($email) && !empty($senha)) {
        // Preparar e executar a consulta
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifique se o usuário foi encontrado
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Comparar a senha

            if ($user['senha'] == $senha) { // Verifica se a senha é igual
                session_start();
                $_SESSION['nome_usuario'] = $user['nome'];
                $_SESSION['id_usuario'] = $user['id']; // Salva o nome do usuário na sessão
                echo json_encode(['success' => true, 'message' => 'Login bem-sucedido!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Senha incorreta.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuário não encontrado.']);
        }


        // Fechar a conexão
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Campos de email e senha são obrigatórios."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método de requisição inválido."]);
}

$conn->close();
?>
