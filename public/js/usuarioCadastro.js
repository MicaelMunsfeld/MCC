// Função para carregar estados usando a API do IBGE
document.addEventListener('DOMContentLoaded', function () {
    const estadoSelect = document.getElementById('estado');
    const cidadeSelect = document.getElementById('cidade');
    const estadoAtual = estadoSelect ? estadoSelect.dataset.selected : ''; // Captura o estado selecionado (ID)
    const cidadeAtual = cidadeSelect ? cidadeSelect.dataset.selected : ''; // Captura a cidade selecionada (nome)

    // Carrega os estados ao carregar a página
    fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome')
        .then(response => response.json())
        .then(estados => {
            if (estadoSelect) {
                estados.forEach(estado => {
                    let option = document.createElement('option');
                    option.value = estado.id;
                    option.text = estado.nome;
                    // Seleciona o estado atual se estiver definido
                    if (estado.id == estadoAtual) {
                        option.selected = true;
                        carregarCidades(estado.id, cidadeAtual); // Carrega as cidades para o estado selecionado
                    }
                    estadoSelect.appendChild(option);
                });
            }
        })
        .catch(error => console.error('Erro ao carregar os estados:', error));

    // Carrega as cidades ao selecionar um estado
    if (estadoSelect) {
        estadoSelect.addEventListener('change', function () {
            carregarCidades(this.value);
        });
    }

    // Função para carregar cidades com base no estado selecionado
    function carregarCidades(estadoId, cidadeSelecionada = '') {
        cidadeSelect.innerHTML = '<option value="">Selecione a Cidade</option>';

        if (estadoId) {
            fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoId}/municipios`)
                .then(response => response.json())
                .then(cidades => {
                    cidades.forEach(cidade => {
                        let option = document.createElement('option');
                        option.value = cidade.nome;
                        option.text = cidade.nome;
                        // Seleciona a cidade atual se estiver definida
                        if (cidade.nome === cidadeSelecionada) {
                            option.selected = true;
                        }
                        cidadeSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erro ao carregar as cidades:', error));
        }
    }

    // Funções para os botões de ação na listagem de usuários
    const btnAlterar = document.getElementById('btnAlterar');
    const btnExcluir = document.getElementById('btnExcluir');
    const btnLogin = document.getElementById('btnLogin');
    const radios = document.querySelectorAll('input[name="selectUser"]');

    // Ativa os botões de ação somente quando um registro é selecionado
    radios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (btnAlterar && btnExcluir && btnLogin) {
                btnAlterar.disabled = false;
                btnExcluir.disabled = false;
                btnLogin.disabled = false;
            }
        });
    });

    // Ação para o botão Alterar
    if (btnAlterar) {
        btnAlterar.addEventListener('click', function () {
            const selectedUser = document.querySelector('input[name="selectUser"]:checked');
            if (selectedUser) {
                window.location.href = `?page=usuario&action=alterar&id=${selectedUser.value}`;
            }
        });
    }

    // Ação para o botão Excluir
    if (btnExcluir) {
        btnExcluir.addEventListener('click', function () {
            const selectedUser = document.querySelector('input[name="selectUser"]:checked');
            if (selectedUser) {
                if (confirm('Tem certeza que deseja excluir este usuário?')) {
                    window.location.href = `?page=usuario&action=excluir&id=${selectedUser.value}`;
                }
            }
        });
    }

    // Ação para o botão Login
    if (btnLogin) {
        btnLogin.addEventListener('click', function () {
            const selectedUser = document.querySelector('input[name="selectUser"]:checked');
            if (selectedUser) {
                window.location.href = `?page=usuarioSistema&action=cadastro&id=${selectedUser.value}`;
            }
        });
    }
});
