<?php

require_once __DIR__ . '/../../model/modelo.php';
require_once __DIR__ . '/../../model/marca.php'; // Inclui a marca para listagem das marcas disponíveis

class ModeloController {

    // Exibir a lista de modelos
    public function index() {
        $modelos = Modelo::listar();
        include __DIR__ . '/../../view/admin/modeloList.php';
    }

    // Exibir o formulário de criação de novo modelo
    public function cadastro() {
        $marcas = Marca::listar(); // Pega as marcas disponíveis para preencher o select
        include __DIR__ . '/../../view/admin/modeloCadastro.php';
    }

    // Salvar um novo modelo
    public function salvar() {
        $modelo = new Modelo();
        $modelo->nomeModelo = $_POST['nome_modelo'];
        $modelo->idMarca = $_POST['id_marca'];
        $modelo->cadastrar();
        header('Location: ?page=modelo');
    }

    // Exibir o formulário de edição de modelo
    public function alterar() {
        $id = $_GET['id'];
        $modelo = Modelo::find($id);
        $marcas = Marca::listar();
        include realpath(__DIR__ . '/../../view/admin/modeloEditar.php'); // Verifique se o caminho está correto
    }

    // Atualizar um modelo existente
    public function atualizar() {
        $id = $_POST['id'];
        $modelo = new Modelo();
        $modelo->nomeModelo = $_POST['nome_modelo'];
        $modelo->idMarca = $_POST['id_marca'];
        $modelo->update($id);
        header('Location: ?page=modelo');
    }

    // Excluir um modelo
    public function excluir() {
        $id = $_GET['id'];
        Modelo::delete($id);
        header('Location: ?page=modelo');
    }
}
?>
