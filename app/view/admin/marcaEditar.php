<!-- marcaEditar.php -->
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="main-content">
    <div class="container">
        <h1>Editar Marca</h1>
        <form action="?page=marca&action=atualizar" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($marca['ID_marca']); ?>">

            <fieldset class="border p-3">
                <legend class="w-auto">Informações da Marca</legend>
                <div class="form-group">
                    <label for="tipo">Tipo de Veículo:</label>
                    <select id="tipo" name="tipo" class="form-control" data-selecionado="<?= htmlspecialchars($marca['tipo']); ?>">
                        <option value="">Selecione o Tipo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nome_marca">Nome da Marca:</label>
                    <select id="nome_marca" name="nome_marca" class="form-control" required data-selecionado="<?= htmlspecialchars($marca['nome_marca']); ?>">
                        <option value="">Selecione a Marca</option>
                    </select>
                </div>
            </fieldset>
            <div class="d-flex mt-3">
                <button type="submit" class="btn btn-primary w-50">Salvar</button>
                <a href="?page=marca" class="btn btn-secondary w-50">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<!-- Certifique-se de que o caminho do script está correto -->
<script src="/MCC/public/js/marcaCadastro.js"></script>
