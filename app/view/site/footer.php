<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MCC/public/dispositivoMovel.php';
?>

<?php
if (isMobile()) {
    echo '
    <footer class="bg-light text-center text-lg-start mt-4">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">MCC - Munsfeld Car Control</h5>
                    <p>Gerencie seu inventário de veículos de forma eficiente e rápida.</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Links Úteis</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="/" class="text-dark">Página Inicial</a></li>
                        <li><a href="/veiculos.php" class="text-dark">Veículos</a></li>
                        <li><a href="/sobre.php" class="text-dark">Sobre</a></li>
                        <li><a href="/contato.php" class="text-dark">Contato</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3 bg-dark text-white">
            © 2024 MCC - Munsfeld Car Control
        </div>
    </footer>
    ';
} else {
    echo '
    <div class="container-fluid">
        <footer>
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="?page=home" class="nav-link px-2 text-body-secondary">Página Inicial</a></li>
                <li class="nav-item"><a href="?page=sobre" class="nav-link px-2 text-body-secondary">Sobre</a></li>
                <li class="nav-item"><a href="?page=veiculos" class="nav-link px-2 text-body-secondary">Veículos</a></li>
                <li class="nav-item"><a href="?page=contato" class="nav-link px-2 text-body-secondary">Contato</a></li>
                <li class="nav-item"><a href="?page=politicaPrivacidade" class="nav-link px-2 text-body-secondary">Política de privacidade</a></li>
            </ul>
            <p class="text-center text-body-secondary">&copy; 2024 Sálvio Automóveis</p>
        </footer>
    </div>
    ';
}
?>
<a href="https://wa.me/5547984111411?text=Olá,%20tenho%20interesse%20em%20mais%20informações." target="_blank" class="whatsapp-link">
    <img src="/MCC/uploads/WhatsAppIcon.png" alt="WhatsApp" style="width:40px;height:40px;">
</a>
<script>
setTimeout(function() {
    let alert = document.querySelector('.alert');
    if (alert) {
        alert.classList.remove('show');
        alert.classList.add('fade');
    }
}, 3000);
</script>
