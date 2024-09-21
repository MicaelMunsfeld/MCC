// veiculoCadastro.js

document.addEventListener('DOMContentLoaded', function () {
    const tipoSelect = document.getElementById('tipo');
    const marcaSelect = document.getElementById('marca');
    const modeloSelect = document.getElementById('modelo');
    const anoSelect = document.getElementById('ano');

    // Inicialmente desabilita os campos de marca, modelo e ano
    marcaSelect.disabled = true;
    modeloSelect.disabled = true;
    anoSelect.disabled = true;

    // Carrega as marcas ao selecionar um tipo
    tipoSelect.addEventListener('change', function () {
        const tipoSelecionado = this.value;

        if (tipoSelecionado) {
            // Mostra as marcas que correspondem ao tipo selecionado
            Array.from(marcaSelect.options).forEach(option => {
                const optionTipo = option.getAttribute('data-tipo');
                if (optionTipo === tipoSelecionado) {
                    option.style.display = 'block';
                    option.disabled = false;
                } else {
                    option.style.display = 'none';
                    option.disabled = true;
                }
            });

            // Habilita o campo de marca
            marcaSelect.disabled = false;
            marcaSelect.value = ''; // Reseta a seleção da marca
            modeloSelect.disabled = true; // Mantém o modelo desabilitado até que uma marca seja selecionada
            anoSelect.disabled = true; // Mantém o ano desabilitado até que um modelo seja selecionado
        } else {
            // Desabilita os campos se nenhum tipo for selecionado
            marcaSelect.disabled = true;
            modeloSelect.disabled = true;
            anoSelect.disabled = true;
        }
    });

    // Carrega os modelos ao selecionar uma marca
    marcaSelect.addEventListener('change', function () {
        const marcaSelecionada = this.value;

        if (marcaSelecionada) {
            // Mostra os modelos que correspondem à marca selecionada
            Array.from(modeloSelect.options).forEach(option => {
                const optionMarca = option.getAttribute('data-marca');
                if (optionMarca === marcaSelecionada) {
                    option.style.display = 'block';
                    option.disabled = false;
                } else {
                    option.style.display = 'none';
                    option.disabled = true;
                }
            });

            // Habilita o campo de modelo
            modeloSelect.disabled = false;
            modeloSelect.value = ''; // Reseta a seleção do modelo
            anoSelect.disabled = true; // Mantém o campo de ano desabilitado até que um modelo seja selecionado
        } else {
            // Desabilita os campos se nenhuma marca for selecionada
            modeloSelect.disabled = true;
            anoSelect.disabled = true;
        }
    });

    // Carrega os anos ao selecionar um modelo
    modeloSelect.addEventListener('change', function () {
        const tipoCodigo = tipoSelect.value;
        const selectedMarca = marcaSelect.options[marcaSelect.selectedIndex];
        const fipeMarcaNome = selectedMarca ? selectedMarca.getAttribute('data-fipe') : '';
        const modeloNome = this.options[this.selectedIndex].text;

        anoSelect.innerHTML = '<option value="">Selecione o Ano</option>';
        anoSelect.disabled = !modeloNome;

        if (tipoCodigo && fipeMarcaNome && modeloNome) {
            // Busca as marcas da API da FIPE para obter o código da marca selecionada
            fetch(`https://parallelum.com.br/fipe/api/v1/${tipoCodigo}/marcas`)
                .then(response => response.json())
                .then(marcasFipe => {
                    const marcaFipe = marcasFipe.find(marca => marca.nome.toLowerCase() === fipeMarcaNome.toLowerCase());

                    if (marcaFipe) {
                        // Busca os modelos da marca selecionada para obter o código correto do modelo
                        fetch(`https://parallelum.com.br/fipe/api/v1/${tipoCodigo}/marcas/${marcaFipe.codigo}/modelos`)
                            .then(response => response.json())
                            .then(modelosData => {
                                const modeloFipe = modelosData.modelos.find(modelo => modelo.nome.toLowerCase() === modeloNome.toLowerCase());

                                if (modeloFipe) {
                                    // Busca os anos disponíveis para o modelo na API da FIPE
                                    fetch(`https://parallelum.com.br/fipe/api/v1/${tipoCodigo}/marcas/${marcaFipe.codigo}/modelos/${modeloFipe.codigo}/anos`)
                                        .then(response => response.json())
                                        .then(anos => {
                                            anos.forEach(ano => {
                                                let option = document.createElement('option');
                                                option.value = ano.codigo;
                                                option.text = ano.nome;
                                                anoSelect.appendChild(option);
                                            });
                                            anoSelect.disabled = false;
                                        })
                                        .catch(error => console.error('Erro ao carregar anos:', error));
                                } else {
                                    console.error('Modelo não encontrado na FIPE:', modeloNome);
                                }
                            })
                            .catch(error => console.error('Erro ao carregar modelos da FIPE:', error));
                    } else {
                        console.error('Marca não encontrada na FIPE:', fipeMarcaNome);
                    }
                })
                .catch(error => console.error('Erro ao carregar marcas da FIPE:', error));
        }
    });
});
