<?php include 'header.php'; ?>
<div class="container">
    <h1>Entre em Contato</h1>
    <form action="?page=site&action=salvarContato" method="POST">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select id="estado" name="estado" class="form-control" required></select>
        </div>
        <div class="form-group">
            <label for="cidade">Cidade</label>
            <select id="cidade" name="cidade" class="form-control" required></select>
        </div>
        <div class="form-group">
            <label for="assunto">Assunto</label>
            <input type="text" class="form-control" id="assunto" name="assunto" required>
        </div>
        <div class="form-group">
            <label for="mensagem">Mensagem</label>
            <textarea class="form-control" id="mensagem" name="mensagem" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <div id="mapa">
        <!-- Mapa da localização da empresa -->
    </div>
</div>
<?php include 'footer.php'; ?>
