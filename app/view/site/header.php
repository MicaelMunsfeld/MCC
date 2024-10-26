<?php
// Captura a página atual da URL
$current_page = $_GET['page'] ?? 'home'; // Define 'home' como padrão se 'page' não estiver definido
?>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link href="/MCC/public/css/style.css" rel="stylesheet">
<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            <!--<a href="?page=login" class="btn btn-outline-primary me-2">Login</a>-->
            <a href="#" class="btn btn-outline-primary me-2" data-toggle="modal" data-target="#loginModal">Login</a>
        </div>
    </header>
</div>
<!-- Modal de Login -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="index.php?page=login">
          <div class="form-group">
            <label for="nomeCompleto">Usuário</label>
            <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" required>
          </div>
          <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required minlength="5">
          </div>
          <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
