// marcaCadastro.js

document.addEventListener('DOMContentLoaded', function () {
    // Lista dos tipos de veículos para preencher o select
    const tipos = [
        { codigo: 'carros', nome: 'Carros' },
        { codigo: 'motos', nome: 'Motos' },
        { codigo: 'caminhoes', nome: 'Caminhões' }
    ];

    // Seleciona os campos de tipo e marca
    const tipoSelect = document.getElementById('tipo');
    const marcaSelect = document.getElementById('nome_marca');

    // Populando o select de tipos de veículos
    tipos.forEach(tipo => {
        let option = document.createElement('option');
        option.value = tipo.codigo;
        option.text = tipo.nome;
        tipoSelect.appendChild(option);
    });

    // Seleciona o tipo de veículo previamente salvo na tela de edição (se existir)
    const tipoSelecionado = tipoSelect.getAttribute('data-selecionado');
    if (tipoSelecionado) {
        tipoSelect.value = tipoSelecionado;
    }

    // Atualiza as marcas ao selecionar um tipo de veículo
    tipoSelect.addEventListener('change', function () {
        const tipoCodigo = this.value;
        marcaSelect.innerHTML = '<option value="">Selecione a Marca</option>';

        if (tipoCodigo) {
            // Fetch das marcas baseado no tipo de veículo selecionado
            fetch(`https://parallelum.com.br/fipe/api/v1/${tipoCodigo}/marcas`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(marca => {
                        let option = document.createElement('option');
                        option.value = marca.nome;
                        option.text = marca.nome;
                        marcaSelect.appendChild(option);
                    });

                    // Seleciona a marca previamente salva na tela de edição (se existir)
                    const marcaSelecionada = marcaSelect.getAttribute('data-selecionado');
                    if (marcaSelecionada) {
                        marcaSelect.value = marcaSelecionada;
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar marcas:', error);
                });
        }
    });

    // Dispara o evento 'change' para carregar as marcas do tipo selecionado inicialmente na edição
    if (tipoSelecionado) {
        tipoSelect.dispatchEvent(new Event('change'));
    }
});
