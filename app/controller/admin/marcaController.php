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
        $marca = new Marca(); // Instancia um novo objeto Marca
        $marca->nomeMarca = $_POST['nome_marca']; // Define o nome da marca a partir do formulário
        $marca->tipo = $_POST['tipo']; // Define o tipo da marca a partir do formulário
        $marca->cadastrar(); // Salva a marca no banco de dados
        header('Location: ?page=marca'); // Redireciona para a lista de marcas
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
        $id = $_POST['id']; // Obtém o ID da marca a ser atualizada
        $marca = new Marca();
        $marca->nomeMarca = $_POST['nome_marca']; // Define o novo nome da marca
        $marca->tipo = $_POST['tipo']; // Define o novo tipo da marca
        $marca->update($id); // Atualiza a marca no banco de dados
        header('Location: ?page=marca'); // Redireciona para a lista de marcas
    }

    // Método para excluir uma marca
    public function excluir() {
        $id = $_GET['id']; // Obtém o ID da marca a ser excluída
        Marca::delete($id); // Exclui a marca do banco de dados
        header('Location: ?page=marca'); // Redireciona para a lista de marcas
    }

}
?>