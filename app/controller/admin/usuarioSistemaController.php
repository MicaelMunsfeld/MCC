<?php

require_once __DIR__ . '/../../model/usuarioSistema.php';

class UsuarioSistemaController {
    private $usuarioSistema;

    public function __construct() {
        $this->usuarioSistema = new UsuarioSistema();
    }

    // Função para carregar a tela de cadastro de acesso do usuário
    public function cadastro() {
        $idUsuario = $_GET['id'] ?? null; // Pega o ID do usuário selecionado na lista
        // Ajuste o caminho para corresponder à localização real do arquivo
        include __DIR__ . '/../../view/admin/usuarioSistemaCadastro.php'; 
    }

    // Função para salvar os dados de acesso do usuário
    public function salvar() {
        // Captura os dados do formulário
        $this->usuarioSistema->idUsuario = $_POST['ID_usuario'];
        $this->usuarioSistema->senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Cria o hash da senha para segurança

        // Tenta salvar os dados no banco de dados
        if ($this->usuarioSistema->cadastrar()) {
            header('Location: ?page=usuarioList&status=sucesso');
        } else {
            header('Location: ?page=usuarioSistema&action=cadastro&id=' . $this->usuarioSistema->idUsuario . '&status=erro');
        }
    }

    // Função para carregar a tela de login do usuário
    public function index() {
        $idUsuario = $_GET['id'] ?? null; // Pega o ID do usuário selecionado para login
        if ($idUsuario) {
            // Se o ID do usuário for fornecido, carrega a tela de login com o usuário selecionado
            include __DIR__ . '/../../view/admin/usuarioSistemaCadastro.php'; 
        } else {
            // Caso contrário, redireciona para a lista de usuários
            header('Location: ?page=usuarioList');
        }
    }

    // Função para autenticar o usuário
    // public function autenticar() {
    //     // Captura os dados do formulário de login
    //     $email = $_POST['email'];
    //     $senha = $_POST['senha'];

    //     // Verifica se o usuário existe e a senha está correta
    //     $usuario = $this->usuarioSistema->autenticar($email, $senha);
    //     if ($usuario) {
    //         // Autenticação bem-sucedida, redireciona para a home ou outra página segura
    //         header('Location: ?page=home&status=login_sucesso');
    //     } else {
    //         // Falha na autenticação, redireciona de volta para o login com mensagem de erro
    //         header('Location: ?page=login&status=login_erro');
    //     }
    // }
}
?>
