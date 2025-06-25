<?php
session_start();

$idOng = isset($_SESSION['idong']) ? $_SESSION['idong'] : 'Usuário não logado';

if ($idOng === 'Usuário não logado') {
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
        /* Modal suave com estilo fofo */
    
    .doacao-modal {
    display: none;
    position: fixed;
    z-index: 1000;
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
    font-family: 'Comic Sans MS', sans-serif;
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
    padding: 0; 
    margin: 0; 
}

/* Ajuste para a seção layout */
.layout-container {
    display: flex;
    align-items: flex-start;
    gap: 10px; /* Diminua o espaço entre os filtros e os cards */
    width: 100%;
    padding-left: 10px; 
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

.detalhessolic{
    padding: 10px 55px;
    background-color: var(--greendark);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
    margin-top: 10px;
    border-yop: 1px solid #ddd; /* Borda inferior */

}

. button:hover {
    background-color: var(--green);
}

/* Estilo da modal */
.modal {
    display: none; /* Oculto por padrão */
    position: fixed; /* Fixo na tela */
    z-index: 1000; /* Sobreposição */
    left: 0;
    top: 0;
    width: 100%; /* Largura total */
    height: 100%; /* Altura total */
    overflow: auto; /* Rolagem se necessário */
    background-color: rgba(0, 0, 0, 0.5); /* Fundo escuro com opacidade */
}

/* Conteúdo da modal */
.modal-content {
    background-color: white; /* Fundo branco */
    margin: 15% auto; /* Margens automáticas para centralizar */
    padding: 20px;
    border: 1px solid #888; /* Borda */
    border-radius: 10px; /* Cantos arredondados */
    width: 150%; /* Largura da modal */
    max-width: 1000px; /* Largura máxima */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra */
}

/* Estilo do botão de fechar */
.close {
    color: #aaa; /* Cor do botão */
    float: right; /* Posiciona à direita */
    font-size: 28px; /* Tamanho da fonte */
    font-weight: bold; /* Negrito */
}

/* Efeito ao passar o mouse sobre o botão de fechar */
.close:hover,
.close:focus {
    color: black; /* Muda a cor ao passar o mouse */
    text-decoration: none; /* Remove o sublinhado */
    cursor: pointer; /* Muda o cursor */
}

/* Tabela */
table {
    width: 100%; /* Largura total */
    border-collapse: collapse; /* Colapsa as bordas */
    border-radius: 8px;
}

th, td {
    color: #343334;
    padding: 10px; /* Espaçamento */
    text-align: left; /* Alinhamento à esquerda */
    border-bottom: 1px solid #ddd; /* Borda inferior */
}

h2 {
    color: #343334;
    padding: 10px; /* Espaçamento */
    text-align: center; /* Alinhamento à esquerda */
    border-bottom: 1px solid #ddd; /* Borda inferior */
}

th {
    background-color:  white; /* Fundo claro */
    border-radius: 8px;
}

/* Efeito ao passar o mouse sobre as linhas da tabela */
tr:hover {
    background-color: #90d1ae; /* Muda o fundo ao passar o mouse */
}

tbody{
    border-radius: 8px;
}

/* Estilos para o contêiner de notificações */
#notification-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* Estilo das notificações */
.notification {
    padding: 15px 20px;
    border-radius: 8px;
    font-family: 'Poppins', sans-serif;
    color: white;
    background-color: #38a269;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    opacity: 0;
    transform: translateX(100%);
    transition: opacity 0.4s, transform 0.4s;
}

.notification.error {
    background-color: #d9534f;
}

.notification.show {
    opacity: 1;
    transform: translateX(0);
}


</style>
</head>
<body>

<header>
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
                <a onclick="abrirModalDoacoes()">Solicitações de Doação</a>
            </div>
        </li>
            <?php 
            if (isset($_SESSION['nomeong'])) { // Verifica se o usuário está logado
                $nomeOng = $_SESSION['nomeong']; // Armazena o nome do usuário
            ?>
                <li class="nav-item dropdown">
                    <a href="#" class="dropbtn" id="adminBtn"><?php echo $nomeOng; ?> <i class="bx bxs-chevron-down"></i></a> <!-- Adiciona a seta -->
                    <div class="dropdown-content" id="adminDropdown">
                    <a href="perfil.php">Meu Perfil</a>
                    <a href="administracao.php">Administração</a>
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
                <h3 class="descricao">Conheça os animais disponiveis.</h3>
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
        <h2>Solicitações</h2>
        <table id="solicitacoesTable">
            <thead>
                <tr>
                    <th>Solicitação</th>
                    <th>Animal</th>
                    <th>Adotante</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
            </thead>
            <tbody id="solicitacoesTableBody">
                <!-- Dados das solicitações serão inseridos aqui -->
            </tbody>
        </table>
    </div>
</div>



<div id="detalhesModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDetalhesModal()">&times;</span>
        <h2>Detalhes da Solicitação</h2>
        <p><strong>Onde mora:</strong> <span id="detalhesCasa"></span></p>
        <p><strong>Possui animais:</strong> <span id="detalhesAnimais"></span></p>
        <p><strong>Reside com quantas pessoas:</strong> <span id="detalhesPessoas"></span></p>
        <p><strong>Interesse em suporte:</strong> <span id="detalhesSuporte"></span></p>
        <div id="actionsContainer"></div>
    </div>
</div>


<!-- Modal de Solicitações de Doação -->
<div id="doacoesModal" class="doacao-modal">
    <div class="doacao-modal-content">
        <span class="doacao-close" onclick="fecharModalDoacoes()">&times;</span>
        <h2>Solicitações de Doação Recebidas</h2>
        <table>
            <thead>
                <tr>
                    <th>Tipo de Doação</th>
                    <th>Quantidade</th>
                    <th>Nome do Doador</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Data da Doação</th>
                </tr>
            </thead>
            <tbody id="doacoesContent">
                <!-- As solicitações de doação serão carregadas aqui via AJAX -->
            </tbody>
        </table>
    </div>
</div>

<div id="notification-container"></div>

<script>
function abrirModalDoacoes() {
    console.log("abrirModalDoacoes chamada");
    document.getElementById('doacoesModal').style.display = 'flex';
    carregarSolicitacoesDoacao(); // Chama a função para carregar as solicitações
}

    // Função para fechar o modal de doações
    function fecharModalDoacoes() {
        document.getElementById('doacoesModal').style.display = 'none';
    }

    // Fechar o modal ao clicar fora dele
    window.onclick = function(event) {
        var modal = document.getElementById('doacoesModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    // Função para carregar as solicitações de doação via AJAX
    function carregarSolicitacoesDoacao() {
        fetch('carregar_doacoesong.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('doacoesContent').innerHTML = data;
            })
            .catch(error => {
                console.error('Erro ao carregar as solicitações de doação:', error);
            });
    }


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

    // Função para exibir os animais na tela
    function displayAnimals(animals) {
        animalList.innerHTML = ""; // Limpa a lista antes de preenchê-la novamente

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

            detailsButton.addEventListener('click', function() {
                const animalId = animal.idanimal;  // Captura o id do animal
                console.log(`Redirecionando para: detalhes.php?id=${animalId}`);
                window.location.href = `detalhes.php?id=${encodeURIComponent(animalId)}`;  // Redireciona com o ID
            });

            // Adiciona os elementos ao card do animal
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
    fetch('versolicitacoesong.php')
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

            // Preencher a tabela com os dados retornados
            const tableBody = document.getElementById('solicitacoesTableBody');
            tableBody.innerHTML = ''; // Limpa o conteúdo atual

            data.forEach(solicitacao => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${solicitacao.id}</td>
                    <td>${solicitacao.nome_animal}</td>
                    <td>${solicitacao.nome_usuario}</td>
                    <td>${solicitacao.email_usuario}</td>
                    <td>${solicitacao.telefone_usuario}</td>
                    <td><button class="detalhessolic" onclick="showDetails(${solicitacao.id})">Ver Detalhes</button></td>
                `;
                tableBody.appendChild(row);
            });
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
    // Aqui você pode buscar os dados detalhados da solicitação com base no ID
    fetch(`detalhesSolicitacao.php?id=${id}`) // Supondo que você tenha um endpoint que retorna os detalhes
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao buscar detalhes da solicitação.');
            }
            return response.json();
        })
        .then(data => {
            // Preencha os detalhes na modal
            document.getElementById('detalhesCasa').textContent = data.qcasa;
            document.getElementById('detalhesAnimais').textContent = data.qanimais;
            document.getElementById('detalhesPessoas').textContent = data.qpessoas;
            document.getElementById('detalhesSuporte').textContent = data.qsuporte;

            // Mostre a modal
            document.getElementById('detalhesModal').style.display = 'block';

            // Adiciona botões de Aprovar e Rejeitar na modal
            const actionsContainer = document.getElementById('actionsContainer');
            actionsContainer.innerHTML = `
                <button onclick="aprovarSolicitacao(${id})">Aprovar</button>
                <button onclick="rejeitarSolicitacao(${id})">Rejeitar</button>`
        })
        .catch(error => {
            console.error('Erro ao carregar detalhes:', error);
            showNotification('Erro ao carregar detalhes: ' + error.message, 'error');
        });
}
function closeDetalhesModal() {
    document.getElementById('detalhesModal').style.display = 'none';
}

function aprovarSolicitacao(id) {
    fetch(`aprovar_solicitacao.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification("Solicitação aprovada!");
                closeDetalhesModal();
                fetchSolicitacoes(); // Atualiza a lista na modal
            } else {
                alert("Erro ao aprovar a solicitação: " + data.message);
            }
        })
        .catch(error => {
            console.error('Erro ao aprovar a solicitação:', error);
            showNotification('Erro ao aprovar a solicitação: ' + error.message, 'error');
        });
}

function rejeitarSolicitacao(id) {
    fetch(`rejeitar_solicitacao.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification("Solicitação rejeitada!");
                closeDetalhesModal();
                fetchSolicitacoes(); // Atualiza a lista na modal
            } else {
                alert("Erro ao rejeitar a solicitação: " + data.message);
            }
        })
        .catch(error => {
            console.error('Erro ao rejeitar a solicitação:', error);
            showNotification('Erro ao aprovar a solicitação: ' + error.message, 'error');
        });
}

function showNotification(message, type = 'success') {
    const notificationContainer = document.getElementById('notification-container');
    
    // Cria uma nova div para a notificação
    const notification = document.createElement('div');
    notification.classList.add('notification', type === 'error' ? 'error' : 'success', 'show');
    notification.textContent = message;
    
    // Adiciona a notificação ao contêiner
    notificationContainer.appendChild(notification);
    
    // Remove a notificação após 4 segundos
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 400);
    }, 4000);
}


</script>
       
</main>
<footer>
<div class="rodape">
<h3>2024.Trabalho de Conclusão de curso.</h3>
</div>
<div class="rodape-dupla">
    <p>Igor Ribeiro de Sousa e Millena Albuquerque de Almeida</p>
    <p class="fatec">FATEC de Guarulhos - Análise e Desenvolvimento de Sistemas</p>
</div>
</footer>
</body>
</html>
