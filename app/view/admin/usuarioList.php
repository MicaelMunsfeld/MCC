<!-- usuarioList.php -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/header.php'; ?> <!-- Inclui o cabeçalho padrão -->

<div class="main-content">
    <div class="container">
        <h1 class="mb-4">Listagem de Usuários</h1>
        <a href="?page=usuario&action=incluir" class="btn btn-success mb-3">Incluir Usuário</a> <!-- Botão de inclusão no topo -->

        <table class="table table-striped table-hover"> <!-- Aplicando estilo similar ao da marca -->
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Telefone</th>
                    <th>Sexo</th>
                    <th>Email</th>
                    <th>Cidade</th>
                    <th>Tipo de Usuário</th>
                    <th>Ações</th> <!-- Coluna de Ações -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['nome']) ?></td>
                            <td><?= htmlspecialchars($usuario['sobrenome']) ?></td>
                            <td><?= htmlspecialchars($usuario['telefone']) ?></td>
                            <td><?= htmlspecialchars($usuario['sexo']) ?></td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td><?= htmlspecialchars($usuario['cidade']) ?></td>
                            <td><?= htmlspecialchars($usuario['tipo_usuario']) ?></td>
                            <td class="d-flex"> <!-- Estilização semelhante ao da marca -->
                                <a href="?page=usuario&action=alterar&id=<?= $usuario['ID_usuario'] ?>" class="btn btn-warning btn-sm">Alterar</a>
                                <a href="?page=usuario&action=excluir&id=<?= $usuario['ID_usuario'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
                                <?php if($usuario['tipo_usuario'] == 'lojista'): ?>
                                    <a href="?page=login&id=<?= $usuario['ID_usuario'] ?>" class="btn btn-warning btn-sm">Login</a>
                                <?php endif; ?> 
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Nenhum usuário encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/footer.php'; ?>
<script src="/MCC/public/js/usuarioCadastro.js"></script> <!-- Script de JavaScript mantido -->
