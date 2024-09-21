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

    // Abrir a janela modal de seleção de veículo em tela cheia
    selecionarVeiculoBtn.addEventListener('click', function () {
        const url = '?page=veiculoList&modal=true'; // URL da página para selecionar o veículo no modo modal
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
});