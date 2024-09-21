<!-- modeloCadastro.php -->
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="main-content">
    <div class="container">
        <h1>Cadastro de Modelo</h1>
        <form action="?page=modelo&action=salvar" method="POST">
            <fieldset class="border p-3">
                <legend class="w-auto">Informações do Modelo</legend>
                <div class="form-group">
                    <label for="id_marca">Marca:</label>
                    <select id="id_marca" name="id_marca" class="form-control" required>
                        <option value="">Selecione a Marca</option>
                        <?php foreach ($marcas as $marca): ?> <!-- Carrega as marcas do banco de dados -->
                            <option value="<?= htmlspecialchars($marca['ID_marca']); ?>" data-fipe="<?= htmlspecialchars($marca['nome_marca']); ?>">
                                <?= htmlspecialchars($marca['nome_marca']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nome_modelo">Nome do Modelo:</label>
                    <select id="nome_modelo" name="nome_modelo" class="form-control" required>
                        <option value="">Selecione o Modelo</option>
                        <!-- Os modelos serão carregados dinamicamente após selecionar a marca -->
                    </select>
                </div>
            </fieldset>
            <div class="d-flex mt-3">
                <button type="submit" class="btn btn-primary w-50">Salvar</button>
                <a href="?page=modelo" class="btn btn-secondary w-50">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<!-- Inclusão do script para carregar as marcas e modelos -->
<script src="/MCC/public/js/modeloCadastro.js"></script>
