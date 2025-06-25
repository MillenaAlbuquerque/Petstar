<!-- Modal para exibir informações do usuário -->
<div id="perfilModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <!-- Conteúdo das informações do usuário aqui -->
        <h2>Informações do Usuário</h2>
        <div id="infoUsuario"></div>
        <button onclick="window.location.href='administração.html'">Administração</button>
        <!-- Fim do conteúdo -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Função para buscar informações do usuário
    function obterInformacoesUsuario() {
        $.ajax({
            url: 'info_usuario.php',
            type: 'GET',
            success: function(data) {
                $('#infoUsuario').html('<p><strong>Nome:</strong> ' + data.nome + '</p>' +
                    '<p><strong>Email:</strong> ' + data.email + '</p>' +
                    '<p><strong>Cidade:</strong> ' + data.cidade + '</p>' +
                    '<p><strong>Telefone:</strong> ' + data.telefone + '</p>');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Quando o documento estiver pronto
    $(document).ready(function() {
        // Quando o botão "Meu Perfil" for clicado, obtenha as informações do usuário e exiba-as no modal
        $('#meuPerfilBtn').click(function() {
            obterInformacoesUsuario();
            $('#perfilModal').show(); // Mostra o modal
        });


        $('.close, .modal').click(function() {
            $('#perfilModal').hide(); // Oculta o modal
        });

        // Impede que o clique dentro do modal o feche
        $('.modal-content').click(function(event) {
            event.stopPropagation();
        });
    });
</script>
