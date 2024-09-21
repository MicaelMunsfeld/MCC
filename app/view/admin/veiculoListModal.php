<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">Selecione o Veículo</h2>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Ano</th>
                <th>Placa</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($veiculos)): ?>
                <?php foreach ($veiculos as $veiculo): ?>
                    <tr class="vehicle-row" 
                        data-id="<?= htmlspecialchars($veiculo['ID_veiculo']); ?>" 
                        data-modelo="<?= htmlspecialchars($veiculo['modelo']); ?>" 
                        data-marca="<?= htmlspecialchars($veiculo['marca']); ?>" 
                        data-placa="<?= htmlspecialchars($veiculo['placa']); ?>">
                        <td><?= htmlspecialchars($veiculo['marca']); ?></td>
                        <td><?= htmlspecialchars($veiculo['modelo']); ?></td>
                        <td><?= htmlspecialchars($veiculo['ano']); ?></td>
                        <td><?= htmlspecialchars($veiculo['placa']); ?></td>
                        <td>R$ <?= number_format($veiculo['valor'], 2, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Nenhum veículo encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    // Função para adicionar eventos de clique às linhas da tabela
    document.querySelectorAll('.vehicle-row').forEach(function(row) {
        row.addEventListener('click', function() {
            const vehicleId = this.dataset.id;
            const vehicleModelo = this.dataset.modelo;
            const vehicleMarca = this.dataset.marca;
            const vehiclePlaca = this.dataset.placa;
            
            // Passando os dados do veículo para os campos no formulário original
            window.opener.document.getElementById('ID_veiculo').value = vehicleId;
            window.opener.document.getElementById('veiculo_info').value = vehicleMarca + ' ' + vehicleModelo + ' - ' + vehiclePlaca;

            // Fecha a janela modal após a seleção
            window.close();
        });
    });
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
