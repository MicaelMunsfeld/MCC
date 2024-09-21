<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
    <h2><?= isset($cor) ? 'Alterar Cor' : 'Cadastrar Cor'; ?></h2>
    
    <form action="?page=cor&action=<?= isset($cor) ? 'atualizar' : 'salvar'; ?>" method="POST">
        <fieldset class="p-4 border rounded">
            <legend class="fw-bold text-primary"><?= isset($cor) ? 'Editar Cor' : 'Nova Cor'; ?></legend>
            <div class="mb-3">
                <label for="nome_cor" class="form-label">Nome da Cor</label>
                <input type="text" class="form-control" id="nome_cor" name="nome_cor" value="<?= isset($cor) ? htmlspecialchars($cor['nome_cor']) : ''; ?>" required>
            </div>
        </fieldset>

        <?php if (isset($cor)): ?>
            <input type="hidden" name="id_cor" value="<?= $cor['ID_cor']; ?>">
        <?php endif; ?>

        <div class="d-flex mt-3">
            <button type="submit" class="btn btn-primary w-50 me-2"><?= isset($cor) ? 'Atualizar' : 'Cadastrar'; ?></button>
            <a href="?page=cor" class="btn btn-secondary w-50">Cancelar</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
