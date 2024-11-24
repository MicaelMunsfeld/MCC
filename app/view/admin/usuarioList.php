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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status === 'sucessoIncluir') {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: 'Usuário incluído com sucesso!',
            confirmButtonText: 'OK'
        });
    } else if (status === 'erroIncluir') {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Houve um problema ao incluir o usuário. Tente novamente.',
            confirmButtonText: 'OK'
        });
    } else if (status === 'sucessoAlterar') {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: 'Usuário alterado com sucesso!',
            confirmButtonText: 'OK'
        });
    } else if (status === 'erroAlterar') {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Houve um problema ao alterar o usuário. Tente novamente.',
            confirmButtonText: 'OK'
        });
    } else if (status === 'sucessoExcluir') {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso',
            text: 'Usuário excluído com sucesso!',
            confirmButtonText: 'OK'
        });
    } else if (status === 'erroChaveEstrangeira') {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Não foi possível excluir o usuário, pois ele está vinculado a outros registros no sistema.',
            confirmButtonText: 'OK'
        });
    } else if (status === 'erroExcluir') {
        Swal.fire({
            icon: 'error',
            title: 'Erro',
            text: 'Houve um problema ao excluir o usuário. Tente novamente.',
            confirmButtonText: 'OK'
        });
    }
    
</script>