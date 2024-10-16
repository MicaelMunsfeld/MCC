<?php include __DIR__ . '/../site/header.php'; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <?php if (!empty($sobre)): ?>
                <div class="mb-4 text-justify">
                    <?= htmlspecialchars_decode($sobre['conteudo']) ?>
                </div>
            <?php else: ?>
                <p>Nenhuma informação disponível sobre a empresa no momento.</p>
            <?php endif; ?>
        </div>

        <!-- Coluna para a imagem -->
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <img src="/MCC/uploads/sobre.jpg" class="img-fluid"  alt="Imagem Sobre a Empresa">
        </div>
    </div>
</div>

<?php include __DIR__ . '/../site/footer.php'; ?>
