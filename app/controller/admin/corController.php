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
        $cor->cadastrar();
        header('Location: ?page=cor');
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
        $cor->nomeCor = $_POST['nome_cor']; // Atualiza o nome da cor
        if ($cor->update($idCor)) {
            header('Location: ?page=cor');
        } else {
            header('Location: ?page=cor&status=erroAtualizar');
        }
    }

    // Excluir uma cor
    public function excluir() {
        $idCor = $_GET['id'] ?? null; // Obtém o ID da cor para exclusão
        if ($idCor) {
            $excluido = Cor::delete($idCor); // Chama o método de exclusão no modelo
            if ($excluido) {
                header('Location: ?page=cor'); // Redireciona após exclusão com sucesso
            } else {
                header('Location: ?page=cor&status=erroExcluir'); // Redireciona em caso de falha
            }
        } else {
            header('Location: ?page=cor&status=erroExcluir'); // Caso o ID não seja válido
        }
    }
}
