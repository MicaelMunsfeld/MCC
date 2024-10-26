<?php
// Inclua o header
include __DIR__ . '/../site/header.php';
?>
<link href="/MCC/public/css/style.css" rel="stylesheet">

<div class="container mt-5 mb-5">
    <h1 class="mb-4">Veículos Disponíveis</h1>

    <!-- Filtros -->
    <form method="POST" action="?page=veiculos" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="marca" class="form-label">Marca</label>
                <select id="marca" name="marca" class="form-control">
                    <option value="">Todas</option>
                    <!-- Marcas dinâmicas -->
                    <?php foreach ($marcas as $marca): ?>
                        <option value="<?= $marca['ID_marca']; ?>" <?= isset($_GET['marca']) && $_GET['marca'] == $marca['ID_marca'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($marca['nome_marca']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="modelo" class="form-label">Modelo</label>
                <select id="modelo" name="modelo" class="form-control">
                    <option value="">Todos</option>
                    <!-- Modelos dinâmicos -->
                    <?php foreach ($modelos as $modelo): ?>
                        <option value="<?= $modelo['ID_modelo']; ?>" <?= isset($_GET['modelo']) && $_GET['modelo'] == $modelo['ID_modelo'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($modelo['nome_modelo']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label for="ano" class="form-label">Ano</label>
                <input type="number" id="ano" name="ano" class="form-control" placeholder="Ano" value="<?= isset($_GET['ano']) ? htmlspecialchars($_GET['ano']) : ''; ?>">
            </div>
            <div class="col-md-2">
                <label for="preco_min" class="form-label">Preço Mínimo</label>
                <input type="text" id="preco_min" name="preco_min" class="form-control" placeholder="R$ Mínimo" value="<?= isset($_GET['preco_min']) ? htmlspecialchars($_GET['preco_min']) : ''; ?>">
            </div>
            <div class="col-md-2">
                <label for="preco_max" class="form-label">Preço Máximo</label>
                <input type="text" id="preco_max" name="preco_max" class="form-control" placeholder="R$ Máximo" value="<?= isset($_GET['preco_max']) ? htmlspecialchars($_GET['preco_max']) : ''; ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
    </form>

    <!-- Listagem de veículos -->
    <div class="row">
        <?php if (!empty($veiculos)): ?>
            <?php foreach ($veiculos as $veiculo): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php
                        // Verificar se a imagem está armazenada como binário
                        if (!empty($veiculo['imagem'])) {
                            // Converte a imagem binária para base64
                            $imageData = stream_get_contents($veiculo['imagem']);
                            $imageSrc = 'data:image/jpeg;base64,' . base64_encode($imageData);
                        } else {
                            // Caminho para uma imagem padrão (placeholder) caso não haja imagem
                            $imageSrc = '/MCC/public/images/placeholder-car.jpg';
                        }
                        ?>
                        <img src="<?= $imageSrc ?>" class="card-img-top" alt="Imagem do veículo">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($veiculo['marca']) . ' ' . htmlspecialchars($veiculo['modelo']); ?></h5>
                            <p class="card-text">
                                <strong>Ano:</strong> <?= htmlspecialchars($veiculo['ano']); ?><br>
                                <strong>Quilometragem:</strong> <?= number_format($veiculo['quilometragem'], 0, ',', '.'); ?> km<br>
                                <strong>Preço:</strong> R$ <?= number_format($veiculo['valor'], 2, ',', '.'); ?><br>
                                <strong>Câmbio:</strong> <?= htmlspecialchars($veiculo['cambio']); ?><br>
                                <strong>Combustível:</strong> <?= htmlspecialchars($veiculo['combustivel']); ?>
                            </p>
                            <a href="?page=veiculoDetalhamento&id=<?= $veiculo['ID_veiculo']; ?>" class="btn btn-primary">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Nenhum veículo encontrado.</p>
        <?php endif; ?>
    </div>

    <!-- Paginação -->
    <?php if ($totalPages > 1): ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <?php if ($paginaAtual > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $paginaAtual - 1; ?>">Anterior</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $paginaAtual ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($paginaAtual < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $paginaAtual + 1; ?>">Próximo</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<?php
// Inclua o footer
include __DIR__ . '/../site/footer.php';
?>
