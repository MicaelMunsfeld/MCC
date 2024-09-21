<!-- veiculoList.php -->
<?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/header.php'; 
    $isModal = isset($_GET['modal']) && $_GET['modal'] === 'true';
?>

<div class="main-content">
    <div class="container mt-5">
        <h2 class="mb-4">Consulta de Veículos</h2>

        <!-- Botão de Incluir que direciona para a tela de cadastro -->
        <div class="mb-3 d-flex justify-content-start">
            <button class="btn btn-success me-2" onclick="window.location.href='?page=veiculo&action=incluir'">Incluir Veículo</button>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano</th>
                    <th>Placa</th>
                    <th>Valor</th>
                    <th>Ações</th> <!-- Nova coluna para ações -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($veiculos)): ?>
                    <?php foreach ($veiculos as $veiculo): ?>
                        <tr>
                            <td><?= htmlspecialchars($veiculo['marca']); ?></td>
                            <td><?= htmlspecialchars($veiculo['modelo']); ?></td>
                            <td><?= htmlspecialchars($veiculo['ano']); ?></td>
                            <td><?= htmlspecialchars($veiculo['placa']); ?></td>
                            <td>R$ <?= number_format($veiculo['valor'], 2, ',', '.'); ?></td>
                            <td>
                                <a href="?page=veiculo&action=alterar&id=<?= $veiculo['ID_veiculo'] ?>" class="btn btn-warning btn-sm">Alterar</a>
                                <a href="?page=veiculo&action=excluir&id=<?= $veiculo['ID_veiculo'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
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

<?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/footer.php';
    if (!$isModal){
        include __DIR__ . '/../layout/footer.php'; 
    }
?>