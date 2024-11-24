<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/header.php'; 

    $isModal = isset($_GET['modal']) && $_GET['modal'] === 'true';
?>

<div class="main-content">
    <div class="container">
        <h2 class="mb-4">Consulta de Veículos</h2>

        <!-- Exibição do Alerta de Sucesso ou Erro -->
        <?php if (isset($_SESSION['status'])): ?>
            <div class="alert alert-<?= ($_SESSION['status'] === 'sucesso') ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['mensagem']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Botão de Incluir -->
        <div class="mb-3 d-flex justify-content-start">
            <button class="btn btn-success me-2" onclick="window.location.href='?page=veiculo&action=incluir'">Incluir Veículo</button>
        </div>

        <!-- Tabela Responsiva -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th class="d-none d-md-table-cell">Marca</th> <!-- Oculto em telas pequenas -->
                        <th>Modelo</th>
                        <th class="d-none d-md-table-cell">Ano</th> <!-- Oculto em telas pequenas -->
                        <th class="d-none d-md-table-cell">Placa</th> <!-- Oculto em telas pequenas -->
                        <th class="d-none d-md-table-cell">Valor</th> <!-- Oculto em telas pequenas -->
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($veiculos)): ?>
                        <?php foreach ($veiculos as $veiculo): ?>
                            <tr>
                                <td class="d-none d-md-table-cell"><?= htmlspecialchars($veiculo['marca']); ?></td>
                                <td><?= htmlspecialchars($veiculo['modelo']); ?></td>
                                <td class="d-none d-md-table-cell"><?= htmlspecialchars($veiculo['ano']); ?></td>
                                <td class="d-none d-md-table-cell"><?= htmlspecialchars($veiculo['placa']); ?></td>
                                <td class="d-none d-md-table-cell">R$ <?= number_format($veiculo['valor'], 2, ',', '.'); ?></td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="?page=veiculo&action=alterar&id=<?= $veiculo['ID_veiculo'] ?>" class="btn btn-warning btn-sm">Alterar</a>
                                        <a href="?page=veiculo&action=excluir&id=<?= $veiculo['ID_veiculo'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                    </div>
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
</div>

<?php 
    include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/footer.php';
    if (!$isModal) {
        include __DIR__ . '/../layout/footer.php'; 
    }

    // Limpar a sessão após exibir o alerta
    unset($_SESSION['status']);
    unset($_SESSION['mensagem']);
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const mensagem = urlParams.get('mensagem');

    if (status && mensagem) {
        Swal.fire({
            icon: status === 'sucesso' ? 'success' : 'error',
            title: status === 'sucesso' ? 'Sucesso!' : 'Erro!',
            text: mensagem,
        });
    }
</script>