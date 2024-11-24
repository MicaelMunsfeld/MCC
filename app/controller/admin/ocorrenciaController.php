<?php

require_once __DIR__ . '/../../model/ocorrencia.php';
require_once __DIR__ . '/../../model/veiculo.php';

class OcorrenciaController {

    public function index() {
        $ocorrencias = Ocorrencia::listar();
        include __DIR__ . '/../../view/admin/ocorrenciaList.php';
    }

    public function cadastro() {
        $veiculos = Veiculo::getAll(); // Carrega os veículos para o dropdown
        include __DIR__ . '/../../view/admin/ocorrenciaCadastro.php';
    }

    public function alterar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            // Busca a ocorrência pelo ID
            $ocorrencia = Ocorrencia::find($id);
            
            // Verifica se a ocorrência foi encontrada e busca o nome do veículo relacionado
            if ($ocorrencia) {
                $veiculo = Veiculo::getById($ocorrencia['ID_veiculo']);
                
                if ($veiculo) {
                    // Concatena a marca, modelo e placa para exibir o nome completo do veículo
                    $veiculo_nome = $veiculo['nome_marca'] . ' ' . $veiculo['nome_modelo'] . ' - ' . $veiculo['placa'];
                } else {
                    // Caso o veículo não seja encontrado, define um valor vazio
                    $veiculo_nome = 'Veículo não encontrado';
                }
    
                // Adiciona a busca dos estados usando a API do IBGE ou um método estático que retorna os estados
                $estados = $this->getEstados(); // Método que carrega a lista de estados
    
                // Carrega a view de edição com os dados da ocorrência e do veículo
                include __DIR__ . '/../../view/admin/ocorrenciaEditar.php'; 
            } else {
                header('Location: ?page=ocorrenciaList&status=erro');
            }
        } else {
            header('Location: ?page=ocorrenciaList&status=erro');
        }
    }
    
    // Método para buscar estados (simulação ou integração com API do IBGE)
    private function getEstados() {
        // Simulação: Pode ser uma integração com a API do IBGE para buscar os estados
        return [
            ['id' => '1', 'nome' => 'Acre'],
            ['id' => '2', 'nome' => 'Alagoas'],
            // Continue com a lista dos estados...
        ];
    }    
    
    public function atualizar() {
        $id = $_GET['id'] ?? null;
    
        if ($id) {
            $ocorrencia = new Ocorrencia();
            $ocorrencia->titulo = $_POST['titulo'];
            $ocorrencia->descricao = $_POST['descricao'];
            $ocorrencia->data_hora = $_POST['data_hora'];
            $ocorrencia->cidade = $_POST['cidade'];
            $ocorrencia->endereco = $_POST['endereco'];
            $ocorrencia->estado = $_POST['estado'];
            $ocorrencia->ID_veiculo = $_POST['ID_veiculo'];
    
            if ($ocorrencia->update($id)) {
                header('Location: ?page=ocorrencia&status=sucessoAlterar');
            } else {
                header('Location: ?page=ocorrencia&status=erroAlterar');
            }
        }
    }       

    public function salvar() {
        $ocorrencia = new Ocorrencia();
        $ocorrencia->ID_veiculo = $_POST['ID_veiculo'];
        $ocorrencia->titulo = $_POST['titulo'];
        $ocorrencia->descricao = $_POST['descricao'];
        $ocorrencia->data_hora = $_POST['data_hora'];
        $ocorrencia->estado = $_POST['estado'];
        $ocorrencia->cidade = $_POST['cidade'];
        $ocorrencia->endereco = $_POST['endereco'];
        if ($ocorrencia->cadastrar()) {
            header('Location: ?page=ocorrencia&status=sucessoIncluir');
        } else {
            header('Location: ?page=ocorrencia&status=erroIncluir');
        }
    }    
    
    public function excluir() {
        $id = $_GET['id'] ?? null;
        if ($id && Ocorrencia::deleteById($id)) {
            header('Location: ?page=ocorrencia&status=sucessoExcluir');
        } else {
            header('Location: ?page=ocorrencia&status=erroExcluir');
        }
    }
    
}