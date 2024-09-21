<?php

require_once __DIR__ . '/../../model/movimentacao.php';
require_once __DIR__ . '/../../model/veiculo.php';
require_once __DIR__ . '/../../model/usuario.php';

class MovimentacaoController {
    private $movimentacao;

    public function __construct() {
        $this->movimentacao = new Movimentacao();
    }

    // Listar as movimentações
    public function index() {
        $movimentacoes = Movimentacao::listar();
        include __DIR__ . '/../../view/admin/movimentacaoList.php';
    }

    // Carregar a tela de cadastro
    public function cadastro() {
        $veiculos = Veiculo::getAll();
        $usuarios = Usuario::getAll();
        include __DIR__ . '/../../view/admin/movimentacaoCadastro.php';
    }

    public function veiculoListSelecionar() {
        $veiculos = Veiculo::getAll(); // Recupera todos os veículos do banco de dados
        include __DIR__ . '/../../view/admin/veiculoListModal.php'; // Exibe a view de seleção de veículo
    }    

    // Salvar uma movimentação
    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->movimentacao->data_hora = $_POST['data_hora'];
            $this->movimentacao->tipo = $_POST['tipo'];
            $this->movimentacao->ID_veiculo = $_POST['ID_veiculo'];
            $this->movimentacao->ID_usuario = $_POST['ID_usuario'];
            
            if ($this->movimentacao->cadastrar()) {
                header('Location: ?page=movimentacao&status=sucesso');
            } else {
                header('Location: ?page=movimentacao&status=erroCadastro');
            }
        }
    }
}
