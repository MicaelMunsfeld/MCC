<?php

require_once __DIR__ . '/../../model/Contato.php';

class contatoControllerSite {

    public function index() {
        include __DIR__ . '/../../view/site/contato.php';
    }

    public function salvarContato() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Cria uma instância do model Contato
            $contato = new Contato();
            $contato->nome = $_POST['nome'];
            $contato->telefone = $_POST['telefone'];
            $contato->email = $_POST['email'];
            $contato->cidade = $_POST['cidade'];
            $contato->estado = $_POST['estado'];
            $contato->assunto = $_POST['assunto'];
            $contato->mensagem = $_POST['mensagem'] ?? null;

            // Tenta salvar o contato
            $status = $contato->salvar();

            if ($status) {
                $mensagem = 'Contato enviado com sucesso!';
                $tipo = 'success';
                $titulo = 'Sucesso!';
                $redirecionamento = '?page=contato';
            } else {
                $mensagem = 'Erro ao enviar o contato. Tente novamente.';
                $tipo = 'error';
                $titulo = 'Erro!';
                $redirecionamento = '?page=contato';
            }

            // Gera o HTML para exibir o SweetAlert
            echo "<!DOCTYPE html>
            <html lang='pt-BR'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <title>{$titulo}</title>
            </head>
            <body>
                <script>
                    Swal.fire({
                        icon: '{$tipo}',
                        title: '{$titulo}',
                        text: '{$mensagem}',
                    }).then(() => {
                        window.location.href = '{$redirecionamento}';
                    });
                </script>
            </body>
            </html>";
            exit;
        }
    }
    
    public function visualizar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $contato = Contato::find($id); // Busca o contato pelo ID
            if ($contato) {
                include __DIR__ . '/../../view/admin/contatoVisualizar.php'; // Inclui a view de visualização
            } else {
                $_SESSION['status'] = 'erro';
                $_SESSION['mensagem'] = 'Contato não encontrado.';
                header('Location: ?page=contatoList');
                exit;
            }
        } else {
            $_SESSION['status'] = 'erro';
            $_SESSION['mensagem'] = 'ID de contato inválido.';
            header('Location: ?page=contatoList');
            exit;
        }
    }

}