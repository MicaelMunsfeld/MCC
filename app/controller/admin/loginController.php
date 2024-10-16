<?php

class LoginController {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomeCompleto = $_POST['nomeCompleto'] ?? '';
            $senha = $_POST['senha'] ?? '';

            // Separar o nome e sobrenome
            $partesNome = explode(' ', $nomeCompleto);
            $nome = $partesNome[0] ?? '';
            $sobrenome = isset($partesNome[1]) ? $partesNome[1] : '';

            // Buscar usuário
            $usuario = Usuario::findByNomeSobrenome($nome, $sobrenome);

            if ($usuario) {
                // Verificar a senha
                $senhaCorreta = UsuarioSistema::verificarSenha($usuario['ID_usuario'], $senha);

                if ($senhaCorreta) {
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
}