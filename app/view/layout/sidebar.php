<?php
// Verifica se o dispositivo é mobile
require_once $_SERVER['DOCUMENT_ROOT'] . '/MCC/public/dispositivoMovel.php';

// Captura a página atual da URL
$current_page = $_GET['page'] ?? 'inicio'; // Define 'inicio' como padrão se 'page' não estiver definido
?>

<?php if (isMobile()) : ?>
    <!-- Navbar offcanvas para mobile (col-md para baixo) -->
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="?page=inicio">MCC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">MCC</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="?page=inicio" class="nav-link <?php echo ($current_page == 'inicio') ? 'active' : ''; ?>">Página Inicial</a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=veiculoList" class="nav-link <?php echo ($current_page == 'veiculoList') ? 'active' : ''; ?>">Veículos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'marca') ? 'active' : ''; ?>" href="?page=marca">Marca</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'modelo') ? 'active' : ''; ?>" href="?page=modelo">Modelos</a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'cor') ? 'active' : ''; ?>" href="?page=cor">Cores</a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=ocorrencia" class="nav-link <?php echo ($current_page == 'ocorrencia') ? 'active' : ''; ?>">Ocorrências</a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=usuarioList" class="nav-link <?php echo ($current_page == 'usuarioList') ? 'active' : ''; ?>">Usuários</a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=movimentacao" class="nav-link <?php echo ($current_page == 'movimentacao') ? 'active' : ''; ?>">Movimentações</a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=sobreEmpresa" class="nav-link <?php echo ($current_page == 'sobreEmpresa') ? 'active' : ''; ?>">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=contatos" class="nav-link <?php echo ($current_page == 'contatos') ? 'active' : ''; ?>">Contato</a>
                        </li>
                    </ul>
                    <div class="dropdown mt-3">
                        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong>Usuário</strong>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="?page=home">Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <style>
        body {
            padding-top: 56px; /* Para evitar que o conteúdo fique por baixo da navbar */
        }
    </style>

<?php else : ?>
    <!-- Sidebar fixa para desktop (somente em telas maiores que col-md) -->
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px; height: 100vh; position: fixed;">
        <a href="?page=inicio" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <strong><span class="fs-4">MCC</span></strong>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="?page=inicio" class="nav-link <?php echo ($current_page == 'inicio') ? 'active' : ''; ?>">Página Inicial</a>
            </li>
            <li>
                <a href="?page=veiculoList" class="nav-link <?php echo ($current_page == 'veiculoList') ? 'active' : ''; ?>">Veículos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'marca') ? 'active' : ''; ?>" href="?page=marca">Marca</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'modelo') ? 'active' : ''; ?>" href="?page=modelo">Modelos</a> 
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'cor') ? 'active' : ''; ?>" href="?page=cor">Cores</a>
            </li>
            <li>
                <a href="?page=ocorrencia" class="nav-link link-dark <?php echo ($current_page == 'ocorrencia') ? 'active' : ''; ?>">Ocorrências</a>
            </li>
            <li>
                <a href="?page=usuarioList" class="nav-link link-dark <?php echo ($current_page == 'usuarioList') ? 'active' : ''; ?>">Usuários</a>
            </li>
            <li>
                <a href="?page=movimentacao" class="nav-link link-dark <?php echo ($current_page == 'movimentacao') ? 'active' : ''; ?>">Movimentações</a>
            </li>
            <li>
                <a href="?page=sobreEmpresa" class="nav-link link-dark <?php echo ($current_page == 'sobreEmpresa') ? 'active' : ''; ?>">Sobre</a>
            </li>
            <li>
                <a href="?page=contatos" class="nav-link link-dark <?php echo ($current_page == 'contatos') ? 'active' : ''; ?>">Contato</a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>Usuário</strong>
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                <li><a class="dropdown-item" href="?page=home">Sair</a></li>
            </ul>
        </div>
    </div>
<?php endif; ?>
