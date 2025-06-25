<?php
session_start();
require_once 'conexao.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="style.css">
    <title>Administração - PetStar</title>
    <style>

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

    button.editBtn, button.deleteBtn {
    background-color: transparent; /* Botão sem cor de fundo */
    border: none; /* Sem borda */
    cursor: pointer;
    font-size: 18px; /* Tamanho do ícone */
    color: #333; /* Cor do ícone */
    margin: 0 5px; /* Espaço entre os botões */
}

button.editBtn:hover {
    color: #4CAF50; /* Cor ao passar o mouse no botão de edição */
}

button.deleteBtn:hover {
    color: #f44336; /* Cor ao passar o mouse no botão de exclusão */
}

        .close {
            cursor: pointer;
            float: right;
            font-size: 1.5rem;
        }
        .form {
            padding: 1rem;
            border: 1px solid #ccc;
            margin-top: 1rem;
            background: #f9f9f9;
            position: relative;
        }
        .linha {
            border-bottom: 1px solid #ccc;
            margin-bottom: 1rem;
        }
        .input-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .campo {
            flex: 1;
            min-width: 200px;
        }

        select{
            flex: 1;
            min-width: 100px;
        }

        .enviar-btn {
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background:  var(--greendark);
            color: white;
            border: none;
            cursor: pointer;
        }

        .enviar-btn:hover {
            background: var(--green);
        }


        #addAnimalFormWrapper,
        #editAnimalFormWrapper {
            display: none;
        }
        table {
            width: 95%;
            border-collapse: collapse;
            margin-top: 1rem;
            background: #90d1ae;
            margin-left: 2rem;
            border-radius:10px;
        }

        thead{
            border-radius:10px;
            background: #90d1ae;
        }

        th, td {
            border: 1px solid white;
            padding: 8px;
        }
        th {
            background-color:  #90d1ae;
        }
        #filterContainer {
            margin: 1rem 0;
            display: flex;
            gap: 1rem;
        }
        .detalhes-btn {
            padding: 10px 60px;
            background: var(--greendark);
            color: var(--white);
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.5s;
            border: none;
            margin-top: 0.3rem;
            justify-content: center;
        }
        
        .detalhes-btn > div {
            cursor: pointer;
            transition: all 0.5s;
        }
        
        .detalhes-btn:hover {
            background: var(--green);
        }
        #adminContent {
            max-width: 800px; /* Define a largura máxima do conteúdo */
            margin: 0 auto; /* Centraliza horizontalmente */
            padding: 20px; /* Adiciona um espaçamento interno */
            text-align: center; /* Centraliza o conteúdo dentro do adminContent */
        }
        
        #adminContent h1 {
            text-align: center; /* Centraliza o título "Administração" */
        }
        
        #filterContainer {
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 20px; /* Adiciona um espaçamento abaixo dos filtros */
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center; /* Centraliza os elementos dentro do filterContainer */
        }
        
        #filterContainer input,
        #filterContainer select,
        #filterContainer button {
            margin-right: 10px; /* Espaçamento entre os elementos */
        }
        
        #addAnimalFormWrapper,
        #editAnimalFormWrapper {
            margin-top: 20px; /* Espaçamento acima dos formulários */
        }
        
        #openAddFormBtn {
            margin: 0 auto; /* Centraliza o botão horizontalmente */
            display: block; /* Garante que o botão ocupe toda a largura disponível */
            margin-top: 20px; /* Espaçamento acima do botão */
        }
        
        
        
        
        #success-popup {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #4caf50;
    color: white;
    padding: 15px;
    border-radius: 5px;
    z-index: 1000;
    display: none;
}

#success-popup.visible {
    display: block;
}

#success-popup.shake {
    animation: shake 0.3s;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

.toast {
    position: fixed;
    bottom: 20px; /* Distância do fundo */
    right: 20px; /* Distância da direita */
    background-color: #4CAF50; /* Cor verde (pode ser alterada) */
    color: white;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    opacity: 0; /* Começa invisível */
    transition: opacity 0.5s ease-in-out; /* Efeito de transição */
    z-index: 1000; /* Para garantir que apareça acima de outros elementos */
}

/* Estilo para o dropdown */
.nav-item.dropdown {
    position: relative;
}

