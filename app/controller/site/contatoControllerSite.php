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

            if ($contato->salvar()) {
                $_SESSION['status'] = 'sucesso';
                $_SESSION['mensagem'] = 'Contato enviado com sucesso!';
            } else {
                $_SESSION['status'] = 'erro';
                $_SESSION['mensagem'] = 'Erro ao enviar o contato. Tente novamente.';
            }
            header('Location: ?page=contato');
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