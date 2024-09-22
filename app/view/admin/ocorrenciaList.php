<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
    <h2>Lista de Ocorrências</h2>
    <a href="?page=ocorrencia&action=incluir" class="btn btn-success mb-3">Incluir Ocorrência</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Data/Hora</th>
                <th>Veículo</th>
                <th>Cidade</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($ocorrencias)): ?>
                <?php foreach ($ocorrencias as $ocorrencia): ?>
                    <tr>
                        <td><?= htmlspecialchars($ocorrencia['titulo']); ?></td>
                        <td><?= htmlspecialchars($ocorrencia['descricao']); ?></td>
                        <td><?= htmlspecialchars($ocorrencia['data_hora']); ?></td>
                        <td><?= htmlspecialchars($ocorrencia['nome_veiculo']); ?></td>
                        <td><?= htmlspecialchars($ocorrencia['cidade']); ?></td>
                        <td><?= htmlspecialchars($ocorrencia['endereco']); ?></td>
                        <td>
                            <a href="?page=ocorrencia&action=excluir&id=<?= $ocorrencia['ID_ocorrencia']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir esta ocorrência?');">Excluir</a>
                            <a href="?page=ocorrencia&action=alterar&id=<?= $ocorrencia['ID_ocorrencia']; ?>" class="btn btn-warning btn-sm">Alterar</a>
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

<?php include __DIR__ . '/../layout/footer.php'; ?>
