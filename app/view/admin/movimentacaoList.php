<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
    <h2>Lista de Movimentações</h2>
    <a href="?page=movimentacao&action=incluir" class="btn btn-success mb-3">Registrar Movimentação</a>
    <table class="table table-hover">
    <thead>
        <tr>
            <th>Data/Hora</th>
            <th>Tipo</th>
            <th>Veículo</th>
            <th>Usuário</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($movimentacoes)): ?>
            <?php foreach ($movimentacoes as $movimentacao): ?>
                <tr>
                    <td><?= htmlspecialchars($movimentacao['data_hora']); ?></td>
                    <td><?= htmlspecialchars($movimentacao['tipo']); ?></td>
                    <td><?= htmlspecialchars($movimentacao['nome_veiculo']); ?></td>
                    <td><?= htmlspecialchars($movimentacao['nome']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">Nenhuma movimentação encontrada.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
