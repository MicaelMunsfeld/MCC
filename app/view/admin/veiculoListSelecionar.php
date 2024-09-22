<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
    <h2>Selecionar Veículo</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Ano</th>
                <th>Placa</th>
                <th>Valor</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($veiculos as $veiculo): ?>
                <tr>
                    <td><?= htmlspecialchars($veiculo['nome_marca']); ?></td>
                    <td><?= htmlspecialchars($veiculo['nome_modelo']); ?></td>
                    <td><?= htmlspecialchars($veiculo['ano']); ?></td>
                    <td><?= htmlspecialchars($veiculo['placa']); ?></td>
                    <td>R$ <?= number_format($veiculo['valor'], 2, ',', '.'); ?></td>
                    <td>
                        <a href="?page=movimentacao&action=veiculoSelecionado&id=<?= $veiculo['ID_veiculo']; ?>" class="btn btn-primary btn-sm">Selecionar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
