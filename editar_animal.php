<?php
require_once 'conexao.php';
// Exiba erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifique se o ID foi passado
if (!isset($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID do animal não fornecido.']);
    exit();
}

$idAnimal = $_POST['id'];
$updates = [];


if (isset($_POST['editNomeAnimal'])) {
    $updates[] = "nomeanimal = '{$_POST['editNomeAnimal']}'";
}
if (isset($_POST['editIdadeAnimal'])) {
    $updates[] = "idadeanimal = '{$_POST['editIdadeAnimal']}'";
}
if (isset($_POST['editDetalheAnimal'])) {
    $updates[] = "detalheanimal = '{$_POST['editDetalheAnimal']}'";
}
if (isset($_POST['editPorteAnimal'])) {
    $updates[] = "porteanimal = '{$_POST['editPorteAnimal']}'";
}
if (isset($_POST['editOngAnimal'])) {
    $updates[] = "onganimal = '{$_POST['editOngAnimal']}'";
}
if (isset($_POST['editRacaAnimal'])) {
    $updates[] = "racaanimal = '{$_POST['editRacaAnimal']}'";
}
if (isset($_POST['editGeneroAnimal'])) {
    $updates[] = "generoanimal = '{$_POST['editGeneroAnimal']}'";
}

if (!empty($updates)) {
    $sql = "UPDATE animais SET " . implode(', ', $updates) . " WHERE idanimal = $idAnimal";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar animal.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Nenhum dado alterado.']);
}

$conn->close();
?>
