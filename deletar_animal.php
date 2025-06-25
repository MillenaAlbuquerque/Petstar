<?php
require_once 'conexao.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$response = array("success" => false, "message" => "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Use o nome correto da coluna de ID
        $sql = "DELETE FROM animais WHERE idanimal = $id";

        if ($conn->query($sql) === TRUE) {
            $response["success"] = true;
            $response["message"] = "Animal deletado com sucesso!";
        } else {
            $response["message"] = "Erro ao deletar animal: " . $conn->error;
        }
    } else {
        $response["message"] = "ID do animal não fornecido.";
    }
} else {
    $response["message"] = "Requisição não é do tipo POST.";
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
echo "debug";  // Adicionando debug aqui
?>
