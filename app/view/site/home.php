<?php
// Inclua o header com o Bootstrap e a barra de navegação
include __DIR__ . '/../site/header.php';
?>
<link href="/MCC/public/css/style.css" rel="stylesheet">
<!-- Banner grande abaixo do header -->
<div class="container-fluid p-0">
    <div class="banner">
        <img src="/MCC/uploads/banner.png" class="img-fluid w-100 h-80" alt="Banner Sálvio Automóveis">
    </div>
</div>

<div class="container mt-5 mb-5">
    <h1>Bem-vindo à Sálvio Automóveis</h1>
    <p>A Sálvio Automóveis é referência no mercado de veículos na região. Conheça nossa história, missão, visão e valores.</p>

    <h2>Veículos Disponíveis</h2>

    <?php
    // Verifique se a variável $veiculos está definida e não está vazia
    if (!empty($veiculos)) {
        echo '<div class="row">';
        foreach ($veiculos as $veiculo) {
            // Verifique se a imagem está armazenada como binário
            if (!empty($veiculo['imagem'])) {
                // Converte a imagem binária para base64
                $imageData = stream_get_contents($veiculo['imagem']);
                $imageSrc = 'data:image/jpeg;base64,' . base64_encode($imageData);
            } else {
                // Caminho para uma imagem padrão (placeholder) caso não haja imagem
                $imageSrc = '/MCC/public/images/placeholder-car.jpg';
            }

            // Exibe os veículos disponíveis em cards do Bootstrap
            echo '
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="' . $imageSrc . '" class="card-img-top" alt="Imagem do veículo">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($veiculo['marca']) . ' ' . htmlspecialchars($veiculo['modelo']) . '</h5>
                        <p class="card-text">
                            <strong>Ano:</strong> ' . htmlspecialchars($veiculo['ano']) . '<br>
                            <strong>Quilometragem:</strong> ' . number_format($veiculo['quilometragem'], 0, ',', '.') . ' km<br>
                            <strong>Preço:</strong> R$ ' . number_format($veiculo['valor'], 2, ',', '.') . '<br>
                            <strong>Câmbio:</strong> ' . htmlspecialchars($veiculo['cambio']) . '<br>
                            <strong>Combustível:</strong> ' . htmlspecialchars($veiculo['combustivel']) . '
                        </p>
                        <a href="detalhes_veiculo.php?id=' . htmlspecialchars($veiculo['ID_veiculo']) . '" class="btn btn-primary">Ver Detalhes</a>
                    </div>
                </div>
            </div>
            ';
        }
        echo '</div>';
    } else {
        echo "<p>Nenhum veículo disponível no momento.</p>";
    }
    include __DIR__ . '/../site/footer.php';
    ?>

</div>
