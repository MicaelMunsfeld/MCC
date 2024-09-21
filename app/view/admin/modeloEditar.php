<!-- modeloEditar.php -->
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="main-content">
    <div class="container">
        <h1>Editar Modelo</h1>
        <form action="?page=modelo&action=atualizar" method="POST">
            <!-- Campo oculto para enviar o ID do modelo -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($modelo['ID_modelo']); ?>">

            <fieldset class="border p-3">
                <legend class="w-auto">Informações do Modelo</legend>
                <div class="form-group">
                    <label for="id_marca">Marca:</label>
                    <select id="id_marca" name="id_marca" class="form-control" required>
                        <option value="">Selecione a Marca</option>
                        <?php foreach ($marcas as $marca): ?>
                            <option value="<?= htmlspecialchars($marca['ID_marca']); ?>" data-fipe="<?= htmlspecialchars($marca['nome_marca']); ?>" <?= $modelo['ID_marca'] == $marca['ID_marca'] ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($marca['nome_marca']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nome_modelo">Nome do Modelo:</label>
                    <select id="nome_modelo" name="nome_modelo" class="form-control" required>
                        <option value="<?= htmlspecialchars($modelo['nome_modelo']); ?>" selected><?= htmlspecialchars($modelo['nome_modelo']); ?></option>
                        <!-- Os modelos serão carregados dinamicamente após selecionar a marca -->
                    </select>
                </div>
            </fieldset>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="?page=modelo" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<!-- Inclusão do script para carregar as marcas e modelos -->
<script src="/MCC/public/js/modeloCadastro.js"></script>
