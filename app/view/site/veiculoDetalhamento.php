<?php
include __DIR__ . '/../site/header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/MCC/public/dispositivoMovel.php';

// Verifique se o ID do veículo foi fornecido
$idVeiculo = $_GET['id'] ?? null;

if ($idVeiculo) {
    // Busque as informações do veículo com base no ID
    $veiculo = Veiculo::find($idVeiculo);

    if ($veiculo) {
        // Busque as imagens relacionadas ao veículo
        $imagensVeiculo = ImagemVeiculo::buscarPorVeiculo($idVeiculo);

        // Caso não haja imagens, adicione uma imagem padrão (placeholder)
        if (empty($imagensVeiculo)) {
            $imagensVeiculo[] = ['imagem' => '/MCC/public/images/placeholder-car.jpg'];
        } else {
            // Converte imagens binárias para base64
            foreach ($imagensVeiculo as $key => $imagem) {
                if (!empty($imagem['imagem'])) {
                    $imageData = stream_get_contents($imagem['imagem']);
                    $imagensVeiculo[$key]['imagem'] = 'data:image/jpeg;base64,' . base64_encode($imageData);
                } else {
                    $imagensVeiculo[$key]['imagem'] = '/MCC/public/images/placeholder-car.jpg';
                }
            }
        }

        // IDs necessários para a API FIPE
        $idMarca = $veiculo['ID_marca']; // Certifique-se de ter o ID da marca
        $idModelo = $veiculo['ID_modelo']; // Certifique-se de ter o ID do modelo
        $anoModelo = $veiculo['ano']; // Confirme o formato do ano
        ?>

    <div class="container mt-5">
        <div class="row">
            <!-- Carrossel exibido em todos os dispositivos -->
            <div class="<?= isMobile() ? 'col-12' : 'col-md-6'; ?>">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php foreach ($imagensVeiculo as $key => $imagem): ?>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $key ?>" class="<?= $key === 0 ? 'active' : '' ?>" aria-label="Slide <?= $key + 1 ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach ($imagensVeiculo as $key => $imagem): ?>
                            <div class="carousel-item <?= $key === 0 ? 'active' : '' ?>">
                                <img src="<?= $imagem['imagem'] ?>" class="d-block w-100" alt="Imagem do Veículo" style="height: <?= isMobile() ? '200px' : '400px'; ?>; object-fit: cover;">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>

            <!-- Coluna com as informações do veículo -->
            <div class="<?= isMobile() ? 'col-12' : 'col-md-6'; ?>">
                <h2><?= htmlspecialchars($veiculo['marca']) . ' ' . htmlspecialchars($veiculo['modelo']); ?></h2>
                <p><strong>Ano:</strong> <?= htmlspecialchars($veiculo['ano']); ?></p>
                <p><strong>Cor:</strong> <?= htmlspecialchars($veiculo['cor']); ?></p>
                <p><strong>Placa:</strong> <?= substr($veiculo['placa'], 0, 3) . '***' . substr($veiculo['placa'], -1); ?></p>
                <p><strong>Quilometragem:</strong> <?= number_format($veiculo['quilometragem'], 0, ',', '.'); ?> km</p>
                <p><strong>Valor:</strong> R$ <?= number_format($veiculo['valor'], 2, ',', '.'); ?></p>
                <p><strong>Valor FIPE:</strong> R$ <span id="valorFipe">Carregando...</span></p> <!-- Campo de valor FIPE -->
                <p><strong>Câmbio:</strong> <?= htmlspecialchars($veiculo['cambio']); ?></p>
                <p><strong>Combustível:</strong> <?= htmlspecialchars($veiculo['combustivel']); ?></p>
            </div>
        </div>

        <!-- Tabela de opcionais e observações -->
        <div class="row mt-5">
            <div class="col-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Opcionais</th>
                            <th>Observações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $acessorios = explode(',', $veiculo['acessorios']);
                        foreach ($acessorios as $acessorio):
                            if (ctype_upper(substr(trim($acessorio), 0, 1))): ?>
                                <tr>
                                    <td><i class="fa fa-check-circle text-success"></i> <?= htmlspecialchars(trim($acessorio)); ?></td>
                                    <td><?= htmlspecialchars($veiculo['observacoes']); ?></td>
                                </tr>
                            <?php endif;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>

            <a href="?page=veiculos" class="btn btn-outline-primary w-100 mt-3 mb-3">Voltar para a Lista de Veículos</a>
        </div>
    </div>

    <!-- Script para chamar a API da FIPE automaticamente -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const marca = "<?= htmlspecialchars($veiculo['marca']); ?>"; // Marca exibida no veículo
            const modelo = "<?= htmlspecialchars($veiculo['modelo']); ?>"; // Modelo exibido no veículo
            const ano = "<?= htmlspecialchars($veiculo['ano']); ?>"; // Ano exibido no veículo

            consultarFipe(marca, modelo, ano); // Chamada da função com os valores dinâmicos
        });

        async function consultarFipe(marca, modelo, ano) {
            try {
                // Buscar ID da marca
                const marcasResponse = await fetch("https://parallelum.com.br/fipe/api/v1/carros/marcas");
                const marcas = await marcasResponse.json();
                const marcaEncontrada = marcas.find(m => m.nome.toLowerCase() === marca.toLowerCase());
                if (!marcaEncontrada) {
                    throw new Error("Marca não encontrada: " + marca);
                }

                // Buscar ID do modelo
                const modelosResponse = await fetch(`https://parallelum.com.br/fipe/api/v1/carros/marcas/${marcaEncontrada.codigo}/modelos`);
                const modelos = await modelosResponse.json();
                const modeloEncontrado = modelos.modelos.find(m => m.nome.toLowerCase() === modelo.toLowerCase());
                if (!modeloEncontrado) {
                    throw new Error("Modelo não encontrado: " + modelo);
                }

                // Consultar o valor da FIPE
                const fipeResponse = await fetch(`https://parallelum.com.br/fipe/api/v1/carros/marcas/${marcaEncontrada.codigo}/modelos/${modeloEncontrado.codigo}/anos/${ano}`);
                const fipeData = await fipeResponse.json();

                if (fipeData.Valor) {
                    document.getElementById('valorFipe').innerText = fipeData.Valor;
                } else {
                    throw new Error("Valor FIPE não disponível");
                }
            } catch (error) {
                console.error("Erro ao consultar a FIPE:", error.message);
                document.getElementById('valorFipe').innerText = "Erro ao consultar FIPE";
            }
        }
    </script>

        <?php
    } else {
        echo "<p>Veículo não encontrado.</p>";
    }
} else {
    echo "<p>ID do veículo não fornecido.</p>";
}

include __DIR__ . '/../site/footer.php';