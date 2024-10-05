<?php
// Inclua o header com o Bootstrap e a barra de navegação
include __DIR__ . '/../site/header.php';
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="mb-4">Sobre Nós</h1>
            <p class="lead">Conheça a história, missão, visão e valores da Sálvio Automóveis.</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-3">Nossa História</h2>
            <p>A Sálvio Automóveis foi fundada em [ano] na cidade de [cidade], com o objetivo de proporcionar a melhor experiência de compra e venda de veículos para a população da região. Com mais de [x] anos de atuação, nossa empresa se consolidou como uma referência no mercado automotivo, sempre prezando pela qualidade dos veículos e pela satisfação de nossos clientes.</p>
        </div>
        <div class="col-md-6">
            <img src="/MCC/public/images/nossa-historia.jpg" class="img-fluid" alt="Nossa História">
        </div>
    </div>

    <hr class="my-5">

    <div class="row">
        <div class="col-md-6">
            <img src="/MCC/public/images/missao.jpg" class="img-fluid" alt="Nossa Missão">
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">Missão</h2>
            <p>Nossa missão é oferecer veículos de alta qualidade e confiança, proporcionando aos nossos clientes um atendimento diferenciado, transparente e com soluções personalizadas para suas necessidades automotivas.</p>
        </div>
    </div>

    <hr class="my-5">

    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-3">Visão</h2>
            <p>Ser a principal referência em compra e venda de veículos na região, reconhecida pela excelência no atendimento, pela qualidade dos veículos oferecidos e por nossa contribuição para o desenvolvimento da comunidade local.</p>
        </div>
        <div class="col-md-6">
            <img src="/MCC/public/images/visao.jpg" class="img-fluid" alt="Nossa Visão">
        </div>
    </div>

    <hr class="my-5">

    <div class="row">
        <div class="col-md-6">
            <img src="/MCC/public/images/valores.jpg" class="img-fluid" alt="Nossos Valores">
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">Valores</h2>
            <ul>
                <li>Compromisso com a satisfação do cliente</li>
                <li>Transparência e ética em todas as negociações</li>
                <li>Qualidade nos produtos e serviços oferecidos</li>
                <li>Responsabilidade social e ambiental</li>
                <li>Inovação e melhoria contínua</li>
            </ul>
        </div>
    </div>
</div>

<?php
// Inclua o footer com o Bootstrap
include __DIR__ . '/../site/footer.php';
?>
