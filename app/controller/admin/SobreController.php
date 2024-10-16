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
            if (Sobre::salvarSobre($conteudo)) {
                $_SESSION['status'] = 'sucesso';
                $_SESSION['mensagem'] = 'Informações sobre a empresa salvas com sucesso!';
            } else {
                $_SESSION['status'] = 'erro';
                $_SESSION['mensagem'] = 'Erro ao salvar as informações sobre a empresa.';
            }
            header('Location: ?page=inicio');
            exit;
        }
    }
}