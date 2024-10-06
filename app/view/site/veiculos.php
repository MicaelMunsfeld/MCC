<?php

include __DIR__ . '/../site/header.php';
require_once __DIR__ . '/../config/database.php'; 

// Filtros de pesquisa
$filtros = [];
$sql = "SELECT * FROM tbveiculo WHERE 1=1";

// Filtro por marca
if (!empty($_GET['marca'])) {
    $sql .= " AND marca = :marca";
    $filtros[':marca'] = $_GET['marca'];
}

// Filtro por modelo
if (!empty($_GET['modelo'])) {
    $sql .= " AND modelo LIKE :modelo";
    $filtros[':modelo'] = '%' . $_GET['modelo'] . '%';
}

// Filtro por ano
if (!empty($_GET['ano'])) {
    $sql .= " AND ano = :ano";
    $filtros[':ano'] = $_GET['ano'];
}

// Filtro por faixa de preço
if (!empty($_GET['preco_min']) && !empty($_GET['preco_max'])) {
    $sql .= " AND valor BETWEEN :preco_min AND :preco_max";
    $filtros[':preco_min'] = $_GET['preco_min'];
    $filtros[':preco_max'] = $_GET['preco_max'];
}

$stmt = $pdo->prepare($sql);
$stmt->execute($filtros);
$veiculos = $stmt->fetchAll();
?>

<div class="container mt-5 mb-5">
    <h1 class="mb-4">Veículos Disponíveis</h1>

    <!-- Filtros -->
    <form method="GET" action="veiculos.php" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="marca" class="form-label">Marca</label>
                <select id="marca" name="marca" class="form-control">
                    <option value="">Todas</option>
                    <option value="Toyota">Toyota</option>
                    <option value="Honda">Honda</option>
                    <option value="Ford">Ford</option>
                    <!-- Adicionar outras marcas -->
                </select>
            </div>
            <div class="col-md-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Modelo">
            </div>
            <div class="col-md-2">
                <label for="ano" class="form-label">Ano</label>
                <input type="number" id="ano" name="ano" class="form-control" placeholder="Ano">
            </div>
            <div class="col-md-2">
                <label for="preco_min" class="form-label">Preço Mínimo</label>
                <input type="number" id="preco_min" name="preco_min" class="form-control" placeholder="R$ Mínimo">
            </div>
            <div class="col-md-2">
                <label for="preco_max" class="form-label">Preço Máximo</label>
                <input type="number" id="preco_max" name="preco_max" class="form-control" placeholder="R$ Máximo">
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
                        <img src="/MCC/public/images/placeholder-car.jpg" class="card-img-top" alt="Imagem do veículo">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($veiculo['marca']) . ' ' . htmlspecialchars($veiculo['modelo']); ?></h5>
                            <p class="card-text">
                                <strong>Ano:</strong> <?= htmlspecialchars($veiculo['ano']); ?><br>
                                <strong>Quilometragem:</strong> <?= number_format($veiculo['quilometragem'], 0, ',', '.'); ?> km<br>
                                <strong>Preço:</strong> R$ <?= number_format($veiculo['valor'], 2, ',', '.'); ?><br>
                                <strong>Câmbio:</strong> <?= htmlspecialchars($veiculo['cambio']); ?><br>
                                <strong>Combustível:</strong> <?= htmlspecialchars($veiculo['combustivel']); ?>
                            </p>
                            <a href="detalhes_veiculo.php?id=<?= $veiculo['ID_veiculo']; ?>" class="btn btn-primary">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Nenhum veículo encontrado.</p>
        <?php endif; ?>
    </div>
</div>

<?php
// Inclua o footer com o Bootstrap
include __DIR__ . '/../site/footer.php';
?>
