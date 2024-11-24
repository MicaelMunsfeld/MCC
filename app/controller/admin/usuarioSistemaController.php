<?php

require_once __DIR__ . '/../../model/usuarioSistema.php';

class UsuarioSistemaController {
    private $usuarioSistema;

    public function __construct() {
        $this->usuarioSistema = new UsuarioSistema();
    }

    // Função para carregar a tela de cadastro de acesso do usuário
    public function cadastro() {
        $idUsuario = $_GET['id'] ?? null;
        include __DIR__ . '/../../view/admin/usuarioSistemaCadastro.php';
    }

    // Função para salvar ou atualizar os dados de acesso do usuário
    public function salvar() {
        // Captura os dados do formulário
        $this->usuarioSistema->idUsuario = $_POST['ID_usuario'];
        $senha = $_POST['senha'];

        // Validação para senha curta
        if (strlen($senha) < 5) {
            echo "<!DOCTYPE html>
            <html lang='pt-BR'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <title>Erro</title>
            </head>
            <body>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'A senha deve ter no mínimo 5 caracteres!',
                    }).then(() => {
                        window.history.back();
                    });
                </script>
            </body>
            </html>";
            exit;
        }
        $this->usuarioSistema->senha = md5($senha); // Cria o hash da senha para segurança
        try {
            if ($this->usuarioSistema->salvar()) {
                echo "<!DOCTYPE html>
                <html lang='pt-BR'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                    <title>Sucesso</title>
                </head>
                <body>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Sucesso!',
                            text: 'Acesso configurado com sucesso!',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = '?page=usuarioList';
                        });
                    </script>
                </body>
                </html>";
            } else {
                throw new Exception('Erro ao salvar os dados.');
            }
        } catch (Exception $e) {
            echo "<!DOCTYPE html>
            <html lang='pt-BR'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <title>Erro</title>
            </head>
            <body>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'Não foi possível configurar o acesso. Tente novamente.',
                    }).then(() => {
                        window.history.back();
                    });
                </script>
            </body>
            </html>";
        }        
    }

    // Função para autenticar o usuário
    public function autenticar() {
        $nomeCompleto = $_POST['nomeCompleto'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $partesNome = explode(' ', $nomeCompleto);
        $nome = $partesNome[0] ?? '';
        $sobrenome = isset($partesNome[1]) ? $partesNome[1] : '';

        $usuario = Usuario::findByNomeSobrenome($nome, $sobrenome);

        if ($usuario) {
            if (UsuarioSistema::verificarSenha($usuario['ID_usuario'], $senha)) {
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
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'Senha incorreta!',
                    });
                </script>";
            }
        } else {
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