<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h2>Lista de Movimentações</h2>
    <a href="?page=movimentacao&action=incluir" class="btn btn-success mb-3">Registrar Movimentação</a>
    <table class="table table-hover">
    <thead>
        <tr>
            <th>Data/Hora</th>
            <th>Tipo</th>
            <th>Veículo</th>
            <th>Usuário</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($movimentacoes)): ?>
            <?php foreach ($movimentacoes as $movimentacao): ?>
                <tr>
                    <td><?= htmlspecialchars($movimentacao['data_hora']); ?></td>
                    <td><?= htmlspecialchars($movimentacao['tipo']); ?></td>
                    <td><?= htmlspecialchars($movimentacao['nome_veiculo']); ?></td>
                    <td><?= htmlspecialchars($movimentacao['nome']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">Nenhuma movimentação encontrada.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status === 'sucesso') {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: 'Movimentação cadastrada com sucesso!',
            confirmButtonText: 'OK'
        });
    } else if (status === 'erroCadastro') {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Houve um erro ao cadastrar a movimentação. Tente novamente.',
            confirmButtonText: 'OK'
        });
    }
</script>