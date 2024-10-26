<?php
include $_SERVER['DOCUMENT_ROOT'] . '/MCC/public/dispositivoMovel.php';
include __DIR__ . '/../site/header.php';
?>
<link href="/MCC/public/css/style.css" rel="stylesheet">
<div class="container-fluid p-0">
    <div class="banner">
        <img src="/MCC/uploads/banner.png" class="img-fluid w-100" alt="Banner Sálvio Automóveis" style="height: 500px; object-fit: cover;">
    </div>
</div>

<div class="container">
    <div class="text-center p-5">
        <h1>Bem-vindo à Sálvio Automóveis</h1>
        <p>A Sálvio Automóveis é referência no mercado de veículos na região. Conheça nossa história, missão, visão e valores.</p>
    </div>
    <h2 class="pb-3">Veículos Disponíveis</h2>

    <?php
    // Verifique se a variável $veiculos está definida e não está vazia
    if (!empty($veiculos)) {
        // Verifica se é mobile e exibe sem "row" se for mobile
        if (!isMobile()) {
            echo '<div class="row">';
        }
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

            // Verifica se é mobile
            $colClass = isMobile() ? 'col-12 mb-4' : 'col-md-4 mb-4';

            // Exibe os veículos disponíveis em cards do Bootstrap
            echo '
            <div class="' . $colClass . '">
                <div class="card h-100">
                    <img src="' . $imageSrc . '" class="card-img-top" alt="Imagem do veículo" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($veiculo['marca']) . ' ' . htmlspecialchars($veiculo['modelo']) . '</h5>
                        <p class="card-text">
                            <strong>Ano:</strong> ' . htmlspecialchars($veiculo['ano']) . '<br>
                            <strong>Quilometragem:</strong> ' . number_format($veiculo['quilometragem'], 0, ',', '.') . ' km<br>
                            <strong>Preço:</strong> R$ ' . number_format($veiculo['valor'], 2, ',', '.') . '<br>
                            <strong>Câmbio:</strong> ' . htmlspecialchars($veiculo['cambio']) . '<br>
                            <strong>Combustível:</strong> ' . htmlspecialchars($veiculo['combustivel']) . '
                        </p>
                        <a href="?page=veiculoDetalhamento&id=' . htmlspecialchars($veiculo['ID_veiculo']) . '" class="btn btn-primary w-100">Ver Detalhes</a>
                    </div>
                </div>
            </div>
            ';
        }
        if (!isMobile()) {
            echo '</div>'; // Fecha a row se não for mobile
        }
    } else {
        echo "<p>Nenhum veículo disponível no momento.</p>";
    }
    ?>
    
    <div class="row mt-5 align-items-center">
        <div class="col-md-8 mb-4 mb-md-0">
            <h2>Sobre Nós</h2>
            <p>
                A Sálvio Automóveis é uma empresa com mais de 20 anos de experiência no mercado automotivo, localizada em Imbuia, Santa Catarina.
                Especializada na venda de veículos novos e usados, a Sálvio Automóveis sempre se destacou pela qualidade no atendimento e pelo compromisso
                com a satisfação de seus clientes.
            </p>
            <p>
                Conheça mais sobre nossa história, missão, visão e valores, e descubra como nos tornamos referência no mercado regional de veículos.
            </p>
            <a href="?page=sobre" class="btn btn-outline-primary">Saiba Mais</a>
        </div>
        <div class="col-md-4">
            <img src="/MCC/uploads/sobre.jpg" class="img-fluid" alt="Sobre Sálvio Automóveis" style="height: 400px; object-fit: cover;">
        </div>
    </div>
</div>

<?php include __DIR__ . '/../site/footer.php'; ?>
