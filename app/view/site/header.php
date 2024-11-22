<?php
// Inclui o arquivo de verificação de dispositivo móvel
include_once $_SERVER['DOCUMENT_ROOT'] . '/MCC/public/dispositivoMovel.php';

// Captura a página atual da URL
$current_page = $_GET['page'] ?? 'home'; // Define 'home' como padrão se 'page' não estiver definido
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCC - Munsfeld Car Control - Website</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="/MCC/public/css/style.css" rel="stylesheet">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MCC Website</a>

            <?php if (isMobile()): ?>
                <!-- Navbar Offcanvas para dispositivos móveis -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a href="?page=home" class="nav-link">Página Inicial</a></li>
                            <li class="nav-item"><a href="?page=veiculos" class="nav-link">Veículos</a></li>
                            <li class="nav-item"><a href="?page=sobre" class="nav-link">Sobre</a></li>
                            <li class="nav-item"><a href="?page=contato" class="nav-link">Contato</a></li>
                            <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <!-- Navbar padrão para dispositivos maiores -->
                <ul class="nav">
                    <li class="nav-item"><a href="?page=home" class="nav-link <?php echo ($current_page == 'home') ? 'active' : ''; ?>">Página Inicial</a></li>
                    <li class="nav-item"><a href="?page=veiculos" class="nav-link <?php echo ($current_page == 'veiculos') ? 'active' : ''; ?>">Veículos</a></li>
                    <li class="nav-item"><a href="?page=sobre" class="nav-link <?php echo ($current_page == 'sobre') ? 'active' : ''; ?>">Sobre</a></li>
                    <li class="nav-item"><a href="?page=contato" class="nav-link <?php echo ($current_page == 'contato') ? 'active' : ''; ?>">Contato</a></li>
                </ul>
                <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container-fluid" style="padding-top: 70px;">
        <!-- Conteúdo principal -->
    </div>

    <!-- Modal de Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="index.php?page=login">
                        <div class="form-group">
                            <label for="nomeCompleto">Usuário (Obrigatório)</label>
                            <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" required>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha (Obrigatório)</label>
                            <input type="password" class="form-control" id="senha" name="senha" required minlength="5">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
