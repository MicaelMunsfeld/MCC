<?php
// Captura a página atual da URL
$current_page = $_GET['page'] ?? 'home'; // Define 'home' como padrão se 'page' não estiver definido
?>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<div class="container-fluid">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="?page=home" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <strong><span class="fs-4">Sálvio Automóveis</span></strong>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="?page=home" class="nav-link px-2 <?php echo ($current_page == 'home') ? 'link-secondary active' : 'link-dark'; ?>">Página Inicial</a></li>
            <li><a href="?page=sobre" class="nav-link px-2 <?php echo ($current_page == 'sobre') ? 'link-secondary active' : 'link-dark'; ?>">Sobre</a></li>
            <li><a href="?page=veiculos" class="nav-link px-2 <?php echo ($current_page == 'veiculos') ? 'link-secondary active' : 'link-dark'; ?>">Veículos</a></li>
            <li><a href="?page=contato" class="nav-link px-2 <?php echo ($current_page == 'contato') ? 'link-secondary active' : 'link-dark'; ?>">Contato</a></li>
        </ul>

        <div class="col-md-3 text-end">
            <a href="?page=login" class="btn btn-outline-primary me-2">Login</a>
        </div>
    </header>
</div>
