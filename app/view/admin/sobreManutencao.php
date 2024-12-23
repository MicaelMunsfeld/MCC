<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <h2>Manutenção das Informações sobre a Empresa</h2>
    <fieldset>
        <form action="?page=sobreEmpresa&action=salvar" method="post">
            <div class="mb-3">
                <textarea name="conteudo" id="conteudo" class="form-control" rows="10">
                    <?= htmlspecialchars($sobre['conteudo'] ?? '') ?>
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Salvar</button>
        </form>
    </fieldset>
</div>

<!-- Script para o editor de texto -->
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('conteudo');
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>