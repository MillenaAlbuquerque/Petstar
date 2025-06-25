<?php
session_start();  // Inicia a sessão


// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario']) && !isset($_SESSION['idong'])) {
    header('Location: login.html');
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit;
}
// Se estiver logado, continua com o carregamento da página de detalhes
require_once 'conexao.php';

// Exemplo: recuperando o ID do animal da URL
if (isset($_GET['id'])) {
    $animalId = $_GET['id'];

    // Consulta para obter os detalhes do animal com base no ID
    $sql = "SELECT * FROM animais WHERE idanimal = '$animalId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $animal = $result->fetch_assoc();
        // Exibir detalhes do animal...
    } else {
        echo "Animal não encontrado.";
    }
} else {
    echo "ID do animal não fornecido.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16"  href="images/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <title>Conheça minha História!</title>
    <script>
        const isLoggedIn = <?php echo $isLoggedIn; ?>; // Passa o valor para JavaScript
    </script>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
.popup {
    position: fixed; /* Fixa o popup na tela */
    bottom: 20px; /* Distância do fundo da tela */
    right: 20px; /* Distância da direita da tela */
    background-color: #c8e6c9; /* Cor de fundo verde claro */
    border: 2px solid #4caf50; /* Borda verde */
    border-radius: 12px; /* Bordas arredondadas */
    padding: 15px; /* Espaçamento interno */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra */
    z-index: 1000; /* Deve ser maior que a modal */
    display: none; /* Inicialmente escondido */
    animation: fadeIn 0.5s; /* Animação para aparecer */
    font-family: 'Poppins', sans-serif; /* Fonte fofa */
    font-size: 16px; /* Tamanho da fonte */
    color: #2e7d32; /* Cor do texto */
    text-align: center; /* Centraliza o texto */
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes fadeOut {
    from { opacity: 1; }
    to { opacity: 0; }
}

        :root{
            --text-color: #333;
            --greendark: #38a269;
            --green: #90d1ae;

        }
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .carousel-inner img {
            width: 100%;
            height: auto;
        }
        
        #animal-name {
            font-size: 2rem;
            margin-bottom: 20px;
            color: var(--greendark);
            font-weight: 600;
        }
        
        #animal-age, #animal-gender, #animal-ong, #animal-description {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        
        .info-container {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            margin-bottom: 1.5rem;
        }
        
        .carousel-item img {
            max-height: 500px;
            object-fit: cover;
        }
 /* Estilos para o botão de voltar */
 .back-button {
    position: fixed;
    top: 10px; /* Ajuste a distância do topo */
    left: 10px;
    padding: 10px 20px;
    background-color: var(--greendark);
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    text-decoration: none;
    display: flex;
    align-items: center;
}

.back-button:hover {
    background-color: #90d1ae;;
}

.back-button svg {
    margin-right: 2px;
    color: white:
}


        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
    
        .modal-content {
            background-image: url('https://images.unsplash.com/photo-1504595403659-9088ce801e29?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover; /* Faz a imagem cobrir toda a modal */
  background-position: center;
            margin: 15% auto; /* Centraliza o conteúdo verticalmente e horizontalmente */
            padding: 20px; /* Espaçamento interno */
            border: 1px solid #888; /* Borda do modal */
            width: 90%; /* Largura do modal (ajuste conforme necessário) */
            max-width: 800px; /* Largura máxima do modal */
            height: 60vh; /* Altura automática */
            max-height: 80vh; /* Altura máxima do modal */
            border-radius: 8px;
        }
    
        .close {
            color: red;
            font-size: 30px;
            float: right;
            cursor: pointer;
        }
    
    
        .step {
            display: none;
        }
    
        .step.active {
            display: block;
        }
    
        .proximo{
            margin-top:3rem;
            display: flex;
  justify-content: center; /* Centraliza o botão horizontalmente */
  align-items: center;
        }

        .label{
            display: flex;
  justify-content: center; /* Centraliza o botão horizontalmente */
  align-items: center;
        }
        .next-btn {
            font-family: 'Poppins', sans-serif;
            padding: 10px 20px;
            margin: 10px;
            background-color:  var(--greendark);
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    
        .next-btn:hover {
            background-color: #218838;
        }

        button {
            background-color: #38a269;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 2rem;;
            transition: background-color 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-weight: 400;
        }
        
        button:hover {
            background-color: var(--button-hover-color);
        }

        label{
            font-family: 'Poppins', sans-serif;
            font-weight: 400; /* Peso normal */
            font-size: 1rem; /* Tamanho da fonte ajustado */
            color: white; /* Cor do texto */
            margin-top: 1.2rem; /* Espaçamento inferior */
        }

.select{
display: flex;
  justify-content: center; /* Centraliza o botão horizontalmente */
  align-items: center;
  font-family: 'Poppins', sans-serif;
}

.input{
    display: flex;
  justify-content: center; /* Centraliza o botão horizontalmente */
  align-items: center;
}
        select{
            font-family: 'Poppins', sans-serif; /* Aplicando a fonte Poppins aos inputs e botão */
            width: 50%;
            padding: 10px;
            border: 1px solid var(--greendark);
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 0.8rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        select:focus{
            border-color: var(--green);
            box-shadow: 0 0 5px rgba(0, 255, 0, 0.5);
            outline: none;
        }
        option{
            display: flex; 
            gap: 20px; /* Espaçamento entre as opções */
            margin-top: 10px; /* Espaçamento acima das opções */
        }


/* Barra de progresso */
#progress-bar {
    width: 100%;
    text-align: center;
    background-color: #f0f0f0;
    border-radius: 5px;
    margin-bottom: 2rem;
    margin-top: 1rem;
}

#progress {
    text-align: center;
    height: 10px;
    background-color:var(--greendark);
    width: 0%;
    border-radius: 5px;
    transition: width 0.3s ease;
}


.modal p{
    font-family: 'Poppins', sans-serif;
    font-weight: 600; /* Peso normal */
    font-size: 1.3rem; /* Tamanho da fonte ajustado */
    color: white; /* Cor do texto */
    margin-top: 1.5rem; /* Espaçamento inferior */
    text-align: center;
}

.preencher {
    font-family: 'Poppins', sans-serif;
    margin-top: 2rem;
    padding: 15px 20px;
    background: var(--greendark);
    color: var(--white);
    border-radius: 10px;
    font-weight: 450;
    transition: all 0.5s;
}

.preencher:hover {
    background: #90d1ae;
}

    </style>
    <!-- Bootstrap CSS (para o carrossel) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <a class="back-button">
        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left" viewBox="0 0 24 24"><path d="M19 12H5"></path><path d="M12 19l-7-7 7-7"></path></svg>
    </a>
    <main class="container mt-5">
        <div class="row">
            <!-- Carrossel de imagens -->
            <div class="col-md-6">
                <div id="carouselExampleIndicators" class="carousel slide">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <!-- Adicione indicadores conforme necessário -->
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="imagemanimal.jpg" class="d-block w-100" alt="Imagem principal">
                        </div>
                        <!-- Adicione mais imagens aqui -->
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <!-- Informações do animal -->
            <div class="col-md-6">
                <div class="info-container">
                    <h1 id="animal-name">Nome do Animal</h1>
                    <p id="animal-age">Idade: X anos</p>
                    <p id="animal-gender">Gênero: X</p>
                    <p id="animal-ong">ONG: X</p>
                    <p id="animal-description">Descrição: Lorem ipsum dolor sit amet.</p>
                    <button id="openFormBtn" class="preencher">Quero adotar!</button>
                    <!-- <div data-tf-live="01J7YQ6ETSGH7KZQ3P0CG7GX64"></div><script src="//embed.typeform.com/next/embed.js"></script> -->
                    <!-- Adicione mais informações se necessário -->
                </div>
            </div>
        </div>

        <!-- Botão para abrir o modal -->
<!-- Modal --> 
<div id="formModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="form" method="POST" action="solicitacoes.php">
                    <div id="progress-bar">
                        <div id="progress"></div>
                    </div>

                    <!-- Etapa 1 -->
                    <div class="step active">
                        <p>Ficamos muito felizes com o seu interesse em adotar!</p> 
                        <p>Podemos conhecer mais sobre o seu dia a dia?</p>
                        <div class="proximo">
                        <button type="button" class="next-btn">Vamos lá!</button>
</div>
                    </div>

                    <!-- Etapa 2 -->
                    <div class="step">
                        <div class="label">
                        <label for="residence">Reside em casa ou apartamento?</label>
</div>
<div class="select">
                        <select id="residence" name="residence" required>
                            <option value="">Selecione...</option>
                            <option value="Casa com telas">Casa com telas</option>
                            <option value="Casa sem telas">Casa sem telas</option>
                            <option value="Apartamento com telas">Apartamento com telas</option>
                            <option value="Apartamento sem telas">Apartamento sem telas</option>
                            <option value="Outro">Outro</option>
                        </select>
</div>
                        <div class="proximo">
                        <button type="button" class="next-btn">Próximo</button>
</div>
                    </div>

                    <!-- Etapa 3 -->
                    <div class="step">
                    <div class="label">
                        <label for="otherAnimals">Possui outros animais?</label>
</div>
                        <div class="input">
                            <input type="radio" id="otherAnimalsSim" name="otherAnimals" value="Sim" required>
                            <label for="otherAnimalsSim">Sim</label>
                        </div>
                        <div class="input">
                            <input type="radio" id="otherAnimalsNao" name="otherAnimals" value="Não" required>
                            <label for="otherAnimalsNao">Não</label>
                        </div>
                        <div class="proximo">
                        <button type="button" class="next-btn">Próximo</button>
</div>
                    </div>

                    <!-- Etapa 4 -->
                    <div class="step">
                    <div class="label">
                        <label for="peopleCount">Quantas pessoas moram com você?</label>
</div>
<div class="select">
                        <select id="peopleCount" name="peopleCount" required>
                            <option value="">Selecione...</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4 ou mais">4 ou mais</option>
                        </select>
</div>
                        <div class="proximo">
                        <button type="button" class="next-btn">Próximo</button>
</div>
                    </div>

                    <!-- Etapa 5 -->
                    <div class="step">
                    <div class="label">
                        <label for="support">Você está disposto a ter um suporte no período de adaptação?</label>
</div>
                        <div class="input">
                            <input type="radio" id="supportSim" name="support" value="Sim" required>
                            <label for="supportSim">Sim</label>

                            <input type="radio" id="supportNao" name="support" value="Não" required>
                            <label for="supportNao">Não</label>
                        </div>
                        <div class="proximo">
                        <button type="button" class="next-btn">Próximo</button>
</div>
                    </div>
                    
                    <!-- Etapa Final -->
                    <div class="step">
                        <input type="hidden" name="idanimal" value="<?php echo htmlspecialchars($animalId); ?>"> <!-- Envia o ID do animal -->
                        <p>Obrigado por completar o formulário!</p>
                        <p>A ONG irá analisar sua solicitação, você pode acompanhar pelo menu "Solicitações".</p>
<div class="proximo">
                        <button type="submit">Enviar</button>
</div>
                    </div>
                </form>
            </div>
        </div>

        <div id="successPopup" class="popup">
    <p>Solicitação registrada com sucesso!</p>
</div>



    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
    <script>

        
        // Função para pegar os parâmetros da URL
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        // Pegar o id do animal da query string
        const animalId = getQueryParam('id');

        // Requisição para buscar os dados do animal no PHP
        fetch(`get_animal.php?id=${encodeURIComponent(animalId)}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.animal) {
                    const animal = data.animal;

                    // Preencher os campos com os dados do animal
                    document.getElementById('animal-name').textContent = animal.nomeanimal;
                    document.getElementById('animal-age').textContent = `Idade: ${animal.idadeanimal} anos`;
                    document.getElementById('animal-gender').textContent = `Gênero: ${animal.generoanimal}`;
                    document.getElementById('animal-ong').textContent = `ONG: ${animal.onganimal}`;
                    document.getElementById('animal-description').textContent = `Descrição: ${animal.detalheanimal}`;

                    // Atualizar o carrossel com as imagens do animal
                    const carouselInner = document.querySelector('.carousel-inner');
                    carouselInner.innerHTML = ''; // Limpar o carrossel existente

                    // Adicione a imagem principal do animal
                    const mainImage = document.createElement('div');
                    mainImage.classList.add('carousel-item', 'active');
                    mainImage.innerHTML = `<img src="${animal.imagemanimal}" class="d-block w-100" alt="${animal.nomeanimal}">`;
                    carouselInner.appendChild(mainImage);

                    // Adicione imagens adicionais se existirem
                    if (animal.imagensadicionais && animal.imagensadicionais.length > 0) {
                        animal.imagensadicionais.forEach((imagem, index) => {
                            const item = document.createElement('div');
                            item.classList.add('carousel-item');
                            item.innerHTML = `<img src="${imagem}" class="d-block w-100" alt="${animal.nomeanimal}">`;
                            carouselInner.appendChild(item);
                        });
                    }
                } else {
                    document.getElementById('animal-name').textContent = "Animal não encontrado.";
                }
            })
            .catch(error => {
                console.error("Erro ao buscar os detalhes do animal:", error);
            });


            document.getElementById("openFormBtn").addEventListener("click", function() {
            if (!isLoggedIn) {
                // Se não estiver logado, redireciona para a página de login
                window.location.href = 'login.html';
            } else {
                // Se estiver logado, abre o modal
                openModal();
            }
        });

        function openModal() {
    const modal = document.getElementById("formModal");
    modal.style.display = "block";
}

// Associar o botão "Preencher Formulário" à função openModal
document.getElementById('openFormBtn').addEventListener('click', openModal);

        // Fechar o modal
        const closeBtn = document.querySelector(".close");
        closeBtn.addEventListener("click", () => {
            const modal = document.getElementById("formModal");
            modal.style.display = "none";
        });

        // Fecha o modal se clicar fora dele
        window.onclick = function(event) {
            const modal = document.getElementById("formModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };

  // Controle das etapas do formulário
  const steps = document.querySelectorAll('.step');
    const progress = document.getElementById('progress');
    let currentStep = 0;

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            step.classList.toggle('active', index === stepIndex);
        });
        progress.style.width = `${((stepIndex + 1) / steps.length) * 100}%`;
    }

    // Verificar se todos os campos da etapa atual foram preenchidos
    function validateStep(stepIndex) {
        const currentStepFields = steps[stepIndex].querySelectorAll('input, select');
        let valid = true;

        currentStepFields.forEach((field) => {
            if (!field.checkValidity()) {
                valid = false;
                field.reportValidity(); // Exibe a mensagem de validação do navegador
            }
        });

        return valid;
    }

    // Navegar para a próxima etapa se os campos forem válidos
    const nextButtons = document.querySelectorAll('.next-btn');
    nextButtons.forEach((button) => {
        button.addEventListener('click', () => {
            if (validateStep(currentStep)) { // Apenas avança se a validação passar
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            }
        });
    });

    // Mostrar a primeira etapa ao iniciar
    showStep(currentStep);


const form = document.getElementById("form");
form.addEventListener("submit", function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    const formData = new FormData(form);
    
    // Envia os dados do formulário para o servidor
    fetch('solicitacoes.php', {
    method: 'POST',
    body: formData,
})
.then(response => response.text())
.then(data => {
    console.log("Resposta do servidor:", data);
    showSuccessPopup(); // Log da resposta
   
    const jsonData = JSON.parse(data); // Lançará erro se não for JSON
    if (jsonData.response.success) {
        showSuccessPopup();
    } else {
        alert(jsonData.message);
    }
})
.catch(error => {
    console.error("Erro ao enviar dados:", error);
});

});

function showSuccessPopup() {
    var popup = document.getElementById('successPopup');
    popup.style.display = 'block'; // Mostra o popup

   
    setTimeout(function() {
        popup.style.display = 'none'; // Oculta o popup
    }, 5000); // Duração do popup em milissegundos (5000ms = 5s)
}




    </script>
</body>
</html>
