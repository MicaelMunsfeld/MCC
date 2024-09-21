<!-- veiculoCadastro.php -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/header.php'; ?>

<div class="container mt-5 mb-5">
    <!-- Mensagens de Sucesso ou Erro -->
    <?php if (isset($_GET['status'])): ?>
        <div class="alert alert-dismissible fade show mt-3 
            <?php 
                echo $_GET['status'] === 'sucesso' ? 'alert-success' : 'alert-danger'; 
            ?>" role="alert">
            <?php 
                if ($_GET['status'] === 'sucesso') {
                    echo 'Veículo cadastrado com sucesso!';
                } elseif ($_GET['status'] === 'erroCadastro') {
                    echo 'Erro ao cadastrar o veículo. Tente novamente.';
                } elseif ($_GET['status'] === 'erroImagem') {
                    echo 'Erro ao fazer upload da imagem. Tente novamente.';
                }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <h2 class="mb-4">Cadastro de Veículo</h2>
    <form action="?page=veiculo&action=salvar" method="POST" enctype="multipart/form-data">
        <fieldset class="p-4 border rounded">
            <legend class="fw-bold text-primary">Detalhes do Veículo</legend>
            <div class="row">
                <!-- Primeira Coluna -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="imagens" class="form-label">Imagens do Veículo <span class="text-danger">*</span></label>
                        <!-- Adicionando o atributo multiple -->
                        <input type="file" class="form-control" id="imagens" name="imagens[]" multiple required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo <span class="text-danger">*</span></label>
                        <select class="form-control" id="tipo" name="tipo" required>
                            <option value="">Selecione o Tipo</option>
                            <?php 
                            // Exibe os tipos carregados do banco de dados
                            foreach ($tipos as $tipo) {
                                echo '<option value="' . htmlspecialchars($tipo) . '">' . htmlspecialchars($tipo) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca <span class="text-danger">*</span></label>
                        <select class="form-control" id="marca" name="idMarca" required disabled>
                            <option value="">Selecione a Marca</option>
                            <?php foreach ($marcas as $marca): ?>
                                <option value="<?= htmlspecialchars($marca['ID_marca']); ?>" data-tipo="<?= htmlspecialchars($marca['tipo']); ?>" data-fipe="<?= htmlspecialchars($marca['nome_marca']); ?>">
                                    <?= htmlspecialchars($marca['nome_marca']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo <span class="text-danger">*</span></label>
                        <select class="form-control" id="modelo" name="idModelo" required disabled>
                            <option value="">Selecione o Modelo</option>
                            <?php foreach ($modelos as $modelo): ?>
                                <option value="<?= htmlspecialchars($modelo['ID_modelo']); ?>" data-marca="<?= htmlspecialchars($modelo['ID_marca']); ?>">
                                    <?= htmlspecialchars($modelo['nome_modelo']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ano" class="form-label">Ano <span class="text-danger">*</span></label>
                        <select class="form-control" id="ano" name="ano" required disabled>
                            <option value="">Selecione o Ano</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cor" class="form-label">Cor <span class="text-danger">*</span></label>
                        <select class="form-control" id="cor" name="idCor" required>
                            <option value="">Selecione a Cor</option>
                            <?php foreach ($cores as $cor): ?>
                                <option value="<?= htmlspecialchars($cor['ID_cor']); ?>"><?= htmlspecialchars($cor['nome_cor']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="placa" class="form-label">Placa <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="placa" name="placa" required>
                    </div>
                    <div class="mb-3">
                        <label for="quilometragem" class="form-label">Quilometragem <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="quilometragem" name="quilometragem" required>
                    </div>
                </div>

                <!-- Segunda Coluna -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="valor" class="form-label">Valor <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="valor" name="valor" required>
                    </div>
                    <div class="mb-3">
                        <label for="cambio" class="form-label">Câmbio <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="cambio" name="cambio" required>
                    </div>
                    <div class="mb-3">
                        <label for="combustivel" class="form-label">Combustível</label>
                        <input type="text" class="form-control" id="combustivel" name="combustivel">
                    </div>
                    <div class="d-flex mb-3">
                        <div class="form-check form-switch me-4">
                            <input class="form-check-input" type="checkbox" id="ativo" name="ativo" checked>
                            <label class="form-check-label" for="ativo">Ativo</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="unicoDono" name="unicoDono" checked>
                            <label class="form-check-label" for="unicoDono">Único Dono</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="chassis" class="form-label">Chassis <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="chassis" name="chassis" required>
                    </div>
                    <div class="mb-3">
                        <label for="idAntigoDono" class="form-label">Antigo Dono</label>
                        <select class="form-control" id="idAntigoDono" name="idAntigoDono">
                            <option value="">Selecione o Antigo Dono</option>
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?= htmlspecialchars($usuario['ID_usuario']); ?>">
                                    <?= htmlspecialchars($usuario['nome_completo']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="acessorios" class="form-label">Acessórios</label>
                        <textarea class="form-control" id="acessorios" name="acessorios"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="observacoes" class="form-label">Observações Adicionais</label>
                        <textarea class="form-control" id="observacoes" name="observacoes"></textarea>
                    </div>
                </div>
            </div>
        </fieldset>
        
        <!-- Botão de Enviar fora do fieldset, largura total -->
        <div class="d-flex mt-3">
            <button type="submit" class="btn btn-primary w-50 me-2"><?= isset($cor) ? 'Atualizar' : 'Cadastrar'; ?></button>
            <a href="?page=veiculoList" class="btn btn-secondary w-50">Cancelar</a>
        </div>
    </form>
</div>

<script src="/MCC/public/js/veiculoCadastro.js"></script> <!-- Linking the external JS file -->

<?php include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/footer.php'; ?>
