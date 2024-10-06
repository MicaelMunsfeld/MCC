<?php
// Inclua o header com o Bootstrap e a barra de navegação
include __DIR__ . '/../site/header.php';
?>
<link href="/MCC/public/css/style.css" rel="stylesheet">
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-6">
            <h1 class="mb-4">Entre em Contato</h1>
            <p>Estamos à disposição para responder suas dúvidas ou fornecer mais informações. Preencha o formulário abaixo ou entre em contato diretamente.</p>
            
            <!-- Formulário de Contato -->
            <form action="processar_contato.php" method="post">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome (Obrigatório)</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone (Obrigatório)</label>
                    <input type="tel" class="form-control" id="telefone" name="telefone" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail (Obrigatório)</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado (Obrigatório)</label>
                    <select id="estado" class="form-control" name="estado" required>
                        <option value="">Selecione o estado</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cidade" class="form-label">Cidade (Obrigatório)</label>
                    <select id="cidade" class="form-control" name="cidade" required>
                        <option value="">Selecione a cidade</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="assunto" class="form-label">Assunto (Obrigatório)</label>
                    <input type="text" class="form-control" id="assunto" name="assunto" required>
                </div>
                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem</label>
                    <textarea class="form-control" id="mensagem" name="mensagem" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
        <div class="col-md-6">
            <h2 class="mb-4">Informações de Contato</h2>
            <p><strong>Telefone:</strong> (47) 3557-1233</p>
            <p><strong>E-mail:</strong> contato@salvioautomoveis.com.br</p>
            <div class="map-responsive">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2099.1200973199957!2d-49.42268609831866!3d-27.49288223231577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94df81b383b01737%3A0x781120e36c1e4c68!2sImbuia%2C%20SC%2C%2088440-000!5e1!3m2!1spt-BR!2sbr!4v1728174716378!5m2!1spt-BR!2sbr" width="100%" height="75%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</div>

<script src="/MCC/public/js/usuarioCadastro.js"></script>

<?php
// Inclua o footer com o Bootstrap
include __DIR__ . '/../site/footer.php';
?>
