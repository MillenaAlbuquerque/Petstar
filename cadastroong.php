<?php
require 'vendor/autoload.php';
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;

// Conexão com o banco de dados
require 'conexao.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Captura os dados do formulário
$nomeong = $_POST['nomeong'];
$telong = $_POST['telong'];
$cidadeong = $_POST['cidadeong'];
$enderecoong = $_POST['enderecoong'];
$emailong = $_POST['emailong'];
$senhaong = $_POST['senhaong']; // Hasheia a senha

// Insere a ONG no banco de dados
$query = "INSERT INTO ongs (nomeong, telong, cidadeong, enderecoong, emailong, senhaong) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('ssssss', $nomeong, $telong, $cidadeong, $enderecoong, $emailong, $senhaong);
$success = $stmt->execute();

if (!$success) {
    echo json_encode(["error" => "Erro ao inserir no banco: " . $stmt->error]);
    exit();
}

// Captura o idong gerado
$idong = $conn->insert_id;

// URLs para aprovação e rejeição no localhost
$approveUrl = "http://localhost/petstar/aprovar_ong.php?idong=$idong";
$rejectUrl = "http://localhost/petstar/rejeitar_ong.php?idong=$idong";

// Configura a API
$config = Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

// Cria uma instância da API
$apiInstance = new TransactionalEmailsApi(new GuzzleHttp\Client(), $config);

// Cria o conteúdo do e-mail
$htmlContent = "
    <h1>Nova ONG cadastrada!</h1>
    <p><strong>Nome:</strong> $nomeong</p>
    <p><strong>Telefone:</strong> $telong</p>
    <p><strong>Cidade:</strong> $cidadeong</p>
    <p><strong>Endereço:</strong> $enderecoong</p>
    <p><strong>E-mail:</strong> $emailong</p>
    <p>Uma nova ONG se cadastrou no sistema. Verifique as informações e escolha aprovar ou rejeitar o cadastro.</p>
    <a href='$approveUrl' style='padding:8px 20px;background-color:green;color:white;text-decoration:none;border-radius:5px;'>Aprovar ONG</a>
    <a href='$rejectUrl' style='padding:8px 20px;background-color:red;color:white;text-decoration:none;border-radius:5px;'>Rejeitar ONG</a>
";

// Cria o e-mail a ser enviado
$sendSmtpEmail = new SendSmtpEmail([
    'subject' => $nomeong . ' Novo Cadastro de ONG',
    'sender' => ['email' => 'petstarpetstar@outlook.com', 'name' => 'Admin'],
    'to' => [['email' => 'petstarstarpet@gmail.com']],
    'htmlContent' => $htmlContent, // Insere o conteúdo dinâmico do e-mail
]);

try {
    // Envia o e-mail
    $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
    echo json_encode(["success" => true, "message" => "E-mail enviado com sucesso!"]); // Retorna uma mensagem de sucesso para o JavaScript
} catch (Exception $e) {
    echo json_encode(["error" => "Erro ao enviar e-mail: " . $e->getMessage()]); // Retorna uma mensagem de erro com detalhes
}
?>

