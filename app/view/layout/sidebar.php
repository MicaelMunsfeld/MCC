<?php
// Captura a página atual da URL
$current_page = $_GET['page'] ?? 'inicio'; // Define 'inicio' como padrão se 'page' não estiver definido
?>

<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px; height: 100vh; position: fixed;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <strong><span class="fs-4">MCC</span></strong>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="?page=inicio" class="nav-link <?php echo ($current_page == 'inicio') ? 'active' : ''; ?>" aria-current="page">
                Página Inicial
            </a>
        </li>
        <li>
            <a href="?page=veiculoList" class="nav-link <?php echo ($current_page == 'veiculoList') ? 'active' : ''; ?>">
                Veículos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'marca') ? 'active' : ''; ?>" href="?page=marca">
                <i class="fas fa-tags"></i> Marca
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'modelo') ? 'active' : ''; ?>" href="?page=modelo">Modelos</a> 
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'cor') ? 'active' : ''; ?>" href="?page=cor">Cores</a>
        </li>
        <li>
            <a href="?page=ocorrencia" class="nav-link link-dark <?php echo ($current_page == 'ocorrencia') ? 'active' : ''; ?>">
                Ocorrências
            </a>
        </li>
        <li>
            <!-- Ajuste o link para redirecionar para a página correta de usuários -->
            <a href="?page=usuarioList" class="nav-link link-dark <?php echo ($current_page == 'usuarioList') ? 'active' : ''; ?>">
                Usuários
            </a>
        </li>
        <li>
            <a href="?page=movimentacao" class="nav-link link-dark <?php echo ($current_page == 'movimentacao') ? 'active' : ''; ?>">
                Movimentações
            </a>
        </li>
        <li>
            <a href="?page=sobreEmpresa" class="nav-link link-dark <?php echo ($current_page == 'sobreEmpresa') ? 'active' : ''; ?>">
                Sobre
            </a>
        </li>
        <li>
            <a href="?page=contatos" class="nav-link link-dark <?php echo ($current_page == 'contatos') ? 'active' : ''; ?>">
                Contato
            </a>
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
