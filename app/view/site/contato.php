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
            
            <!-- Exibição de mensagens de sucesso ou erro -->
            <?php if (isset($_SESSION['status'])): ?>
                <?php if ($_SESSION['status'] === 'sucesso'): ?>
                    <div class="alert alert-success" role="alert">
                        <?= $_SESSION['mensagem']; ?>
                    </div>
                <?php elseif ($_SESSION['status'] === 'erro'): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['mensagem']; ?>
                    </div>
                <?php endif; ?>
                <?php unset($_SESSION['status'], $_SESSION['mensagem']); // Limpa a sessão ?>
            <?php endif; ?>

            <!-- Formulário de Contato -->
            <form action="?page=contato&action=salvar" method="post">
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
                        <!-- Preencha aqui com a lista de estados dinamicamente, se necessário -->
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cidade" class="form-label">Cidade (Obrigatório)</label>
                    <select id="cidade" class="form-control" name="cidade" required>
                        <option value="">Selecione a cidade</option>
                        <!-- Preencha aqui com a lista de cidades dinamicamente, se necessário -->
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
                <button type="submit" class="btn btn-primary w-100">Enviar</button>
            </form>
        </div>

        <div class="col-md-6">
            <h2 class="mb-4">Informações de Contato</h2>
            <p><strong>Telefone:</strong> (47) 3557-1233</p>
            <p><strong>E-mail:</strong> contato@salvioautomoveis.com.br</p>
            <div class="map-responsive">
            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d4198.305544396552!2d-49.4238725244238!3d-27.491168405763712!3m2!1i1024!2i768!4f13.1!5e1!3m2!1spt-BR!2sbr!4v1731856470606!5m2!1spt-BR!2sbr" width="100%" height="850" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Carregar o jQuery e Inputmask -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7-beta.15/jquery.inputmask.min.js"></script>
<script src="/MCC/public/js/usuarioCadastro.js"></script>

<script>
$(document).ready(function() {
    // Aplica a máscara de telefone para o padrão brasileiro (com DDD)
    $('#telefone').inputmask('(99) 99999-9999', { 
        'placeholder': '(__) _____-____', 
        'clearIncomplete': true 
    });
});
</script>

<?php
// Inclua o footer com o Bootstrap
include __DIR__ . '/../site/footer.php';
?>
