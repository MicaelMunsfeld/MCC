<?php include __DIR__ . '/../layout/header.php'; ?> <!-- Inclui o cabeçalho padrão -->

<div class="main-content">
    <div class="container">
        <h1>Consulta de Marcas</h1>
        <div class="d-flex justify-content-start mb-3">
            <a href="?page=marca&action=incluir" class="btn btn-success">Incluir Marca</a> <!-- Botão de inclusão -->
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome da Marca</th>
                    <th class="text-end">Ações</th> <!-- Alinha as ações à direita -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($marcas)): ?>
                    <?php foreach ($marcas as $marca): ?>
                        <tr>
                            <!-- O ID não é exibido na tela, mas ainda é usado nas ações -->
                            <td><?= htmlspecialchars($marca['nome_marca']); ?></td>
                            <td class="text-end"> <!-- Alinha as ações à direita -->
                                <!-- Botão de Alterar -->
                                <a href="?page=marca&action=alterar&id=<?= $marca['ID_marca']; ?>" class="btn btn-warning btn-sm">Alterar</a>
                                <!-- Botão de Excluir -->
                                <a href="?page=marca&action=excluir&id=<?= $marca['ID_marca']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta marca?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">Nenhuma marca encontrada.</td> <!-- Colspan ajustado para duas colunas -->
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?> <!-- Inclui o rodapé padrão -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status === 'sucessoIncluir') {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: 'Marca incluída com sucesso!',
            confirmButtonText: 'OK'
        });
    } else if (status === 'erroIncluir') {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Houve um problema ao incluir a marca. Tente novamente.',
            confirmButtonText: 'OK'
        });
    } else if (status === 'sucessoAlterar') {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: 'Marca alterada com sucesso!',
            confirmButtonText: 'OK'
        });
    } else if (status === 'erroAlterar') {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Houve um problema ao alterar a marca. Tente novamente.',
            confirmButtonText: 'OK'
        });
    } else if (status === 'sucessoExcluir') {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: 'Marca excluída com sucesso!',
            confirmButtonText: 'OK'
        });
    } else if (status === 'erroExcluir') {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Houve um problema ao excluir a marca. Tente novamente.',
            confirmButtonText: 'OK'
        });
    }
</script>