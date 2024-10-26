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

    // Função para salvar ou atualizar os dados de acesso do usuário
    public function salvar() {
        // Captura os dados do formulário
        $this->usuarioSistema->idUsuario = $_POST['ID_usuario'];
        $this->usuarioSistema->senha = md5($_POST['senha']); // Cria o hash da senha para segurança

        // Salvar ou atualizar senha
        if ($this->usuarioSistema->salvar()) {
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
    public function autenticar() {
        // Captura os dados do formulário de login
        $nomeCompleto = $_POST['nomeCompleto'] ?? '';
        $senha = $_POST['senha'] ?? '';

        // Separar o nome e sobrenome
        $partesNome = explode(' ', $nomeCompleto);
        $nome = $partesNome[0] ?? '';
        $sobrenome = isset($partesNome[1]) ? $partesNome[1] : '';

        // Buscar o usuário pelo nome e sobrenome
        $usuario = Usuario::findByNomeSobrenome($nome, $sobrenome);

        if ($usuario) {
            // Verificar a senha
            if (UsuarioSistema::verificarSenha($usuario['ID_usuario'], $senha)) {
                // Login bem-sucedido
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Login bem-sucedido!',
                        text: 'Bem-vindo, {$nomeCompleto}!',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = 'index.php?page=inicio';
                    });
                </script>";
            } else {
                // Senha incorreta
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'Senha incorreta!',
                    });
                </script>";
            }
        } else {
            // Usuário não encontrado
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Usuário não encontrado!',
                });
            </script>";
        }
    }
}
