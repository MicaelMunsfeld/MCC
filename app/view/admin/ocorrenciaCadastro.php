<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5 mb-5">
    <h2>Cadastrar Ocorrência</h2>
    
    <form action="?page=ocorrencia&action=salvar" method="POST">
        <fieldset class="p-4 border rounded">
            <legend class="fw-bold text-primary">Detalhes da Ocorrência</legend>

            <!-- Botão Selecionar Veículo -->
            <div class="mb-3 d-flex">
                <div class="flex-grow-1 me-3">
                    <label for="veiculo_info" class="form-label">Veículo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="veiculo_info" name="veiculo_info" placeholder="Selecione o Veículo" required>
                    <input type="hidden" id="ID_veiculo" name="ID_veiculo" required>
                </div>
                <div class="align-self-end">
                    <button type="button" id="selecionarVeiculoBtn" class="btn btn-secondary mt-2">Selecionar Veículo</button>
                </div>
            </div>

            <!-- Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>

            <!-- Descrição -->
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição <span class="text-danger">*</span></label>
                <textarea class="form-control" id="descricao" name="descricao" required></textarea>
            </div>

            <!-- Data e Hora -->
            <div class="mb-3">
                <label for="data_hora" class="form-label">Data e Hora <span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" id="data_hora" name="data_hora" required>
            </div>

            <!-- Estado -->
            <div class="mb-3">
                <label for="estado" class="form-label">Estado <span class="text-danger">*</span></label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="">Selecione o Estado</option>
                    <!-- Opções preenchidas pela API do IBGE -->
                </select>
            </div>

            <!-- Cidade -->
            <div class="mb-3">
                <label for="cidade" class="form-label">Cidade <span class="text-danger">*</span></label>
                <select class="form-control" id="cidade" name="cidade" required>
                    <option value="">Selecione a Cidade</option>
                    <!-- Opções preenchidas pela API do IBGE -->
                </select>
            </div>

            <!-- Endereço -->
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="endereco" name="endereco" required>
            </div>
        </fieldset>

        <!-- Botões de Ação -->
        <div class="d-flex mt-3">
            <button type="submit" class="btn btn-primary w-50">Confirmar</button>
            <a href="?page=ocorrencia" class="btn btn-secondary w-50">Cancelar</a>
        </div>
    </form>
</div>

<script src="/MCC/public/js/ocorrenciaCadastro.js"></script> <!-- Script para API do IBGE e Modal de Seleção de Veículo -->

<?php include __DIR__ . '/../layout/footer.php'; ?>
