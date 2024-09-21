<!-- marcaList.php -->
<?php include __DIR__ . '/../layout/header.php'; ?> <!-- Inclui o cabeçalho padrão -->

<div class="main-content">
    <div class="container">
        <h1>Consulta de Marcas</h1>
        <a href="?page=marca&action=incluir" class="btn btn-success">Incluir Marca</a> <!-- Botão de inclusão -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Marca</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($marcas)): ?>
                    <?php foreach ($marcas as $marca): ?>
                        <tr>
                            <td><?= htmlspecialchars($marca['ID_marca']); ?></td>
                            <td><?= htmlspecialchars($marca['nome_marca']); ?></td>
                            <td>
                                <!-- Botão de Alterar -->
                                <a href="?page=marca&action=alterar&id=<?= $marca['ID_marca']; ?>" class="btn btn-warning btn-sm">Alterar</a>
                                <!-- Botão de Excluir -->
                                <a href="?page=marca&action=excluir&id=<?= $marca['ID_marca']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta marca?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Nenhuma marca encontrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?> <!-- Inclui o rodapé padrão -->
