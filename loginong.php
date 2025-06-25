<?php
session_start();

// Configurações de conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'petstar';

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $database);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Define o tipo de conteúdo da resposta como JSON
header('Content-Type: application/json');

$response = array("success" => false, "message" => "");

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos de email e senha foram preenchidos
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Verifica o e-mail e se a ONG está aprovada
        $sql = "SELECT * FROM ongs WHERE emailong = ? AND status = 'aprovado'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se a ONG foi encontrada
        if ($result->num_rows > 0) {
            $ong = $result->fetch_assoc();

            // Verifica a senha
            if ($senha === $ong['senhaong']) {  
                // Armazena informações na sessão
                $_SESSION['idong'] = $ong['idong']; // ID da ONG logada
                $_SESSION['nomeong'] = $ong['nomeong'];
                $_SESSION['cidadeong'] = $ong['cidadeong'];
                $_SESSION['emailong'] = $ong['emailong'];
                $_SESSION['telong'] = $ong['telong'];
                $_SESSION['enderecoong'] = $ong['enderecoong'];
                
                // Resposta de sucesso
                $response["success"] = true;
                $response["message"] = "Login bem-sucedido.";
            } else {
                $response["message"] = "E-mail ou senha incorretos.";
            }
        } else {
            $response["message"] = "E-mail ou senha incorretos ou ONG não aprovada.";
        }
    } else {
        $response["message"] = "Todos os campos são obrigatórios.";
    }
} else {
    $response["message"] = "Requisição não é do tipo POST.";
}

// Fecha a conexão com o banco de dados
$conn->close();

// Envia a resposta JSON
echo json_encode($response);
?>
