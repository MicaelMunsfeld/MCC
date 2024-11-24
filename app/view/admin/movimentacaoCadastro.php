<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
    <h2>Cadastrar Movimentação</h2>

    <!-- Adicionando a sobreposição -->
    <div id="overlay" class="overlay"></div>

    <form action="?page=movimentacao&action=salvar" method="POST">
        <fieldset class="p-4 border rounded">
            <legend class="fw-bold text-primary">Detalhes da Movimentação</legend>
            <div class="mb-3">
                <label for="data_hora" class="form-label">Data e Hora</label>
                <input type="datetime-local" class="form-control" id="data_hora" name="data_hora" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-control" id="tipo" name="tipo" required>
                    <option value="">Selecione o Tipo</option>
                    <option value="entrada">Entrada</option>
                    <option value="saida">Saída</option>
                </select>
            </div>
            <div class="mb-3 d-flex">
                <div class="flex-grow-1 me-3">
                    <label for="veiculo_info" class="form-label">Veículo</label>
                    <input type="text" class="form-control" id="veiculo_info" name="veiculo_info" placeholder="Selecione o Veículo" required>
                    <input type="hidden" id="ID_veiculo" name="ID_veiculo" required>
                </div>
                <div class="align-self-end">
                    <button type="button" id="selecionarVeiculoBtn" class="btn btn-secondary mt-2">Selecionar Veículo</button>
                </div>
            </div>
            <div class="mb-3">
                <label for="ID_usuario" class="form-label">Usuário</label>
                <select class="form-control" id="ID_usuario" name="ID_usuario" required>
                    <option value="">Selecione o Usuário</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['ID_usuario']; ?>"><?= $usuario['nome_completo']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </fieldset>

        <div class="d-flex mt-3">
            <button type="submit" class="btn btn-primary w-50">Salvar</button>
            <a href="?page=movimentacao" class="btn btn-secondary w-50">Cancelar</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
<script src="/MCC/public/js/movimentacaoCadastro.js"></script>
