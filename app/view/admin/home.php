<?php include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/header.php'; ?>

<!-- Conteúdo Principal -->
<div class="content p-4">
    <h1>Bem-vindo ao Sistema Administrativo</h1>
    <p class="lead">Selecione uma das opções no menu para começar.</p>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Gerenciar Veículos</h5>
                    <p class="card-text">Adicione, edite ou remova veículos do sistema.</p>
                    <a href="http://localhost/MCC/public/?page=veiculo" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/footer.php'; ?>
