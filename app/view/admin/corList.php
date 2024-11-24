<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h2 class="mb-4">Listagem de Cores</h2>

    <!-- Botões de Ações -->
    <div class="mb-3 d-flex justify-content-start">
        <button id="btnIncluir" class="btn btn-success me-2" onclick="window.location.href='?page=cor&action=incluir'">Incluir Cor</button>
    </div>

    <!-- Tabela de Cores -->
    <table class="table table-striped" id="tabelaCores">
        <thead>
            <tr>
                <th>Nome da Cor</th>
                <th class="text-end">Ações</th> <!-- Coluna para ações alinhada à direita -->
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($cores)): ?>
                <?php foreach ($cores as $cor): ?>
                    <tr>
                        <!-- O ID não é exibido na tela, mas é usado nas ações -->
                        <td><?= htmlspecialchars($cor['nome_cor']); ?></td>
                        <td class="text-end">
                            <!-- Botão para chamar a tela de alteração -->
                            <button class="btn btn-warning btn-sm" onclick="window.location.href='?page=cor&action=alterar&id=<?= $cor['ID_cor']; ?>'">Alterar</button>
                            <!-- Botão para exclusão -->
                            <button class="btn btn-danger btn-sm" onclick="if(confirm('Deseja realmente excluir esta cor?')) { window.location.href='?page=cor&action=excluir&id=<?= $cor['ID_cor']; ?>'; }">Excluir</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" class="text-center">Nenhuma cor cadastrada.</td> <!-- Ajustado para duas colunas -->
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

    if (status === 'sucessoIncluir') {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: 'Cor incluída com sucesso!',
            confirmButtonText: 'OK'
        });
    } else if (status === 'erroIncluir') {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Houve um problema ao incluir a cor. Tente novamente.',
            confirmButtonText: 'OK'
        });
    } else if (status === 'sucessoAlterar') {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: 'Cor alterada com sucesso!',
            confirmButtonText: 'OK'
        });
    } else if (status === 'erroAlterar') {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Houve um problema ao alterar a cor. Tente novamente.',
            confirmButtonText: 'OK'
        });
    } else if (status === 'sucessoExcluir') {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: 'Cor excluída com sucesso!',
            confirmButtonText: 'OK'
        });
    } else if (status === 'erroExcluir') {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Houve um problema ao excluir a cor. Tente novamente.',
            confirmButtonText: 'OK'
        });
    }
</script>