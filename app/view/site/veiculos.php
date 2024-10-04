<?php include 'header.php'; ?>
<div class="container">
    <h1>Veículos Disponíveis</h1>
    <div class="row">
        <!-- Filtros de busca -->
        <form method="GET">
            <input type="hidden" name="page" value="veiculos">
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Marca" name="marca">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Modelo" name="modelo">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Ano" name="ano">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Faixa de Preço" name="preco">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        <!-- Listagem dos veículos -->
        <?php foreach ($veiculos as $veiculo): ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?= $veiculo['imagem'] ?>" class="card-img-top" alt="Imagem do veículo">
                    <div class="card-body">
                        <h5 class="card-title"><?= $veiculo['marca'] ?> - <?= $veiculo['modelo'] ?></h5>
                        <p class="card-text">Ano: <?= $veiculo['ano'] ?><br>Valor: R$<?= $veiculo['valor'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'footer.php'; ?>
