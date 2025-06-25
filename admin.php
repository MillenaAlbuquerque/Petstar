<?php 
session_start(); // Inicia a sessão

require_once 'conexao.php';

$response = array("success" => false, "message" => "");

// Verifica se a ONG está logada
if (!isset($_SESSION['idong'])) {
    $response["message"] = "Você precisa estar logado para acessar esta página.";
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

$idong = $_SESSION['idong']; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomeAnimal'], $_POST['idadeAnimal'], $_POST['detalheAnimal'], $_POST['porteAnimal'], $_POST['racaAnimal'], $_POST['generoAnimal'])) {
        $nomeAnimal = $_POST['nomeAnimal'];
        $idadeAnimal = $_POST['idadeAnimal'];
        $detalheAnimal = $_POST['detalheAnimal'];
        $porteAnimal = $_POST['porteAnimal'];
        $racaAnimal = $_POST['racaAnimal'];
        $generoAnimal = $_POST['generoAnimal'];

        // Verificar se os arquivos de imagem foram enviados
        if (isset($_FILES['imagemAnimal']) && !empty($_FILES['imagemAnimal']['name'][0])) {
            $uploadDir = 'images/'; 
            $nomesImagens = [];

            foreach ($_FILES['imagemAnimal']['name'] as $key => $imagemNome) {
                $imagemTempPath = $_FILES['imagemAnimal']['tmp_name'][$key];
                $imagemType = $_FILES['imagemAnimal']['type'][$key];
                $imagemSize = $_FILES['imagemAnimal']['size'][$key];
                $imagemPath = $uploadDir . basename($imagemNome);

              
                if (move_uploaded_file($imagemTempPath, $imagemPath)) {
                    $nomesImagens[] = $imagemPath; // Armazena o caminho da imagem
                } else {
                    $response["message"] = "Falha ao mover o arquivo de imagem '{$imagemNome}' para o diretório 'images'.";
                    break; 
                }
            }

            if (count($nomesImagens) > 0) {
                foreach ($nomesImagens as $imagemPath) {
                    // Prepare a query para inserir dados do animal com imagem, usando o ID da ONG logada
                    $sql = "INSERT INTO animais (nomeanimal, idadeanimal, detalheanimal, porteanimal, onganimal, racaanimal, generoanimal, imagemanimal) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssssss", $nomeAnimal, $idadeAnimal, $detalheAnimal, $porteAnimal, $idong, $racaAnimal, $generoAnimal, $imagemPath);

                    if (!$stmt->execute()) {
                        $response["message"] = "Erro ao adicionar animal: " . $stmt->error;
                    } else {
                        $response["success"] = true;
                        $response["message"] = "Animal adicionado com sucesso!";
                    }
                }
            } else {
                $response["message"] = "Nenhuma imagem foi carregada com sucesso.";
            }
        } else {
            $response["message"] = "Erro no envio da imagem do animal.";
        }
    } else {
        $response["message"] = "Dados incompletos para adicionar animal.";
    }
} else {
    $response["message"] = "Requisição não é do tipo POST.";
}

// Consulta para exibir os animais cadastrados pela ONG logada
$sql = "SELECT * FROM animais WHERE onganimal = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idong);
$stmt->execute();
$result = $stmt->get_result();

$animais = array();
while ($animal = $result->fetch_assoc()) {
    $animais[] = $animal;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode(array("response" => $response, "animais" => $animais)); // Retorna a resposta e os animais

?>


