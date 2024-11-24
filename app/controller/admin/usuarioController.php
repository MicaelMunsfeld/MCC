<?php

require_once __DIR__ . '/../../model/usuario.php';

class UsuarioController {
    private $usuario;

    public function __construct() {
        $this->usuario = new Usuario();
    }

    // Função para exibir a lista de usuários
    public function index() {
        $usuarios = Usuario::getAll();
        include __DIR__ . '/../../view/admin/usuarioList.php';
    }

    // Função para carregar a tela de cadastro de usuários
    public function cadastro() {
        include __DIR__ . '/../../view/admin/usuarioCadastro.php';
    }

    // Função para exibir a tela de edição de um usuário específico
    public function alterar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            // Busca o usuário pelo ID usando o modelo Usuario
            $usuario = Usuario::getById($id);
            include __DIR__ . '/../../view/admin/usuarioEditar.php';
        } else {
            header('Location: ?page=usuarioList'); // Redireciona se o ID não for válido
        }
    }

    // Função para salvar os dados do usuário
    public function salvar() {
        $id = $_GET['id'] ?? null;
    
        $this->usuario->nome = $_POST['nome'];
        $this->usuario->sobrenome = $_POST['sobrenome'];
        $this->usuario->telefone = $_POST['telefone'];
        $this->usuario->sexo = $_POST['sexo'];
        $this->usuario->email = $_POST['email'];
        $this->usuario->cidade = $_POST['cidade'];
        $this->usuario->estado = $_POST['estado'];
        $this->usuario->tipo_usuario = $_POST['tipo_usuario'];
    
        if ($id) {
            if ($this->usuario->alterar($id)) {
                header('Location: ?page=usuarioList&status=sucessoAlterar');
            } else {
                header('Location: ?page=usuario&action=alterar&id=' . $id . '&status=erroAlterar');
            }
        } else {
            if ($this->usuario->cadastrar()) {
                header('Location: ?page=usuarioList&status=sucessoIncluir');
            } else {
                header('Location: ?page=usuario&action=cadastro&status=erroIncluir');
            }
        }
    }

    // Função para excluir um usuário
    public function excluir() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            try {
                Usuario::deleteById($id);
                header('Location: ?page=usuarioList&status=sucessoExcluir');
            } catch (PDOException $e) {
                if ($e->getCode() === '23503') { // Código de erro para violação de chave estrangeira no PostgreSQL
                    header('Location: ?page=usuarioList&status=erroChaveEstrangeira');
                } else {
                    header('Location: ?page=usuarioList&status=erroExcluir');
                }
            }
        } else {
            header('Location: ?page=usuarioList&status=erroExcluir');
        }
    }
    
}