// modeloCadastro.js

document.addEventListener('DOMContentLoaded', function () {
    const marcaSelect = document.getElementById('id_marca');
    const modeloSelect = document.getElementById('nome_modelo');

    // Função para carregar os modelos da marca selecionada
    const carregarModelos = (marcaNome) => {
        modeloSelect.innerHTML = '<option value="">Selecione o Modelo</option>'; // Limpa os modelos ao trocar de marca

        if (marcaNome) {
            // Fetch das marcas da API da FIPE para obter o código correto da marca selecionada
            fetch('https://parallelum.com.br/fipe/api/v1/carros/marcas')
                .then(response => response.json())
                .then(marcasFipe => {
                    const marcaFipe = marcasFipe.find(marca => marca.nome.toLowerCase() === marcaNome.toLowerCase());

                    if (marcaFipe) {
                        // Carrega os modelos da marca selecionada
                        fetch(`https://parallelum.com.br/fipe/api/v1/carros/marcas/${marcaFipe.codigo}/modelos`)
                            .then(response => response.json())
                            .then(data => {
                                data.modelos.forEach(modelo => {
                                    let option = document.createElement('option');
                                    option.value = modelo.nome; // Use modelo.codigo se necessário
                                    option.text = modelo.nome;
                                    modeloSelect.appendChild(option);
                                });

                                // Seleciona o modelo atual se ele estiver na lista
                                const modeloAtual = modeloSelect.getAttribute('data-selecionado');
                                if (modeloAtual) {
                                    modeloSelect.value = modeloAtual;
                                }
                            })
                            .catch(error => {
                                console.error('Erro ao carregar modelos:', error);
                            });
                    } else {
                        console.error('Marca não encontrada na FIPE:', marcaNome);
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar marcas da FIPE:', error);
                });
        }
    };

    // Evento para carregar os modelos ao alterar a marca
    marcaSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const fipeMarcaNome = selectedOption.getAttribute('data-fipe');
        carregarModelos(fipeMarcaNome);
    });

    // Carrega os modelos da marca inicialmente selecionada, se houver
    const marcaSelecionada = marcaSelect.options[marcaSelect.selectedIndex]?.getAttribute('data-fipe');
    if (marcaSelecionada) {
        modeloSelect.setAttribute('data-selecionado', modeloSelect.value); // Salva o modelo atualmente selecionado
        carregarModelos(marcaSelecionada);
    }
});
