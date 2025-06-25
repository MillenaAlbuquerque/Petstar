<?php
session_start(); // Deve ser a primeira linha do arquivo

// Verifica se o usuário está logado e define o nome do usuário
$nomeUsuario = isset($_SESSION['nome_usuario']) ? $_SESSION['nome_usuario'] : 'Usuário não logado';

if ($nomeUsuario === 'Usuário não logado') {
    echo "Você precisa fazer login para acessar esta página.";
    exit(); // Encerra o script caso o usuário não esteja logado
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- jQuery (obrigatório para o Slick Carousel) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- CSS do Slick Carousel (escolha um dos estilos) -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"/>

    <!-- JavaScript do Slick Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>PetStar</title>

    <style>
            .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block; /* Exibe o dropdown ao passar o mouse */
    }

    /* Estilos para a seta */
    .dropbtn {
        display: flex;
        align-items: center; /* Alinha o texto e a seta */
    }

    .bx {
        margin-left: 5px; /* Espaço entre o nome do usuário e a seta */
    }

    /* Container principal que envolve tudo */
.animais-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    padding: 0; /* Remova ou reduza o padding */
    margin: 0; /* Remova ou reduza margens */
}

/* Ajuste para a seção layout */
.layout-container {
    display: flex;
    align-items: flex-start;
    gap: 10px; /* Diminua o espaço entre os filtros e os cards */
    width: 100%;
    padding-left: 10px; /* Ajuste opcional para um leve recuo */
}

/* Estilo geral do container de filtros */
#filterContainer {
    display: flex; /* Utiliza flexbox para organização */
    flex-direction: column; /* Coloca os elementos em coluna */
    gap: 10px; /* Espaçamento entre os elementos */
    margin-left: 30px;
    margin-top: 5px;
    max-width: 250px; /* Aumente ou diminua conforme necessário */
    width: 100%; /* Permite que o filtro ocupe 100% da largura do container pai */
}


/* Estilo para os inputs de texto e selects */
#filterContainer input[type="text"],
#filterContainer select {
    width: 100%; /* Ocupa toda a largura do container */
    padding: 10px; /* Espacamento interno */
    border: 1px solid var(--greendark); /* Borda */
    border-radius: 8px; /* Bordas arredondadas */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Sombra suave */
    font-size: 0.8rem; /* Tamanho da fonte */
    transition: border-color 0.3s, box-shadow 0.3s; /* Transição suave para efeitos */
}

.animais-title{
    text-align: center;
    margin-top: 1rem;
    font-size: 2rem;
    color: var(--dark);
    margin-bottom: 1rem;  
}

.descricao {
    color: gray;
    font-size: 19px;
    margin: 10px 0;
    margin-bottom: 4rem;
    margin-top: 1rem;
    text-align: center;
}

/* Lista de animais */
#animal-list {
    display: flex; /* Mude para flex */
    flex-wrap: wrap; /* Permite que os cards quebrem para a próxima linha */
    gap: 80px; /* Espaçamento entre os cards */
    width: 100%;
    justify-content: center; /* Centraliza os cards horizontalmente */
}

/* Estilo dos cards de animais */
.animal {
    border: 1px solid var(--greendark);
    box-sizing: border-box;
    border-radius: 10px;
    padding: 15px;
    background-color: #fff;
    text-align: center;
    transition: transform 0.3s ease;
    overflow: hidden;
    width: 240px; /* Largura fixa */
    margin: 0; /* Remover margens */

}

.animal:hover {
    transform: translateY(-5px); /* Eleva o card ao passar o mouse */
}

/* Estilo para a imagem dos animais */
.animal img {
    width: 100%;
    height: 205px;
    object-fit: cover; /* Preenche o card com a imagem */
    border-radius: 5px;
}

/* Estilo para o nome dos animais */
.animal-name {
    font-size: 1.3rem;
    color: #333;
    font-weight: bold;
    margin: 10px 0;
}

/* Estilo para as descrições */
.animal p {
    margin: 5px 0;
    color: #555;
}

/* Botão "Ver Detalhes" nos cards */
.animal button {
    padding: 10px 55px;
    background-color: var(--greendark);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
    margin-top: 10px;
}

.animal button:hover {
    background-color: var(--green);
}


.detalhes-btn{
    padding: 10px 20px;
    background-color: var(--greendark);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
    margin-top: 10px;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.doacao-modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
}

.doacao-modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}


/* Botão Fechar */
.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 1.5rem;
    color: black;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

 
