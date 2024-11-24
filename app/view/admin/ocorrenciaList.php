<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
    <h2>Lista de Ocorrências</h2>
    <a href="?page=ocorrencia&action=incluir" class="btn btn-success mb-3">Incluir Ocorrência</a>

    <!-- Tabela Responsiva -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th class="d-none d-md-table-cell">Descrição</th> <!-- Oculto em telas pequenas -->
                    <th class="d-none d-md-table-cell">Data/Hora</th> <!-- Oculto em telas pequenas -->
                    <th class="d-none d-md-table-cell">Veículo</th> <!-- Oculto em telas pequenas -->
                    <th class="d-none d-md-table-cell">Cidade</th> <!-- Oculto em telas pequenas -->
                    <th class="d-none d-md-table-cell">Endereço</th> <!-- Oculto em telas pequenas -->
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ocorrencias)): ?>
                    <?php foreach ($ocorrencias as $ocorrencia): ?>
                        <tr>
                            <td><?= htmlspecialchars($ocorrencia['titulo']); ?></td>
                            <td class="d-none d-md-table-cell"><?= htmlspecialchars($ocorrencia['descricao']); ?></td>
                            <td class="d-none d-md-table-cell"><?= htmlspecialchars($ocorrencia['data_hora']); ?></td>
                            <td class="d-none d-md-table-cell"><?= htmlspecialchars($ocorrencia['nome_veiculo']); ?></td>
                            <td class="d-none d-md-table-cell"><?= htmlspecialchars($ocorrencia['cidade']); ?></td>
                            <td class="d-none d-md-table-cell"><?= htmlspecialchars($ocorrencia['endereco']); ?></td>
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="?page=ocorrencia&action=excluir&id=<?= $ocorrencia['ID_ocorrencia']; ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Deseja excluir esta ocorrência?');">Excluir</a>
                                    <a href="?page=ocorrencia&action=alterar&id=<?= $ocorrencia['ID_ocorrencia']; ?>" 
                                       class="btn btn-warning btn-sm">Alterar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Nenhuma ocorrência encontrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status === 'sucessoIncluir') {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: 'Ocorrência incluída com sucesso!',
        });
    } else if (status === 'erroIncluir') {
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Não foi possível incluir a ocorrência.',
        });
    } else if (status === 'sucessoAlterar') {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: 'Ocorrência alterada com sucesso!',
        });
    } else if (status === 'erroAlterar') {
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Não foi possível alterar a ocorrência.',
        });
    } else if (status === 'sucessoExcluir') {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: 'Ocorrência excluída com sucesso!',
        });
    } else if (status === 'erroExcluir') {
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Não foi possível excluir a ocorrência.',
        });
    }
</script>