<div class="container mt-4">
    <h2 class="mb-4">Selecione o Veículo</h2>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th class="d-none d-md-table-cell">Marca</th> <!-- Oculto no mobile -->
                    <th>Modelo</th>
                    <th class="d-none d-md-table-cell">Ano</th> <!-- Oculto no mobile -->
                    <th class="d-none d-md-table-cell">Placa</th> <!-- Oculto no mobile -->
                    <th class="d-none d-md-table-cell">Valor</th> <!-- Oculto no mobile -->
                    <th>Ações</th> <!-- Visível sempre -->
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
                            <td class="d-none d-md-table-cell"><?= htmlspecialchars($veiculo['marca']); ?></td> <!-- Oculto no mobile -->
                            <td><?= htmlspecialchars($veiculo['modelo']); ?></td>
                            <td class="d-none d-md-table-cell"><?= htmlspecialchars($veiculo['ano']); ?></td> <!-- Oculto no mobile -->
                            <td class="d-none d-md-table-cell"><?= htmlspecialchars($veiculo['placa']); ?></td> <!-- Oculto no mobile -->
                            <td class="d-none d-md-table-cell">R$ <?= number_format($veiculo['valor'], 2, ',', '.'); ?></td> <!-- Oculto no mobile -->
                            <td>
                                <button 
                                    class="btn btn-primary btn-sm select-vehicle"
                                    data-id="<?= htmlspecialchars($veiculo['ID_veiculo']); ?>" 
                                    data-modelo="<?= htmlspecialchars($veiculo['modelo']); ?>" 
                                    data-marca="<?= htmlspecialchars($veiculo['marca']); ?>" 
                                    data-placa="<?= htmlspecialchars($veiculo['placa']); ?>">
                                    Selecionar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum veículo encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Função para adicionar eventos de clique aos botões de seleção
    document.querySelectorAll('.select-vehicle').forEach(function(button) {
        button.addEventListener('click', function() {
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
