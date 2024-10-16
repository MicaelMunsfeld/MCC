document.addEventListener('DOMContentLoaded', function () {
    const estadoSelect = document.getElementById('estado');
    const cidadeSelect = document.getElementById('cidade');
    const selectedEstado = estadoSelect.getAttribute('data-selected');
    const selectedCidade = cidadeSelect.getAttribute('data-selected');

    // Função para carregar os estados
    function carregarEstados() {
        fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
            .then(response => response.json())
            .then(estados => {
                estados.sort((a, b) => a.nome.localeCompare(b.nome)); // Ordenar por nome
                estados.forEach(estado => {
                    const option = document.createElement('option');
                    option.value = estado.id;
                    option.textContent = estado.nome;
                    if (estado.id == selectedEstado) {
                        option.selected = true;
                    }
                    estadoSelect.appendChild(option);
                });

                if (selectedEstado) {
                    carregarCidades(selectedEstado);
                }
            });
    }

    // Função para carregar as cidades com base no estado selecionado
    function carregarCidades(estadoId) {
        fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoId}/municipios`)
            .then(response => response.json())
            .then(cidades => {
                cidadeSelect.innerHTML = '<option value="">Selecione a cidade</option>';
                cidades.forEach(cidade => {
                    const option = document.createElement('option');
                    option.value = cidade.nome;
                    option.textContent = cidade.nome;
                    if (cidade.nome == selectedCidade) {
                        option.selected = true;
                    }
                    cidadeSelect.appendChild(option);
                });
            });
    }

    // Inicializar os estados
    carregarEstados();
});