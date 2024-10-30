<?php
// Captura a página atual da URL
$current_page = $_GET['page'] ?? 'inicio'; // Define 'inicio' como padrão se 'page' não estiver definido

include $_SERVER['DOCUMENT_ROOT'] . '/MCC/public/dispositivoMovel.php';
?>

<?php if (isMobile()): ?>
    <!-- Navbar Offcanvas para Mobile -->
    <nav class="navbar bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MCC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'inicio') ? 'active' : ''; ?>" href="?page=inicio">Página Inicial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'veiculoList') ? 'active' : ''; ?>" href="?page=veiculoList">Veículos</a>
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
                            <a class="nav-link <?php echo ($current_page == 'ocorrencia') ? 'active' : ''; ?>" href="?page=ocorrencia">Ocorrências</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'usuarioList') ? 'active' : ''; ?>" href="?page=usuarioList">Usuários</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'movimentacao') ? 'active' : ''; ?>" href="?page=movimentacao">Movimentações</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'sobreEmpresa') ? 'active' : ''; ?>" href="?page=sobreEmpresa">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'contatos') ? 'active' : ''; ?>" href="?page=contatos">Contato</a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUserMobile" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong>Usuário</strong>
                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUserMobile">
                            <li><a class="dropdown-item" href="?page=home">Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

<?php else: ?>
    <!-- Sidebar para Desktop -->
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px; height: 100vh; position: fixed;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <strong><span class="fs-4">MCC</span></strong>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="?page=inicio" class="nav-link <?php echo ($current_page == 'inicio') ? 'active' : ''; ?>" aria-current="page">Página Inicial</a>
            </li>
            <li>
                <a href="?page=veiculoList" class="nav-link <?php echo ($current_page == 'veiculoList') ? 'active' : ''; ?>">Veículo</a>
            </li>
            <li class="nav-item">
                <a href="?page=marca" class="nav-link <?php echo ($current_page == 'marca') ? 'active' : ''; ?>">Marca</a>
            </li>
            <li class="nav-item">
                <a href="?page=modelo" class="nav-link <?php echo ($current_page == 'modelo') ? 'active' : ''; ?>">Modelo</a>
            </li>
            <li class="nav-item">
                <a href="?page=cor" class="nav-link <?php echo ($current_page == 'cor') ? 'active' : ''; ?>">Cor</a>
            </li>
            <li>
                <a href="?page=ocorrencia" class="nav-link <?php echo ($current_page == 'ocorrencia') ? 'active' : ''; ?>">Ocorrência</a>
            </li>
            <li>
                <a href="?page=usuarioList" class="nav-link <?php echo ($current_page == 'usuarioList') ? 'active' : ''; ?>">Usuário</a>
            </li>
            <li>
                <a href="?page=movimentacao" class="nav-link <?php echo ($current_page == 'movimentacao') ? 'active' : ''; ?>">Movimentação</a>
            </li>
            <li>
                <a href="?page=sobreEmpresa" class="nav-link <?php echo ($current_page == 'sobreEmpresa') ? 'active' : ''; ?>">Sobre</a>
            </li>
            <li>
                <a href="?page=contatos" class="nav-link <?php echo ($current_page == 'contatos') ? 'active' : ''; ?>">Contato</a>
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
