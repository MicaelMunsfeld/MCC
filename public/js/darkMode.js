document.addEventListener('DOMContentLoaded', function() {
    const toggleDarkMode = document.getElementById('toggle-dark-mode');

    // Verifica se o modo noturno está ativado no localStorage
    if (localStorage.getItem('darkMode') === 'enabled') {
        enableDarkMode();
    }

    // Função para habilitar o modo noturno
    function enableDarkMode() {
        document.body.classList.add('dark-mode');
        document.querySelector('.sidebar').classList.add('dark-mode');
        localStorage.setItem('darkMode', 'enabled'); // Salva o estado no localStorage
        toggleDarkMode.textContent = 'Modo Claro';
    }

    // Função para desabilitar o modo noturno
    function disableDarkMode() {
        document.body.classList.remove('dark-mode');
        document.querySelector('.sidebar').classList.remove('dark-mode');
        localStorage.setItem('darkMode', 'disabled'); // Salva o estado no localStorage
        toggleDarkMode.textContent = 'Modo Noturno';
    }

    // Alterna o modo entre claro e escuro
    toggleDarkMode.addEventListener('click', function(event) {
        event.preventDefault();
        if (localStorage.getItem('darkMode') === 'enabled') {
            disableDarkMode();
        } else {
            enableDarkMode();
        }
    });
});
