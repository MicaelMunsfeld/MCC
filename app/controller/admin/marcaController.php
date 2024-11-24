<?php

require_once __DIR__ . '/../../model/marca.php'; // Inclui o model Marca

class MarcaController {

    // Método para exibir a lista de marcas
    public function index() {
        $marcas = Marca::listar(); // Chama o método estático para listar todas as marcas
        include realpath(__DIR__ . '/../../view/admin/marcaList.php'); // Inclui a view de listagem de marcas
    }

    // Método para exibir o formulário de cadastro de nova marca
    public function cadastro() {
        include realpath(__DIR__ . '/../../view/admin/marcaCadastro.php'); // Inclui a view de cadastro de marcas
    }

    // Método para salvar uma nova marca
    public function salvar() {
        $marca = new Marca();
        $marca->nomeMarca = $_POST['nome_marca'];
        $marca->tipo = $_POST['tipo'];
        
        if ($marca->cadastrar()) {
            header('Location: ?page=marca&status=sucessoIncluir');
        } else {
            header('Location: ?page=marca&status=erroIncluir');
        }
    }

    // Método para exibir o formulário de edição de uma marca
    public function alterar() {
        $id = $_GET['id']; // Obtém o ID da marca a ser editada
        $marca = Marca::find($id); // Busca a marca pelo ID
        // Verifica se a marca foi encontrada antes de incluir a view
        if ($marca) {
            include realpath(__DIR__ . '/../../view/admin/marcaEditar.php'); // Inclui a view de edição de marcas
        } else {
            echo "Erro: Marca não encontrada."; // Exibe mensagem de erro se a marca não for encontrada
        }
    }

    // Método para atualizar uma marca existente
    public function atualizar() {
        $id = $_POST['id'];
        $marca = new Marca();
        $marca->nomeMarca = $_POST['nome_marca'];
        $marca->tipo = $_POST['tipo'];
        
        if ($marca->update($id)) {
            header('Location: ?page=marca&status=sucessoAlterar');
        } else {
            header('Location: ?page=marca&status=erroAlterar');
        }
    }

    // Método para excluir uma marca
    public function excluir() {
        $id = $_GET['id'];
        if (Marca::delete($id)) {
            header('Location: ?page=marca&status=sucessoExcluir');
        } else {
            header('Location: ?page=marca&status=erroExcluir');
        }
    }

}