<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="container mt-5 mb-5">
    <fieldset class="p-4 border rounded">
        <legend>Detalhes do Contato</legend>
        <div class="row">
            <!-- Coluna 1 -->
            <div class="col-md-6">
                <!-- Campo: Nome -->
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" value="<?= htmlspecialchars($contato['nome']) ?>" disabled>
                </div>
                
                <!-- Campo: Telefone -->
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" value="<?= htmlspecialchars($contato['telefone']) ?>" disabled>
                </div>
                
                <!-- Campo: E-mail -->
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($contato['email']) ?>" disabled>
                </div>
                
                <!-- Campo: Estado -->
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select id="estado" class="form-control" data-selected="<?= htmlspecialchars($contato['estado']) ?>" disabled>
                        <!-- Estados carregados dinamicamente pela API do IBGE -->
                    </select>
                </div>
                <!-- Campo: Cidade -->
                <div class="mb-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <select id="cidade" class="form-control" data-selected="<?= htmlspecialchars($contato['cidade']) ?>" disabled>
                        <!-- Cidades carregadas dinamicamente pela API do IBGE -->
                    </select>
                </div>
            </div>

            <!-- Coluna 2 -->
            <div class="col-md-6">
                <!-- Campo: Data/Hora -->
                <div class="mb-3">
                    <label for="data_hora" class="form-label">Data/Hora</label>
                    <input type="text" class="form-control" id="data_hora" value="<?= date('d/m/Y H:i', strtotime($contato['data_hora'])) ?>" disabled>
                </div>
                
                <!-- Campo: Assunto -->
                <div class="mb-3">
                    <label for="assunto" class="form-label">Assunto</label>
                    <input type="text" class="form-control" id="assunto" value="<?= htmlspecialchars($contato['assunto']) ?>" disabled>
                </div>

                <!-- Campo: Mensagem -->
                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem</label>
                    <textarea class="form-control" id="mensagem" rows="5" disabled><?= htmlspecialchars($contato['mensagem']) ?></textarea>
                </div>

            </div>
        </div>
    </fieldset>
    <div class="d-flex mt-3">
        <a href="?page=contatos" class="btn btn-secondary w-100">Voltar</a>
    </div>
</div>

<script src="/MCC/public/js/contatoVisualizar.js"></script>
<?php include __DIR__ . '/../layout/footer.php'; ?>