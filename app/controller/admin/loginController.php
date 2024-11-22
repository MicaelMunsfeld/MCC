<?php

class LoginController {

    public function login() {
        // Verifica se o formulário foi enviado via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomeCompleto = $_POST['nomeCompleto'] ?? '';
            $senha = $_POST['senha'] ?? '';

            // Separar o nome e sobrenome
            $partesNome = explode(' ', $nomeCompleto);
            $nome = $partesNome[0] ?? '';
            $sobrenome = isset($partesNome[1]) ? $partesNome[1] : '';

            // Buscar o usuário com base no nome e sobrenome
            $usuario = Usuario::findByNomeSobrenome($nome, $sobrenome);

            if ($usuario) {
                // Verificar a senha
                if (UsuarioSistema::verificarSenha($usuario['ID_usuario'], $senha)) {
                    // Senha correta - Login bem-sucedido
                    $_SESSION['login_success'] = 'Login bem-sucedido! Bem-vindo, ' . $nomeCompleto . '!';

                    // Exibir mensagem de sucesso
                    echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
                          <div class='d-flex justify-content-center align-items-center vh-100'>
                            <div class='alert alert-success text-center' role='alert'>
                                Login bem-sucedido! Bem-vindo, {$nomeCompleto}!
                            </div>
                          </div>";
                    echo "<script>
                            setTimeout(function() {
                                window.location.href = 'index.php?page=inicio';
                            }, 3000);
                          </script>";
                } else {
                    // Senha incorreta
                    $_SESSION['login_error'] = 'Senha incorreta!';
                    echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
                          <div class='d-flex justify-content-center align-items-center vh-100'>
                            <div class='alert alert-danger text-center' role='alert'>
                                Senha incorreta!
                            </div>
                          </div>";
                    echo "<script>
                            setTimeout(function() {
                                window.location.href = 'index.php?page=home';
                            }, 3000);
                          </script>";
                }
            } else {
                // Usuário não encontrado
                $_SESSION['login_error'] = 'Usuário não encontrado!';
                echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
                      <div class='d-flex justify-content-center align-items-center vh-100'>
                        <div class='alert alert-danger text-center' role='alert'>
                            Usuário não encontrado!
                        </div>
                      </div>";
                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'index.php?page=home';
                        }, 3000);
                      </script>";
            }
        } else {
            // Se não houver POST, exibe a tela de login normalmente
            include __DIR__ . '/../../view/admin/usuarioSistemaCadastro.php';
        }
    }
}
