<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5 mb-5">
    <h2>Editar Ocorrência</h2>
    <form action="?page=ocorrencia&action=atualizar&id=<?= $ocorrencia['ID_ocorrencia'] ?>" method="POST">
        <fieldset class="p-4 border rounded">
            <legend class="fw-bold text-primary">Detalhes da Ocorrência</legend>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?= htmlspecialchars($ocorrencia['titulo']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição <span class="text-danger">*</span></label>
                <textarea class="form-control" id="descricao" name="descricao" required><?= htmlspecialchars($ocorrencia['descricao']) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="data_hora" class="form-label">Data e Hora <span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" id="data_hora" name="data_hora" value="<?= htmlspecialchars($ocorrencia['data_hora']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                <select class="form-control" id="estado" name="estado" data-selected="<?= htmlspecialchars($ocorrencia['estado']) ?>" required>
                    <option value="">Selecione o Estado</option>
                    <?php foreach ($estados as $estado): ?>
                        <option value="<?= htmlspecialchars($estado['id']) ?>" 
                            <?= ($estado['id'] == $ocorrencia['estado']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($estado['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="cidade" class="form-label">Cidade <span class="text-danger">*</span></label>
                <select class="form-control" id="cidade" name="cidade" required>
                    <!-- As cidades serão carregadas dinamicamente com base no estado selecionado -->
                    <option value="<?= htmlspecialchars($ocorrencia['cidade']) ?>"><?= htmlspecialchars($ocorrencia['cidade']) ?></option>
                </select>
            </div>

            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="endereco" name="endereco" value="<?= htmlspecialchars($ocorrencia['endereco']) ?>" required>
            </div>

            <div class="mb-3 d-flex align-items-center">
                <div class="flex-grow-1 me-3">
                    <label for="veiculo" class="form-label">Veículo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="veiculo_info" name="veiculo" value="<?= htmlspecialchars($veiculo_nome) ?>" readonly required>
                    <input type="hidden" id="ID_veiculo" name="ID_veiculo" value="<?= htmlspecialchars($ocorrencia['ID_veiculo']) ?>">
                </div>
                <div class="align-self-end">
                    <button type="button" id="selecionarVeiculoBtn" class="btn btn-secondary mt-2">Selecionar Veículo</button>
                </div>
            </div>

        </fieldset>

        <div class="d-flex mt-4">
            <button type="submit" class="btn btn-primary w-50">Salvar Alterações</button>
            <a href="?page=ocorrenciaList" class="btn btn-secondary w-50">Cancelar</a>
        </div>
    </form>
</div>

<script src="/MCC/public/js/ocorrenciaCadastro.js"></script>
<?php include __DIR__ . '/../layout/footer.php'; ?>
