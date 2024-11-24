<?php

require_once __DIR__ . '/../../model/contato.php';

class ContatoController {

    public function index() {
        $contatos = Contato::listar(); // Busca todos os contatos
        include __DIR__ . '/../../view/admin/contatoList.php'; // Inclui a view de listagem
    }

    public function excluir() {
        $id = $_GET['id'] ?? null;

        if ($id && Contato::excluir($id)) {
            header('Location: ?page=contatos&status=sucesso');
        } else {
            header('Location: ?page=contatos&status=erro');
        }
        exit;
    }
}