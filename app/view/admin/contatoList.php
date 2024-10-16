<?php 
include __DIR__ . '/../layout/header.php'; 
?>

<div class="container mt-5">
    <h2 class="mb-4">Lista de Contatos</h2>

    <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'sucesso'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensagem'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif (isset($_SESSION['status']) && $_SESSION['status'] === 'erro'): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensagem'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Cidade</th>
                <th>Assunto</th>
                <th>Data/Hora</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($contatos)): ?>
                <?php foreach ($contatos as $contato): ?>
                    <tr>
                        <td><?= htmlspecialchars($contato['nome']); ?></td>
                        <td><?= htmlspecialchars($contato['telefone']); ?></td>
                        <td><?= htmlspecialchars($contato['email']); ?></td>
                        <td><?= htmlspecialchars($contato['cidade']); ?></td>
                        <td><?= htmlspecialchars($contato['assunto']); ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($contato['data_hora'])) ?></td>
                        <td>
                            <a href="?page=contato&action=visualizar&id=<?= $contato['ID_contato'] ?>" class="btn btn-info btn-sm">Visualizar</a>
                            <a href="?page=contato&action=excluir&id=<?= $contato['ID_contato'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Nenhum contato encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php 
include __DIR__ . '/../layout/footer.php'; 
?>