.doacao-modal {
    display: none;
    position: fixed;
    z-index: 2000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100vh;
    background-color: rgba(144, 209, 174, 0.4); /* Fundo verde claro translúcido */
    align-items: center; /* Centraliza verticalmente */
    justify-content: center; /* Centraliza horizontalmente */
    overflow: hidden; /* Remove o scroll extra */
}
/* Conteúdo da modal */
.doacao-modal-content {
    background-color: #fff;
    padding: 30px;
    border-radius: 20px; /* Bordas mais arredondadas para suavidade */
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1); /* Sombra mais leve */
    max-width: 90%; /* Largura máxima ajustada para se adaptar à tabela */
    width: auto; /* A modal será dimensionada de acordo com o conteúdo da tabela */

    animation: modalFadeIn 0.5s ease-in-out;
    font-family: 'Comic Sans MS', sans-serif; /* Fonte mais amigável e fofa */
    text-align: center;
    max-height: 90%; /* Para garantir que a modal não ultrapasse a altura da tela */
    overflow-y: auto; /* Rolagem vertical se o conteúdo for muito grande */
}

/* Animação suave para o modal */
@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Título da modal */
.doacao-modal-content h2 {
    font-size: 26px;
    color: #38a269; /* Rosa forte e alegre */
    margin-bottom: 20px;
    font-family: 'Poppins', sans-serif; /* Estilo fofo e moderno */
}

/* Botão de fechar */
.doacao-close {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 24px;
    color: #38a269; /* Rosa claro */
    cursor: pointer;
    transition: color 0.3s ease;
}

.doacao-close:hover {
    color:  #90d1ae; /* Rosa mais forte ao passar o mouse */
}

/* Estilizando a tabela de forma fofa */
.doacao-modal-content table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 16px;
}

.doacao-modal-content th, .doacao-modal-content td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #90d1ae; /* Linha separadora rosa claro */
}

.doacao-modal-content th {
    background-color: #fff; /* Fundo rosa muito claro */
    color: ; /* Texto em rosa vibrante */
    text-transform: uppercase;
}

.doacao-modal-content td {
    color: black;
}

/* Efeito fofo ao passar o mouse nas linhas da tabela */
.doacao-modal-content tr:hover {
    background-color: #90d1ae; /* Cor suave */
}

/* Botão de ação dentro da modal */
.doacao-modal-content .doacao-btn {
    display: inline-block;
    padding: 12px 25px;
    background-color: #90d1ae; /* Rosa forte */
    color: white;
    border: none;
    border-radius: 25px; /* Bordas redondas */
    cursor: pointer;
    font-size: 16px;
    margin-top: 20px;
    transition: background-color 0.3s ease;
}

.doacao-modal-content .doacao-btn:hover {
    background-color: #38a269; /* Rosa mais forte ao passar o mouse */
}

/* Responsivo: ajusta o tamanho da modal em telas menores */
@media (max-width: 600px) {
    .doacao-modal-content {
        width: 95%;
    }

    .doacao-modal-content h2 {
        font-size: 22px;
    }

    .doacao-modal-content th, .doacao-modal-content td {
        font-size: 14px;
    }

    .doacao-close {
        font-size: 22px;
    }
}

:root {
    --greendark: #38a269;
    --green: #90d1ae;
    --button-hover-color: #218838;
    --text-color: #333;
}

/* Modal */
.forms-modal {
    //display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 20px;
}

.forms-modal-content {
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 500px;
    text-align: center;
    font-family: 'Poppins', sans-serif;
}



h2{
    color: #38a269
}

/* Botão Fechar */
.close {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 1.5rem;
    color: #888;
    cursor: pointer;
}

/* Formulário */
.form-group {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px;
}

label {
    font-weight: 400;
    font-size: 1rem;
    color: var(--text-color);
    margin-bottom: 8px;
}

