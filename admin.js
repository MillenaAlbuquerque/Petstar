$(document).ready(function() {

    // Função para carregar os animais na tabela
    function carregarAnimais() {
        $.ajax({
            url: 'listar_animais.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var tbody = $('#animaisTable tbody');
                tbody.empty();
                if (data.animais && data.animais.length > 0) {
                    data.animais.forEach(function(animal) {
                        var tr = $('<tr>');
                        tr.append('<td>' + animal.nomeanimal + '</td>');
                        tr.append('<td>' + animal.idadeanimal + '</td>');
                        tr.append('<td>' + animal.detalheanimal + '</td>');
                        tr.append('<td>' + animal.porteanimal + '</td>');
                        tr.append('<td>' + animal.onganimal + '</td>');

                        // Exibindo a imagem do animal, se houver
                        if (animal.imagemanimal) {
                            tr.append('<td><img src="' + animal.imagemanimal + '" alt="Imagem do Animal" style="max-width: 100px; max-height: 100px;"></td>');
                        } else {
                            tr.append('<td>Sem imagem</td>');
                        }

                        tr.append('<td><button class="editBtn" data-id="' + animal.idanimal + '">Editar</button> <button class="deleteBtn" data-id="' + animal.idanimal + '">Deletar</button></td>');
                        tbody.append(tr);
                    });
                } else {
                    tbody.append('<tr><td colspan="7">Nenhum animal cadastrado.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Erro ao carregar animais: " + xhr.responseText);
            }
        });
    }

    // Carregar animais ao carregar a página
    carregarAnimais();

    $('#animaisTable').on('click', '.deleteBtn', function() {
        var animalId = $(this).data('id');
        if (confirm('Tem certeza que deseja deletar este animal?')) {
            $.ajax({
                url: 'deletar_animal.php',
                type: 'POST',
                data: { id: animalId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert("Animal deletado com sucesso!");
                        carregarAnimais(); // Recarregar a tabela de animais
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Erro ao deletar animal: " + xhr.responseText);
                }
            });
        }
    });

    // Delegar evento de clique para os botões de editar
    $('#animaisTable').on('click', '.editBtn', function() {
        var animalId = $(this).data('id');
        var animalData = $(this).closest('tr').find('td').map(function() {
            return $(this).text();
        }).get();

        // Preencher o formulário de edição com os dados atuais do animal
        $('#editAnimalId').val(animalId);
        $('#editNomeAnimal').val(animalData[0]);    // Coluna Nome
        $('#editIdadeAnimal').val(animalData[1]);   // Coluna Idade
        $('#editDetalheAnimal').val(animalData[2]); // Coluna Detalhe
        $('#editPorteAnimal').val(animalData[3]);   // Coluna Porte
        $('#editOngAnimal').val(animalData[4]);     // Coluna ONG

        // Exibir o formulário de edição
        $('#editAnimalFormWrapper').show();
    });
    

    // Submeter formulário de edição via AJAX
    $('#editAnimalForm').submit(function(event) {
        event.preventDefault();

        var formData = {
            id: $('#editAnimalId').val(),
            nomeAnimal: $('#editNomeAnimal').val(),
            idadeAnimal: $('#editIdadeAnimal').val(),
            detalheAnimal: $('#editDetalheAnimal').val(),
            porteAnimal: $('#editPorteAnimal').val(),
            ongAnimal: $('#editOngAnimal').val()
        };

        $.ajax({
            url: 'editar_animal.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert("Animal atualizado com sucesso!");
                    carregarAnimais(); // Recarregar a tabela de animais
                    $('#editAnimalForm')[0].reset(); // Limpar o formulário
                    $('#editAnimalFormWrapper').hide(); // Ocultar o formulário
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Erro ao editar animal: " + xhr.responseText);
            }
        });
    });

    // Fechar formulário de edição
    $('.close').click(function() {
        $('#editAnimalFormWrapper').hide();
    });

});

