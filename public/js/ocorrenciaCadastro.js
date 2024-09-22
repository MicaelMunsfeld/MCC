// Função para bloquear a interface principal
function bloquearInterface() {
    document.getElementById('overlay').style.display = 'block'; // Exibe a sobreposição
    document.body.classList.add('no-click'); // Desabilita os cliques no restante da página
}

// Função para desbloquear a interface
function desbloquearInterface() {
    document.getElementById('overlay').style.display = 'none'; // Oculta a sobreposição
    document.body.classList.remove('no-click'); // Habilita novamente os cliques
}

document.addEventListener('DOMContentLoaded', function () {
    const selecionarVeiculoBtn = document.getElementById('selecionarVeiculoBtn');
    const veiculoNomeInput = document.getElementById('veiculo_info');
    const veiculoIdInput = document.getElementById('ID_veiculo');

    // Abrir a janela modal de seleção de veículo
    selecionarVeiculoBtn.addEventListener('click', function () {
        const url = '?page=veiculoListModal'; // URL da página para selecionar o veículo
        const width = window.screen.width;
        const height = window.screen.height;
        window.open(url, 'Selecionar Veículo', `width=${width},height=${height},fullscreen=yes`); // Abre a lista de veículos em tela cheia
        bloquearInterface(); // Bloqueia a interface principal
    });

    // Função para preencher o campo após a seleção do veículo
    window.addEventListener('message', function (event) {
        if (event.data && event.data.veiculoId && event.data.veiculoNome) {
            veiculoNomeInput.value = event.data.veiculoNome; // Nome do veículo
            veiculoIdInput.value = event.data.veiculoId; // ID do veículo
            desbloquearInterface(); // Desbloqueia a interface principal
        }
    });

    // Desbloqueia a interface se a janela modal for fechada manualmente
    window.addEventListener('focus', function () {
        desbloquearInterface();
    });

    // Funções da API do IBGE para preencher estados e cidades...
    const estadoSelect = document.getElementById('estado');
    const cidadeSelect = document.getElementById('cidade');

    // Valor inicial do estado e cidade da ocorrência
    const estadoSelecionado = estadoSelect.getAttribute('data-selected');  // Valor pré-selecionado do estado
    const cidadeSelecionada = cidadeSelect.getAttribute('data-selected');  // Valor pré-selecionado da cidade

    // Função para buscar estados da API do IBGE
    fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
        .then(response => response.json())
        .then(estados => {
            estados.sort((a, b) => a.nome.localeCompare(b.nome)); // Ordena estados por nome
            estados.forEach(estado => {
                let option = document.createElement('option');
                option.value = estado.id; // Agora o value é o número do estado
                option.text = estado.nome;
                if (estado.id === parseInt(estadoSelecionado)) {
                    option.selected = true; // Marca o estado pré-selecionado
                }
                estadoSelect.appendChild(option);
            });

            // Carregar as cidades do estado pré-selecionado
            if (estadoSelecionado) {
                carregarCidades(estadoSelecionado, cidadeSelecionada);
            }
        })
        .catch(error => console.error('Erro ao carregar estados:', error));

    // Função para carregar cidades ao selecionar um estado
    estadoSelect.addEventListener('change', function () {
        const estadoId = estadoSelect.value; // Usando o valor numérico do estado
        cidadeSelect.innerHTML = '<option value="">Selecione a Cidade</option>'; // Limpar cidades

        if (estadoId) {
            carregarCidades(estadoId, null); // Chama a função para carregar as cidades
        }
    });

    // Função para carregar cidades a partir da API do IBGE
    function carregarCidades(estadoId, cidadeSelecionada = null) {
        fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoId}/municipios`)
            .then(response => response.json())
            .then(cidades => {
                cidades.sort((a, b) => a.nome.localeCompare(b.nome)); // Ordenar cidades por nome
                cidades.forEach(cidade => {
                    let option = document.createElement('option');
                    option.value = cidade.nome; // Cidade é armazenada pelo nome
                    option.text = cidade.nome;
                    if (cidade.nome === cidadeSelecionada) {
                        option.selected = true; // Marca a cidade pré-selecionada
                    }
                    cidadeSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erro ao carregar cidades:', error));
    }
});