select, input[type="text"] {
    width: 80%;
    padding: 10px;
    font-family: 'Poppins', sans-serif;
    border: 1px solid var(--greendark);
    border-radius: 8px;
    font-size: 0.9rem;
    transition: border-color 0.3s, box-shadow 0.3s;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

select:focus, input[type="text"]:focus {
    border-color: var(--green);
    box-shadow: 0 0 5px rgba(0, 255, 0, 0.5);
    outline: none;
}

/* Botão de Doação */
.button-container {
    display: flex;
    justify-content: center;
}

button {
    background-color: var(--greendark);
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 500;
    transition: background-color 0.3s, box-shadow 0.3s;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

button:hover {
    background-color: var(--button-hover-color);
}
    
</style>
</head>
<body>

<header>
    <
    <nav class="navigation">
    <a href="#" class="logo">
        <img class="img-logo" src="images/logoideas.png" alt="PetStar Logo">
        <h3>PetStar</h3>
    </a>
    <ul class="nav-menu">
        <li class="nav-item"><a href="painelong.php">Início</a></li>
        <li class="nav-item"><a href="#">Sobre</a></li>

        <!-- Dropdown de Solicitações -->
        <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="dropbtn" id="solicitacoesDropdown">Solicitações <i class="bx bxs-chevron-down"></i></a> <!-- Adiciona a seta -->
            <div class="dropdown-content" id="solicitacoesDropdownContent">
                <a onclick="openSolicitacoesModal()">Solicitações de Adoção</a>
                <a id="verDoacoesBtn">Solicitações de Doação</a>
            </div>
        </li>

        <?php 
        if (isset($_SESSION['nome_usuario'])) { // Verifica se o usuário está logado
            $nomeUsuario = $_SESSION['nome_usuario']; // Armazena o nome do usuário
        ?>
            <li class="nav-item dropdown">
                <a href="#" class="dropbtn" id="adminBtn"><?php echo $nomeUsuario; ?> <i class="bx bxs-chevron-down"></i></a> <!-- Adiciona a seta -->
                <div class="dropdown-content" id="adminDropdown">
                    <a href="perfilusuario.php">Meu Perfil</a>
                    <a href="logout.php">Encerrar Sessão</a>
                </div>
            </li>
        <?php
        } else {
        ?>
            <li class="nav-item"><a href="login.php">Login</a></li>
        <?php
        }
        ?>
    </ul>
    <div class="menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
</nav>

</header>



<main>
    <!--Home-->
    <section class="home">
        <div class="home-text">
            <br>
            <h4 class="text-h4">Dê um Lar, receba Amor!</h4>
            <h1 class="text-h1">Explore nossos perfis de adoção e encontre seu novo melhor amigo.</h1>
            <p>Nós estamos aqui para conectar corações e lares com animais incríveis       que
            estão esperando por uma nova chance de felicidade. Nossas ONGs parceiras
            resgatam e cuidam de animais que precisam de um lar amoroso. Adote um amigo
            peludo e transforme sua vida e a deles para sempre!
            </p>
            <a class="home-btn" href="animais.html">Conheça os Animais!</a>
            <a class="home-btn" onclick="abrirFormularioDoacao()">Fazer uma Doação</a>
            <!-- Botão para abrir o modal -->



        </div>
        <div class="home-img">
            <img src="images\raiva-em-caes-e-gatos-1.webp" alt="gatinho silly">
        </div>
    </section>
    
    <!--Sobre Nós-->
    <section class="sobre-nos">
        <div class="sobre-info">
            <h1 class="sobre">Nossa Missão</h1>
            <p>Através da nossa plataforma, buscamos reduzir as dificuldades enfrentadas por ONGs e abrigos, oferecendo um meio eficiente para divulgar animais disponíveis para adoção e facilitar a doação de mantimentos. A Petstar também promove educação sobre adoção responsável e a importância de dar uma nova chance a pets que esperam por um lar.</p>
        </div>
    </section>

    <section id="animais" class="animais">
    <h2 class="animais-title">Adote!</h2>

    <h3 class="descricao">Conheça os animais disponíveis.</h3>
                <div class="layout-container">
                    <!-- Filtros -->
                    <div id="filterContainer">
                        <input type="text" id="searchName" placeholder="Pesquisar por nome...">
                        <select id="filterPorte">
                            <option value="">Todos os Portes</option>
                            <option value="Pequeno">Pequeno</option>
                            <option value="Médio">Médio</option>
                            <option value="Grande">Grande</option>
                        </select>
                        <select id="filterGenero">
                            <option value="">Todos os Gêneros</option>
                            <option value="Macho">Macho</option>
                            <option value="Fêmea">Fêmea</option>
                        </select>
                        <button class="detalhes-btn" id="applyFiltersBtn">Aplicar Filtros</button>
                    </div>
        
                    <!-- Lista de animais -->
                    <div id="animal-list">
                    </div>
                </div>
        </section>

        <div id="solicitacoesModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeSolicitacoesModal()">&times;</span>
        <h2>Minhas Solicitações</h2>
        <table id="solicitacoesTable">
            <thead>
                <tr>
                    <th>Solicitação</th>
                    <th>Animal</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="solicitacoesTableBody">
                <!-- Dados das solicitações serão inseridos aqui -->
            </tbody>
        </table>
    </div>
</div>

<div id="detalhesModal" class="modal" onclick="fecharModalExternoo(event)">
    <div class="modal-content">
        <span class="close" >&times;</span>
        <h2>Detalhes da Solicitação</h2>
        <p><strong>Onde mora:</strong> <span id="detalhesCasa"></span></p>
        <p><strong>Possui animais:</strong> <span id="detalhesAnimais"></span></p>
        <p><strong>Reside com quantas pessoas:</strong> <span id="detalhesPessoas"></span></p>
        <p><strong>Interesse em suporte:</strong> <span id="detalhesSuporte"></span></p>
    </div>
</div>


<!-- Modal de Doação -->
<div id="doacaoModal" class="modal-doacao" onclick="fecharModalExterno(event)">
    <div class="modal-doacao-content">
        <!-- Botão de Fechar -->
        <span class="modal-doacao-close" onclick="fecharDoacaoModal()">&times;</span>
        
        <h2>Fazer uma Doação</h2>
        <form id="formDoacao" action="processar_doacao.php" method="POST">
            <div class="modal-doacao-form-group">
                <label for="ong">Selecione a ONG:</label>
                <select id="ong" name="ong" required>
                    <?php
                    require_once 'conexao.php';
                    $conn->set_charset("utf8mb4");

                    $sql = "SELECT idong, nomeong FROM ongs";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row['idong'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['nomeong'], ENT_QUOTES, 'UTF-8') . "</option>";
                        }
                    } else {
                        echo "<option value=''>Nenhuma ONG disponível</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="modal-doacao-form-group">
                <label for="tipoDoacao">Tipo de Doação:</label>
                <select id="tipoDoacao" name="tipoDoacao" required>
                    <option value="Ração">Ração</option>
                    <option value="Voluntariado">Voluntariado</option>
                    <option value="Produtos de limpeza">Produtos de Limpeza</option>
                    <option value="Remédios">Remédios</option>
                    <option value="outros">Outros</option>
                </select>
            </div>
            <div class="modal-doacao-form-group">
                <label for="quantidade">Quantidade:</label>
                <input type="text" id="quantidade" name="quantidade" required>
            </div>
            <div class="modal-doacao-button-container">
                <button type="submit">Doar</button>
            </div>
        </form>
    </div>
</div>


<!-- Modal de EXIBIR Doações -->
<div id="doacoesModal" class="doacao-modal">
    <div class="doacao-modal-content">
        <span class="doacao-close" onclick="fecharDoacoesModal()">&times;</span>
        <h2>Minhas Doações</h2>
        <table id="doacoesTable">
            <thead>
                <tr>
                    <th>Tipo de Doação</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody id="doacoesTableBody">
                <!-- As doações serão carregadas aqui via JavaScript -->
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

     // Função para abrir a modal
     function abrirDoacaoModal() {
        document.getElementById("doacaoModal").style.display = "flex";
    }

 // Função para abrir o modal de doação
 function abrirFormularioDoacao() {
        var modal = document.getElementById('doacaoModal');
        modal.style.display = "block";
    }

    // Função para fechar o modal de doação
    function fecharDoacaoModal() {
        var modal = document.getElementById('doacaoModal');
        modal.style.display = "none";
    }

    // Fechar o modal ao clicar fora dele
    window.onclick = function(event) {
        var modal = document.getElementById('doacaoModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

// Função para abrir o modal
document.getElementById('verDoacoesBtn').addEventListener('click', function() {
    var modal = document.getElementById('doacoesModal');
    modal.style.display = "flex";

    // Fazer a requisição AJAX para buscar as doações
    fetch('get_doacoes.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Limpar a tabela antes de adicionar novas doações
                var tbody = document.getElementById('doacoesTableBody');
                tbody.innerHTML = '';

                // Preencher a tabela com as doações
                data.doacoes.forEach(function(doacao) {
                    var row = tbody.insertRow();

                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);

                    cell1.innerHTML = doacao.tipodoacao;
                    cell2.innerHTML = doacao.quantdoacao;
                    cell3.innerHTML = doacao.datadoacao;
                });
            } else {
                alert('Erro ao carregar as doações: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erro ao buscar doações:', error);
        });
});

// Função para fechar o modal
function fecharDoacoesModal() {
    document.getElementById('doacoesModal').style.display = "none";
}

// Fechar o modal ao clicar fora dele
window.onclick = function(event) {
    var modal = document.getElementById('doacoesModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}



document.getElementById('formDoacao').addEventListener('submit', function(e) {
    e.preventDefault(); // Impede o envio tradicional do formulário

    // Pegar os dados do formulário
    var formData = new FormData(this);

    // Enviar os dados via AJAX
    fetch('processar_doacao.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Exibir o popup de sucesso
            Swal.fire({
    title: 'Sucesso!',
    text: data.message,
    icon: 'success',
    confirmButtonText: 'OK'
});
 // Aqui você pode personalizar com uma modal ou outro estilo
        } else {
            // Exibir uma mensagem de erro
            Swal.fire({
    title: 'Erro!',
    text: data.message,
    icon: 'error',
    confirmButtonText: 'OK'
});
        }
    })
    .catch(error => {
        alert('Ocorreu um erro ao processar sua doação. Tente novamente.');
        console.error('Erro:', error);
    });
});



// Alternativa com JavaScript para exibir o dropdown (se não quiser usar hover do CSS)
document.getElementById('adminBtn').addEventListener('click', function(event) {
    event.preventDefault();  // Evita o redirecionamento padrão

    var dropdown = document.getElementById('adminDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
});

// Fecha o dropdown se clicar fora
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === 'block') {
                openDropdown.style.display = 'none';
            }
        }
    }
};

