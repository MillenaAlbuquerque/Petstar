<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit;
}

$idUsuario = $_SESSION['id_usuario'];
$nomeUsuario = $_SESSION['nome_usuario'];
header('Content-Type: application/json');

// Configurações de conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'petstar';

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se a requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário com verificação de presença e valores válidos
    $qcasa = $_POST['residence'] ?? '';
    $qanimais = $_POST['otherAnimals'] ?? '';
    $qpessoas = $_POST['peopleCount'] ?? '';
    
    // Validação e tratamento de $qsuporte
    $qsuporte = $_POST['support'] ?? '';
    if ($qsuporte === '' || !is_numeric($qsuporte)) {
        // Define um valor padrão ou um erro para casos onde o valor não é válido
        $qsuporte = 1; // Ajuste para o valor padrão desejado ou use outra lógica
    } else {
        // Cast para garantir que seja um número inteiro, se esperado
        $qsuporte = (int)$qsuporte;
    }

    if (isset($_POST['idanimal'])) {
        $animal = $_POST['idanimal'];
        // Verificar se o ID do animal existe na tabela 'animais'
        $animalCheck = $conn->prepare("SELECT * FROM animais WHERE idanimal = ?");
        $animalCheck->bind_param("i", $animal);
        $animalCheck->execute();
        $animalResult = $animalCheck->get_result();
    
        if ($animalResult->num_rows === 0) {
            echo json_encode(["success" => false, "message" => "ID do animal não existe."]);
            exit();
        }
    }

    // Inserir ou atualizar no banco de dados conforme a lógica existente
    $sql = "INSERT INTO solicitacoes (residence, otherAnimals, peopleCount, support) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $qcasa, $qanimais, $qpessoas, $qsuporte);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Solicitação registrada com sucesso."]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao registrar a solicitação."]);
    }
}
$conn->close();
?>
