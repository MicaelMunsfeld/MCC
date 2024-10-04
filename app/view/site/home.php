<?php include 'header.php'; ?>
<div class="container">
    <h1>Bem-vindo à Sálvio Automóveis</h1>
    <p>A Sálvio Automóveis é referência no mercado de veículos na região. Conheça nossa história, missão, visão e valores.</p>

    <h2>Veículos Disponíveis</h2>
    <div class="row">
        <!-- Loop para exibir os veículos -->
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
