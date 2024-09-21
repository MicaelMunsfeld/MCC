<?php include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Configurar Acesso do Usuário ao Sistema</h2>
    <form action="?page=usuarioSistema&action=salvar" method="POST">
        <input type="hidden" name="ID_usuario" value="<?= htmlspecialchars($_GET['id']) ?>">
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Salvar Acesso</button>
    </form>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/footer.php'; ?>
