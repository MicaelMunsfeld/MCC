<!-- modeloList.php -->
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="main-content">
    <div class="container">
        <h1>Lista de Modelos</h1>
        <a href="?page=modelo&action=incluir" class="btn btn-success mb-3">Incluir Modelo</a>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome do Modelo</th>
                    <th>Marca</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($modelos)): ?>
                    <?php foreach ($modelos as $modelo): ?>
                        <tr>
                            <td><?= htmlspecialchars($modelo['nome_modelo']); ?></td>
                            <td><?= htmlspecialchars($modelo['nome_marca']); ?></td>
                            <td class="d-flex gap-2">
                                <a href="?page=modelo&action=alterar&id=<?= $modelo['ID_modelo']; ?>" class="btn btn-warning btn-sm">Alterar</a>
                                <a href="?page=modelo&action=excluir&id=<?= $modelo['ID_modelo']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este modelo?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Nenhum modelo encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
