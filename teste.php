<?php
// Hash direto do banco de dados
$hash_no_banco = $2y$10$B9OkWxCHtZHF/8kcq5ygT.GNL1HYsppGnm5xCtIEx.K;

// Senha digitada para teste
$senha_digitada = a;

if (password_verify($senha_digitada, $hash_no_banco)) {
    echo "A senha corresponde ao hash!";
} else {
    echo "A senha não corresponde ao hash.";
}
?>
