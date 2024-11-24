<?php

require_once __DIR__ . '/../../model/Sobre.php';

class SobreController {
    
    public function index() {
        // Carrega o conteúdo atual sobre a empresa
        $sobre = Sobre::getSobre();
        include __DIR__ . '/../../view/admin/sobreManutencao.php';
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conteudo = $_POST['conteudo'] ?? '';
            $status = Sobre::salvarSobre($conteudo);

            if ($status) {
                $mensagem = 'Informações sobre a empresa salvas com sucesso!';
                $tipo = 'success';
                $titulo = 'Sucesso!';
                $redirecionamento = '?page=inicio';
            } else {
                $mensagem = 'Erro ao salvar as informações sobre a empresa.';
                $tipo = 'error';
                $titulo = 'Erro!';
                $redirecionamento = '?page=inicio';
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
}