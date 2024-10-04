<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5 mb-5">
    <h2 class="mb-4">Veículos Disponíveis</h2>
    
    <div class="row">
        <?php if (!empty($veiculos)): ?>
            <?php foreach ($veiculos as $veiculo): ?>
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 18rem;">
                        <?php if (!empty($veiculo['imagem'])): ?>
                            <?php
                            // Caso a imagem seja um recurso, converta para string
                            $imageData = stream_get_contents($veiculo['imagem']);
                            ?>
                            <!-- Exibe a imagem do veículo -->
                            <img src="data:image/jpeg;base64,<?= base64_encode($imageData); ?>" class="card-img-top" alt="Imagem do Veículo">
                        <?php else: ?>
                            <!-- Placeholder caso o veículo não tenha imagem -->
                            <img src="/MCC/public/images/placeholder-car.jpg" class="card-img-top" alt="Sem Imagem">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($veiculo['marca']) . ' ' . htmlspecialchars($veiculo['modelo']); ?></h5>
                            <p class="card-text">
                                <strong>Ano:</strong> <?= htmlspecialchars($veiculo['ano']); ?><br>
                                <strong>Quilometragem:</strong> <?= number_format($veiculo['quilometragem'], 0, ',', '.'); ?> km<br>
                                <strong>Valor:</strong> R$ <?= number_format($veiculo['valor'], 2, ',', '.'); ?><br>
                                <strong>Câmbio:</strong> <?= htmlspecialchars($veiculo['cambio']); ?><br>
                                <strong>Combustível:</strong> <?= htmlspecialchars($veiculo['combustivel']); ?>
                            </p>
                            <a href="?page=veiculoDetalhes&id=<?= $veiculo['ID_veiculo']; ?>" class="btn btn-primary">Mais detalhes</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-center">Nenhum veículo disponível no momento.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
