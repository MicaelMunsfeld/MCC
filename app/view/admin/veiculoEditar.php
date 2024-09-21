<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5 mb-5">
    <h2 class="mb-4">Editar Veículo</h2>
    
    <form action="?page=veiculo&action=atualizar&id=<?= $veiculo['ID_veiculo'] ?>" method="POST" enctype="multipart/form-data">
        <fieldset class="p-4 border rounded">
            <legend class="fw-bold text-primary">Detalhes do Veículo</legend>
            <div class="row">
                <!-- Primeira Coluna -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="imagens" class="form-label">Imagens do Veículo</label>
                        <!-- Exibe imagens já cadastradas -->
                        <?php if (!empty($imagens)): ?>
                            <div class="row">
                                <?php foreach ($imagens as $imagem): ?>
                                    <div class="col-md-3">
                                        <img src="data:image/jpeg;base64,<?= base64_encode($imagem['imagem']) ?>" class="img-thumbnail" alt="<?= htmlspecialchars($imagem['descricao']) ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <!-- Input para novas imagens -->
                        <input type="file" class="form-control" id="imagens" name="imagens[]" multiple>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo <span class="text-danger">*</span></label>
                        <select class="form-control" id="tipo" name="tipo" required>
                            <option value="">Selecione o Tipo</option>
                            <?php foreach ($tipos as $tipo): ?>
                                <option value="<?= htmlspecialchars($tipo) ?>" <?= $tipo == $veiculo['tipo'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($tipo) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca</label>
                        <select class="form-control" id="marca" name="idMarca" required>
                            <option value="">Selecione a Marca</option>
                            <?php foreach ($marcas as $marca): ?>
                                <option value="<?= htmlspecialchars($marca['ID_marca']) ?>" <?= $marca['ID_marca'] == $veiculo['ID_marca'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($marca['nome_marca']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo</label>
                        <select class="form-control" id="modelo" name="idModelo" required>
                            <option value="">Selecione o Modelo</option>
                            <?php foreach ($modelos as $modelo): ?>
                                <option value="<?= htmlspecialchars($modelo['ID_modelo']) ?>" <?= $modelo['ID_modelo'] == $veiculo['ID_modelo'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($modelo['nome_modelo']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="ano" class="form-label">Ano</label>
                        <input type="text" class="form-control" id="ano" name="ano" value="<?= htmlspecialchars($veiculo['ano']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="cor" class="form-label">Cor <span class="text-danger">*</span></label>
                        <select class="form-control" id="cor" name="idCor" required>
                            <option value="">Selecione a Cor</option>
                            <?php foreach ($cores as $cor): ?>
                                <option value="<?= htmlspecialchars($cor['ID_cor']) ?>" <?= $cor['ID_cor'] == $veiculo['ID_cor'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cor['nome_cor']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="placa" class="form-label">Placa <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="placa" name="placa" value="<?= htmlspecialchars($veiculo['placa']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="quilometragem" class="form-label">Quilometragem <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="quilometragem" name="quilometragem" value="<?= htmlspecialchars($veiculo['quilometragem']) ?>" required>
                    </div>
                </div>

                <!-- Segunda Coluna -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="valor" class="form-label">Valor <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="valor" name="valor" value="<?= htmlspecialchars($veiculo['valor']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="cambio" class="form-label">Câmbio <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="cambio" name="cambio" value="<?= htmlspecialchars($veiculo['cambio']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="combustivel" class="form-label">Combustível</label>
                        <input type="text" class="form-control" id="combustivel" name="combustivel" value="<?= htmlspecialchars($veiculo['combustivel']) ?>">
                    </div>
                    <div class="d-flex mb-3">
                        <div class="form-check form-switch me-4">
                            <input class="form-check-input" type="checkbox" id="ativo" name="ativo" <?= $veiculo['ativo'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="ativo">Ativo</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="unicoDono" name="unicoDono" <?= $veiculo['unico_dono'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="unicoDono">Único Dono</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="chassis" class="form-label">Chassis</label>
                        <input type="text" class="form-control" id="chassis" name="chassis" value="<?= htmlspecialchars($veiculo['chassis']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="antigoDono" class="form-label">Antigo Dono</label>
                        <select class="form-control" id="antigoDono" name="idAntigoDono">
                            <option value="">Selecione o Antigo Dono</option>
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?= htmlspecialchars($usuario['ID_usuario']) ?>" <?= $usuario['ID_usuario'] == $veiculo['ID_antigo_dono'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($usuario['nome_completo']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="acessorios" class="form-label">Acessórios</label>
                        <textarea class="form-control" id="acessorios" name="acessorios"><?= htmlspecialchars($veiculo['acessorios']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="observacoes" class="form-label">Observações Adicionais</label>
                        <textarea class="form-control" id="observacoes" name="observacoes"><?= htmlspecialchars($veiculo['observacoes']) ?></textarea>
                    </div>
                </div>
            </div>
        </fieldset>

        <!-- Botão de Enviar fora do fieldset -->
        <div class="d-flex mt-3">
            <button type="submit" class="btn btn-primary w-50 me-2"><?= isset($cor) ? 'Atualizar' : 'Cadastrar'; ?></button>
            <a href="?page=veiculoList" class="btn btn-secondary w-50">Cancelar</a>
        </div>
    </form>
</div>

<script src="/MCC/public/js/veiculoCadastro.js"></script> <!-- Linkando o JS externo -->
<?php include __DIR__ . '/../layout/footer.php'; ?>
