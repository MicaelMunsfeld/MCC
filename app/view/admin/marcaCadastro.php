<!-- marcaCadastro.php -->
<?php include __DIR__ . '/../layout/header.php'; ?> <!-- Inclui o cabeçalho padrão -->

<div class="main-content">
    <div class="container">
        <h1>Cadastro de Marca</h1>
        <form action="?page=marca&action=salvar" method="POST">
            <fieldset class="border p-3">
                <legend class="w-auto">Informações da Marca</legend>
                <div class="form-group">
                    <label for="tipo">Tipo de Veículo:</label>
                    <select id="tipo" name="tipo" class="form-control">
                        <option value="">Selecione o Tipo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nome_marca">Nome da Marca:</label>
                    <select id="nome_marca" name="nome_marca" class="form-control" required>
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

<?php include __DIR__ . '/../layout/footer.php'; ?> <!-- Inclui o rodapé padrão -->

<!-- Inclusão do script com o caminho correto -->
<script src="/MCC/public/js/marcaCadastro.js"></script>
