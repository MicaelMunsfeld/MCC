<?php

require_once __DIR__ . '/../../model/cor.php'; // Certifique-se de que o caminho do modelo está correto

class CorController {
    
    // Exibir a lista de cores
    public function index() {
        $cores = Cor::getAll();
        include __DIR__ . '/../../view/admin/corList.php'; // Inclui a listagem de cores
    }

    // Exibir o formulário de cadastro de nova cor
    public function cadastro() {
        include __DIR__ . '/../../view/admin/corCadastro.php';
    }

    // Salvar uma nova cor
    public function salvar() {
        $cor = new Cor();
        $cor->nomeCor = $_POST['nome_cor'];
        if ($cor->cadastrar()) {
            header('Location: ?page=cor&status=sucessoIncluir');
        } else {
            header('Location: ?page=cor&status=erroIncluir');
        }
    }

    // Exibir o formulário de edição de cor
    public function alterar() {
        $idCor = $_GET['id'] ?? null;
        if ($idCor) {
            $cor = Cor::find($idCor); // Busca a cor pelo ID
            include __DIR__ . '/../../view/admin/corCadastro.php'; // Reaproveita a view de cadastro
        } else {
            header('Location: ?page=cor&status=erroAlterar'); // Caso o ID não seja válido
        }
    }

    // Atualizar uma cor existente
    public function atualizar() {
        $idCor = $_POST['id_cor'];
        $cor = new Cor();
        $cor->nomeCor = $_POST['nome_cor'];
        if ($cor->update($idCor)) {
            header('Location: ?page=cor&status=sucessoAlterar');
        } else {
            header('Location: ?page=cor&status=erroAlterar');
        }
    }

    // Excluir uma cor
    public function excluir() {
        $idCor = $_GET['id'] ?? null;
        if ($idCor && Cor::delete($idCor)) {
            header('Location: ?page=cor&status=sucessoExcluir');
        } else {
            header('Location: ?page=cor&status=erroExcluir');
        }
    }
    
}