.dropdown-content {
    display: none; /* Esconde o conteúdo inicialmente */
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

/* Exibe o dropdown quando ativo */
.nav-item.dropdown:hover .dropdown-content {
    display: block;
}


    </style>
</head>
<body>
    <!-- Navbar -->
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
        <br><br><br><br>
        <div id="adminContent">
        <h1 text-align="center">Administração</h1>

        <!-- Botão para abrir o formulário de adicionar animal -->
        <button class="detalhes-btn" id="openAddFormBtn">Adicionar Animal</button>

        <!-- Formulário para adicionar um novo animal (inicialmente oculto) -->
        <div id="addAnimalFormWrapper">
            <form id="addAnimalForm" method="POST"  enctype="multipart/form-data">
                <span class="close">&times;</span>
                <div class="form">
                    <h1>Adicionar Animal</h1>
                    <div class="linha"></div>
                    <h4 class="info-model"><br> Preencha os campos abaixo para adicionar um novo animal:</h4>
                    <br>
                    <div class="input-group">
                        <div class="campo">
                            <label for="imagemAnimal">Imagem:</label>
                            <input type="file" id="imagemAnimal" name="imagemAnimal[]" accept="image/*" multiple>
                        </div>
                        <div class="campo">
                            <label for="nomeAnimal">Nome:</label>
                            <input type="text" id="nomeAnimal" name="nomeAnimal" placeholder="Digite o nome..." required>
                        </div>
                        <div class="campo">
                            <label for="idadeAnimal">Idade:</label>
                            <input type="text" id="idadeAnimal" name="idadeAnimal" placeholder="Digite a idade..." required>
                        </div>
                        <div class="campo">
                            <label for="detalheAnimal">Detalhe:</label>
                            <input type="text" id="detalheAnimal" name="detalheAnimal" placeholder="Digite detalhes..." required>
                        </div>
                        <div class="campo">
                            <label for="porteAnimal">Porte:</label>
                            <select id="porteAnimal" name="porteAnimal" required>
                                <option value="" disabled selected>Selecione o porte</option>
                                <option value="Pequeno">Pequeno</option>
                                <option value="Médio">Médio</option>
                                <option value="Grande">Grande</option>
                            </select>
                        </div>
                        <div class="campo">
                            <label for="ongAnimal">ONG:</label>
                            <input type="text" id="ongAnimal" name="ongAnimal" value="<?php echo htmlspecialchars($nomeOng); ?>" readonly>
                        </div>
                        <div class="campo">
                            <label for="racaAnimal">Raça:</label>
                            <input type="text" id="racaAnimal" name="racaAnimal" placeholder="Digite a raça..." required>
                        </div>
                        <div class="campo">
                            <label for="generoAnimal">Gênero:</label>
                            <select id="generoAnimal" name="generoAnimal" required>
                                <option value="" disabled selected>Selecione o gênero</option>
                                <option value="Macho">Macho</option>
                                <option value="Fêmea">Fêmea</option>
                            </select>
                        </div>
                    </div>
                    <button class="enviar-btn" type="submit">Registrar</button>
                </div>
            </form>
        </div>
        <div id="success-popup" class="hidden">Animal adicionado com sucesso!</div>


<!-- Formulário para editar animal (inicialmente oculto) -->
<div id="editAnimalFormWrapper">
            <form id="editAnimalForm" method="POST" action="editar_animal.php">
                <span class="close">&times;</span>
                <div class="form">
                    <h1>Editar Animal</h1>
                    <div class="linha"></div>
                    <h4 class="info-model"><br> Atualize as informações do animal:</h4>
                    <br>
                        <div class="input-group">
                        <input type="hidden" id="editAnimalId" name="id">
                        <div class="campo">
                            <label for="imagemAnimal">Imagem:</label>
                            <input type="file" id="imagemAnimal" name="imagemAnimal[]" accept="image/*" multiple>
                        </div>
                        <div class="campo">
                            <label for="editNomeAnimal">Nome:</label>
                            <input type="text" id="editNomeAnimal" name="editNomeAnimal" placeholder="Digite o nome do animal..." required>
                        </div>
                        <div class="campo">
                            <label for="editIdadeAnimal">Idade:</label>
                            <input type="text" id="editIdadeAnimal" name="editIdadeAnimal" placeholder="Digite a idade do animal..." required>
                        </div>
                        <div class="campo">
                            <label for="editDetalheAnimal">Detalhe:</label>
                            <input type="text" id="editDetalheAnimal" name="editDetalheAnimal" placeholder="Digite detalhes sobre o animal..." required>
                        </div>
                        <div class="campo">
                            <label for="editPorteAnimal">Porte:</label>
                            <select id="editPorteAnimal" name="editPorteAnimal" required>
                                <option value="" disabled selected>Selecione o porte</option>
                                <option value="Pequeno">Pequeno</option>
                                <option value="Médio">Médio</option>
                                <option value="Grande">Grande</option>
                            </select>
                        </div>
                        <div class="campo">
                            <label for="editOngAnimal">ONG:</label>
                            <input type="text" id="editOngAnimal" name="editOngAnimal" placeholder="Digite a ONG responsável pelo animal..." readonly>
                        </div>
                        <div class="campo">
                            <label for="editRacaAnimal">Raça:</label>
                            <input type="text" id="editRacaAnimal" name="editRacaAnimal" placeholder="Digite a raça do animal..." >
                        </div>
                        <div class="campo">
                            <label for="editGeneroAnimal">Gênero:</label>
                            <select id="editGeneroAnimal" name="editGeneroAnimal" >
                                <option value="" disabled selected>Selecione o gênero</option>
                                <option value="Macho">Macho</option>
                                <option value="Fêmea">Fêmea</option>
                            </select>
                        </div>
                    </div>
                    <button class="enviar-btn" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>


<!-- Toast Notification -->
<div id="toast" class="toast">
    <p>O animal foi editado com sucesso!</p>
</div>



<!-- Tabela de animais -->
<table id="animaisTable">
    <thead>
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Detalhe</th>
            <th>Porte</th>
            <!--<th>ONG</th>-->
            <th>Raça</th>
            <th>Gênero</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody id="animaisTableBody">
        <!-- Dados dos animais serão preenchidos aqui -->
    </tbody>
</table>

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
    </div>
</div>

<div id="toast" style="position: fixed; top: 20px; right: 20px; background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 8px; opacity: 0; display: none; z-index: 1000;"></div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    
$(document).ready(function() {
    $('#animaisTable').on('click', '.editBtn', function() {
    var idAnimal = $(this).data('id');  /
    editarAnimal(idAnimal);  
    });

    let originalData = {};

    function editarAnimal(idAnimal) {
        console.log('Editar animal com ID:', idAnimal);
        
        fetch(`buscar_animal.php?id=${idAnimal}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao buscar animal.');
                }
                return response.json();
            })
            .then(data => {
                // Preencher o formulário de edição com os dados do animal
                $('#editAnimalId').val(data.idanimal);
                $('#editNomeAnimal').val(data.nomeanimal);
                $('#editIdadeAnimal').val(data.idadeanimal);
                $('#editDetalheAnimal').val(data.detalheanimal);
                $('#editPorteAnimal').val(data.porteanimal);
                $('#editOngAnimal').val(data.onganimal);
                $('#editRacaAnimal').val(data.racaanimal);
                $('#editGeneroAnimal').val(data.generoanimal);
                
                originalData = { ...data };

                // Exibir o formulário de edição
                $('#editAnimalFormWrapper').show();
            })
            .catch(error => console.error('Erro ao buscar animal:', error));
    }

    $('#editAnimalForm').submit(function(event) {
    event.preventDefault();

    var formData = {};
    var idAnimal = $('#editAnimalId').val();
formData.id = idAnimal; // Inclui o ID do animal para o PHP


    // Adiciona ao formData apenas os campos que foram alterados
    if ($('#editNomeAnimal').val() !== originalData.nomeanimal) {
        formData.editNomeAnimal = $('#editNomeAnimal').val();
    }
    if ($('#editIdadeAnimal').val() !== originalData.idadeanimal) {
        formData.editIdadeAnimal = $('#editIdadeAnimal').val();
    }
    if ($('#editDetalheAnimal').val() !== originalData.detalheanimal) {
        formData.editDetalheAnimal = $('#editDetalheAnimal').val();
    }
    if ($('#editPorteAnimal').val() !== originalData.porteanimal) {
        formData.editPorteAnimal = $('#editPorteAnimal').val();
    }
    if ($('#editOngAnimal').val() !== originalData.onganimal) {
        formData.editOngAnimal = $('#editOngAnimal').val();
    }
    if ($('#editRacaAnimal').val() !== originalData.racaanimal) {
        formData.editRacaAnimal = $('#editRacaAnimal').val();
    }
    if ($('#editGeneroAnimal').val() !== originalData.generoanimal) {
        formData.editGeneroAnimal = $('#editGeneroAnimal').val();
    }

    formData.id = idAnimal; // Inclui o ID do animal para o PHP

    console.log('Dados enviados:', formData);
    // Enviar dados para o PHP
    $.ajax({
        url: 'editar_animal.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
    if (response.success) {
        // Mostrar o toast
        $('#toast').css('opacity', '1'); // Torna visível
        $('#toast').fadeIn().delay(3000).fadeOut(); // Aparecer, esperar 3s e desaparecer

        // Atualiza a tabela localmente
        const row = $('#animaisTable').find(`tr[data-id="${idAnimal}"]`);
        if (row.length) {
            row.find('.nome-animal').text(formData.editNomeAnimal || originalData.nomeanimal);
            row.find('.idade-animal').text(formData.editIdadeAnimal || originalData.idadeanimal);
            row.find('.detalhe-animal').text(formData.editDetalheAnimal || originalData.detalheanimal);
            row.find('.porte-animal').text(formData.editPorteAnimal || originalData.porteanimal);
            row.find('.onganimal-animal').text(formData.editOngAnimal || originalData.onganimal);
            row.find('.raca-animal').text(formData.editRacaAnimal || originalData.racaanimal);
            row.find('.genero-animal').text(formData.editGeneroAnimal || originalData.generoanimal);
        }
    } else {
        alert('Erro ao editar animal: ' + response.message);
    }
}



    });
});


setTimeout(function() {
    $('#successModal').fadeOut();
}, 3000); // Fecha após 3 segundos

    $('.close').click(function() {
        $('#editAnimalFormWrapper').hide();
    });
});



//ADICIONAR
document.getElementById("addAnimalForm").onsubmit = function(event) {
    event.preventDefault(); // Evita o envio padrão do formulário

    const formData = new FormData(this); // Cria um FormData com os dados do formulário

    // Envia o formulário com AJAX
    fetch('admin.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.response.success) {
            showSuccessPopup();
        } else {
            alert(data.response.message); // Mostra erro
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Erro ao adicionar animal.');
    });
};

function showSuccessPopup() {
    const popup = document.getElementById('success-popup');
    popup.classList.remove('hidden');
    popup.classList.add('visible', 'shake');

    // Oculta o pop-up após 3 segundos e redireciona para a página de administração
    setTimeout(() => {
        popup.classList.remove('visible', 'shake');
        popup.classList.add('hidden');
        window.location.href = 'administracao.php'; 
    }, 3000);
}

//CARREGAR TABELA
       $(document).ready(function() {
    // Função para carregar os animais na tabela
    function carregarAnimais() {
        console.log("Carregando animais...");
        const onganimal = $('#filterOng').val();

        $.ajax({
            url: `listar_animais.php`, // URL sem parâmetros na query
            type: 'POST', // Tipo de requisição
            data: {
                onganimal: onganimal // Envia todos os dados no corpo
            },
            dataType: 'json',
            success: function(data) {
                var tbody = $('#animaisTableBody');
                tbody.empty();
                if (data.animais && data.animais.length > 0) {
                    data.animais.forEach(function(animal) {
                        var tr = $('<tr>');
                        tr.append('<td>' + (animal.imagemanimal ? '<img src="' + animal.imagemanimal + '" alt="Imagem do Animal" style="max-width: 100px; max-height: 100px;">' : 'Sem imagem') + '</td>');
                        tr.append('<td>' + animal.nomeanimal + '</td>');
                        tr.append('<td>' + animal.idadeanimal + '</td>');
                        tr.append('<td>' + animal.detalheanimal + '</td>');
                        tr.append('<td>' + animal.porteanimal + '</td>');
                        //tr.append('<td>' + animal.onganimal + '</td>');
                        tr.append('<td>' + animal.racaanimal + '</td>');
                        tr.append('<td>' + animal.generoanimal + '</td>');
                        tr.append(`<td> 
                        <button class="editBtn" data-id="${animal.idanimal}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="deleteBtn" data-id="${animal.idanimal}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
</td>`);
                        tbody.append(tr);
                    });
                } else {
                    tbody.append('<tr><td colspan="8">Nenhum animal cadastrado.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Erro ao carregar animais: " + xhr.responseText);
            }
        });
    }

                // Delegar evento de clique para os botões de deletar
                $('#animaisTable').on('click', '.deleteBtn', function() {
                console.log('ID do animal:', animalId);
                console.log("Função deletar chamada");
    var animalId = $(this).data('id');
// Usar SweetAlert para confirmação
Swal.fire({
        title: 'Tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, deletar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'deletar_animal.php',
                type: 'POST',
                data: { id: animalId },
                dataType: 'json',
                success: function(response) {
                    console.log('Resposta recebida:', response); 
                    if (response && response.success) { 
                        $('#toast').text(response.message).css('background-color', '#4CAF50'); // Cor de sucesso
                        $('#toast').fadeIn().delay(3000).fadeOut();
                        carregarAnimais(); // Recarregar a tabela de animais
                    } else {
                        $('#toast').text(response.message || 'Erro desconhecido').css('background-color', '#f44336');
                        $('#toast').fadeIn().delay(3000).fadeOut();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro na requisição AJAX:', xhr.responseText); // Verifique se a requisição falhou
                    $('#toast').text('Erro ao deletar animal: ' + xhr.responseText).css('background-color', '#f44336');
                    $('#toast').fadeIn().delay(3000).fadeOut();
                }
            });
        }
    });
});

    // Carregar animais ao carregar a página
    carregarAnimais();

    
            // Exibe o formulário de adicionar animal
            document.getElementById('openAddFormBtn').addEventListener('click', function() {
                document.getElementById('addAnimalFormWrapper').style.display = 'block';
            });
    
            // Fecha o formulário ao clicar no botão de fechar
            document.querySelectorAll('.close').forEach(function(element) {
                element.addEventListener('click', function() {
                    element.closest('.form').parentElement.style.display = 'none';
                });
            });
    
            // Aplica filtros ao clicar no botão
            document.getElementById('applyFiltersBtn').addEventListener('click', carregarAnimais);
    



           
            // Fechar formulário de edição
            $('.close').click(function() {
                $('#editAnimalFormWrapper').hide();
            });
        });

 
       

function carregarAnimais() {
    // Capturar os valores dos filtros
    const nome = document.getElementById('searchName').value;
    const porte = document.getElementById('filterPorte').value;
    const genero = document.getElementById('filterGenero').value;

    // Enviar os filtros na requisição AJAX
    $.ajax({
        url: 'carregar_animais.php',  
        type: 'GET',
        data: {
            nome: nome,
            porte: porte,
            genero: genero
        },
        dataType: 'json',
        success: function(data) {
            // Limpar a tabela antes de inserir os dados atualizados
            const animaisTableBody = document.getElementById('animaisTableBody');
            animaisTableBody.innerHTML = '';

            // Preencher a tabela com os dados filtrados
            data.forEach(animal => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${animal.nome}</td>
                    <td>${animal.porte}</td>
                    <td>${animal.genero}</td>
                    <!-- Adicione mais células conforme necessário -->
                `;
                animaisTableBody.appendChild(row);
            });
        },
        error: function(xhr, status, error) {
            console.error('Erro ao carregar animais:', xhr.responseText);
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    // Função para aplicar os filtros
    function applyFilters() {
        const filterPorte = document.getElementById("filterPorte").value;
        const filterGenero = document.getElementById("filterGenero").value;
        const searchName = document.getElementById("searchName").value.trim().toLowerCase();

        $.ajax({
            url: 'carregar_animais.php', 
            type: 'GET',
            dataType: 'json',
            data: {
                porte: filterPorte,
                genero: filterGenero,
                nome: searchName  // Enviando o parâmetro de pesquisa por nome
            },
            success: function(data) {
                let filteredAnimals = data.animais;

                // Filtrar os animais por nome no lado do cliente
                if (searchName !== '') {
                    filteredAnimals = filteredAnimals.filter(animal =>
                        animal.nomeanimal.toLowerCase().includes(searchName)
                    );
                }

                // Exibir animais ou mensagem de nenhum resultado
                if (filteredAnimals.length > 0) {
                    displayAnimals(filteredAnimals);
                } else {
                    document.getElementById("animaisTableBody").innerHTML = "<tr><td colspan='5'>Nenhum animal encontrado com os filtros selecionados.</td></tr>";
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                document.getElementById("animaisTableBody").innerHTML = "<tr><td colspan='5'>Erro ao filtrar animais.</td></tr>";
            }
        });
    }

    function displayAnimals(animals) {
    const animaisTableBody = document.getElementById("animaisTableBody");
    animaisTableBody.innerHTML = ''; // Limpar conteúdo anterior

    animals.forEach(animal => {
        const row = document.createElement('tr');
        for (const key in animal) {
            const cell = document.createElement('td');
            cell.textContent = animal[key];
            row.appendChild(cell);
        }
        animaisTableBody.appendChild(row);
    });
}



    // Event listeners para os filtros e a barra de pesquisa
    document.getElementById("applyFiltersBtn").addEventListener('click', function() {
        applyFilters();
    });

    document.getElementById("searchName").addEventListener('input', function() {
        applyFilters(); // Atualizar a lista ao digitar na barra de pesquisa
    });
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
   
    fetch(`detalhesSolicitacao.php?id=${id}`) 
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
        })
        .catch(error => {
            console.error('Erro ao carregar detalhes:', error);
            alert('Erro ao carregar detalhes: ' + error.message);
        });
}
function closeDetalhesModal() {
    document.getElementById('detalhesModal').style.display = 'none';
}


    </script>

</html>



