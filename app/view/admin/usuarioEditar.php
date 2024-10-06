<?php include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Editar Usuário</h2>

    <form action="?page=usuario&action=salvar&id=<?= htmlspecialchars($usuario['ID_usuario']) ?>" method="POST">
        <fieldset class="p-4 border rounded">
            <legend class="fw-bold text-primary">Detalhes do Usuário</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="sobrenome" class="form-label">Sobrenome</label>
                        <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?= htmlspecialchars($usuario['sobrenome']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($usuario['telefone']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo_usuario" class="form-label">Tipo de Usuário <span class="text-danger">*</span></label>
                        <select class="form-control" id="tipo_usuario" name="tipo_usuario" required>
                            <option value="">Selecione o Tipo de Usuário</option>
                            <option value="cliente" <?= $usuario['tipo_usuario'] == 'cliente' ? 'selected' : '' ?>>Cliente</option>
                            <option value="lojista" <?= $usuario['tipo_usuario'] == 'lojista' ? 'selected' : '' ?>>Lojista</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo <span class="text-danger">*</span></label>
                        <select class="form-control" id="sexo" name="sexo" required>
                            <option value="">Selecione o Sexo</option>
                            <option value="M" <?= $usuario['sexo'] == 'M' ? 'selected' : '' ?>>Masculino</option>
                            <option value="F" <?= $usuario['sexo'] == 'F' ? 'selected' : '' ?>>Feminino</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-control" id="estado" name="estado" data-selected="<?= htmlspecialchars($usuario['estado']) ?>">
                            <option value="">Selecione o Estado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cidade" class="form-label">Cidade <span class="text-danger">*</span></label>
                        <select class="form-control" id="cidade" name="cidade" data-selected="<?= htmlspecialchars($usuario['cidade']) ?>" required>
                            <option value="">Selecione a Cidade</option>
                        </select>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="d-flex mt-3">
                <button type="submit" class="btn btn-primary w-50">Salvar</button>
                <a href="?page=usuarioList" class="btn btn-secondary w-50">Cancelar</a>
        </div>
    </form>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/footer.php'; ?>
<script src="/MCC/public/js/usuarioCadastro.js"></script>