document.addEventListener("DOMContentLoaded", function() {
                    const animalList = document.getElementById("animal-list");
            
                    // Função para carregar e exibir os animais
                    function fetchAnimals() {
                        console.log('fetchAnimals chamado');
                        $.ajax({
                            url: 'carregar_animais.php',
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                console.log('Dados recebidos:', data);
                                if (data.animais && data.animais.length > 0) {
                                    displayAnimals(data.animais);
                                } else {
                                    animalList.innerHTML = "<p>Nenhum animal cadastrado.</p>";
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Erro ao carregar animais:', xhr.responseText);
                                animalList.innerHTML = "<p>Erro ao carregar animais.</p>";
                            }
                        });
                    }
                    function displayAnimals(animals) {
                        animalList.innerHTML = ""; // Limpar a lista antes de preenchê-la novamente
                
                        animals.forEach(animal => {
                            const animalCard = document.createElement("div");
                            animalCard.classList.add("animal");
                
                            const image = document.createElement("img");
                            image.src = animal.imagemanimal;
                            image.alt = animal.nomeanimal;
                
                            const namePara = document.createElement("p");
                            namePara.textContent = animal.nomeanimal;
                            namePara.classList.add("animal-name");
                
                            const agePara = document.createElement("p");
                            agePara.textContent = `Idade: ${animal.idadeanimal} anos`;
                
                            const genderPara = document.createElement("p");
                            genderPara.textContent = `Gênero: ${animal.generoanimal}`;
                
                            const ongPara = document.createElement("p");
                            ongPara.textContent = `ONG: ${animal.onganimal}`;
                
                            const detailsButton = document.createElement("button");
                            detailsButton.textContent = "Ver detalhes";
                      
                            console.log('Criando botão com ID:', animal.idanimal);
                            console.log('Botão detalhes criado:', detailsButton);

                            detailsButton.addEventListener('click', function() {
                            const animalId = animal.idanimal;  // Captura o id do animal
                            console.log(`Redirecionando para: detalhes.php?id=${animalId}`);
                            

                            window.location.href = `detalhes.php?id=${encodeURIComponent(animalId)}`;  // Redireciona com o ID
                
                        });
                            
                
                            animalCard.appendChild(image);
                            animalCard.appendChild(namePara);
                            animalCard.appendChild(agePara);
                            animalCard.appendChild(genderPara);
                            animalCard.appendChild(ongPara);
                            animalCard.appendChild(detailsButton);
                
                            animalList.appendChild(animalCard);
                        });
                    }
                    

            
                    // Função para aplicar os filtros
                    function applyFilters() {
                        const filterPorte = document.getElementById("filterPorte").value;
                        const filterGenero = document.getElementById("filterGenero").value;
                        const searchName = document.getElementById("searchName").value.trim().toLowerCase();
            
                        $.ajax({
                            url: 'carregar_animais.php', // URL do arquivo PHP que retorna a lista de animais
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                porte: filterPorte,
                                genero: filterGenero
                                // Adicionar o filtro por nome se houver texto na barra de pesquisa
                            },
                            success: function(data) {
                                let filteredAnimals = data.animais;
            
                                if (searchName !== '') {
                                    filteredAnimals = filteredAnimals.filter(animal =>
                                        animal.nomeanimal.toLowerCase().includes(searchName)
                                    );
                                }
            
                                if (filteredAnimals.length > 0) {
                                    displayAnimals(filteredAnimals);
                                } else {
                                    animalList.innerHTML = "<p>Nenhum animal encontrado com os filtros selecionados.</p>";
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                animalList.innerHTML = "<p>Erro ao filtrar animais.</p>";
                            }
                        });
                    }
            
                    // Função para aplicar o filtro de pesquisa por nome
                    function applySearchFilter() {
                        applyFilters(); // Chamando a função de aplicar filtros para atualizar a lista
                    }
            
                    // Event listeners para os filtros e a barra de pesquisa
                    document.getElementById("applyFiltersBtn").addEventListener('click', function() {
                        applyFilters();
                    });
            
                    document.getElementById("searchName").addEventListener('input', function() {
                        applySearchFilter();
                    });
            
                    // Carregar os animais ao carregar a página
                    fetchAnimals();
                });


                function fetchSolicitacoes() {
    fetch('versolicitacoesusuario.php') // Endpoint para buscar solicitações do usuário logado
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na rede: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                throw new Error(data.error); // Verifica se há erro na resposta JSON
            }

            // Verifica se o retorno é bem-sucedido
            if (data.success) {
                // Preencher a tabela com os dados retornados
                const tableBody = document.getElementById('solicitacoesTableBody');
                tableBody.innerHTML = ''; // Limpa o conteúdo atual

                // Acesse o array de solicitações através de data.solicitacoes
                data.solicitacoes.forEach(solicitacao => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${solicitacao.id}</td>
                        <td>${solicitacao.nome_animal}</td>
                        <td>${solicitacao.status}</td> 
                        <td><button class="detalhessolic" onclick="showDetails(${solicitacao.id})">Ver Detalhes</button></td>
                    `;
                    tableBody.appendChild(row);
                });
            } else {
                alert("Erro: " + data.message); // Mostra mensagem de erro, se houver
            }
        })
        .catch(error => {
            console.error('Erro ao buscar as solicitações:', error.message);
            alert('Erro ao carregar solicitações: ' + error.message);
        });
}


function openSolicitacoesModal() {
    fetchSolicitacoes();  // Chama a função para buscar os dados
    document.getElementById('solicitacoesModal').style.display = 'block';
}
function closeSolicitacoesModal() {
    document.getElementById('solicitacoesModal').style.display = 'none';
}

// Fecha a modal se o usuário clicar fora dela
window.onclick = function(event) {
    const modal = document.getElementById('solicitacoesModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};

function showDetails(id) {
    fetch(`detalhesSolicitacao.php?id=${id}`) // Endpoint que retorna detalhes da solicitação
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao buscar detalhes da solicitação.');
            }
            return response.json();
        })
        .then(data => {
            // Preenche os detalhes na modal
            document.getElementById('detalhesCasa').textContent = data.qcasa;
            document.getElementById('detalhesAnimais').textContent = data.qanimais;
            document.getElementById('detalhesPessoas').textContent = data.qpessoas;
            document.getElementById('detalhesSuporte').textContent = data.qsuporte;

            // Exibe a modal
            document.getElementById('detalhesModal').style.display = 'block';
        })
        .catch(error => {
            console.error('Erro ao carregar detalhes:', error);
            alert('Erro ao carregar detalhes: ' + error.message);
        });
}

function closeDetalhesModal() {
    document.getElementById('detalhesModal').style.display = 'none';
}

function fecharModalExternoo(event) {
        if (event.target === document.getElementById("detalhesModal")) {
            closeDetalhesModal();
        }
    }

function fecharDoacaoModal() {
        document.getElementById("doacaoModal").style.display = "none";
    }

    function fecharModalExterno(event) {
        if (event.target === document.getElementById("doacaoModal")) {
            fecharDoacaoModal();
        }
    }
</script>
       
</main>
<footer>
<div class="rodape">
<h3>2024.Trabalho de Conclusão de curso.</h3>
<div class="rodape-dupla">
    <p>Igor Ribeiro de Sousa e Millena Albuquerque de Almeida</p>
    <p class="fatec">FATEC de Guarulhos - Análise e Desenvolvimento de Sistemas</p>
</div>
</footer>
</body>
</html>
