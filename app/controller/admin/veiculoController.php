<?php

require_once __DIR__ . '/../../model/veiculo.php';
require_once __DIR__ . '/../../model/marca.php';
require_once __DIR__ . '/../../model/modelo.php';
require_once __DIR__ . '/../../model/cor.php';
require_once __DIR__ . '/../../model/usuario.php';
require_once __DIR__ . '/../../model/imagemVeiculo.php';

class VeiculoController {
    private $veiculo;

    public function __construct() {
        $this->veiculo = new Veiculo();
    }

    // Função para exibir a lista de veículos
    public function index() {
        // Verifica se é uma chamada modal
        $isModal = isset($_GET['modal']) && $_GET['modal'] === 'true';
        
        $veiculos = Veiculo::getAll(); // Pega todos os veículos com seus detalhes (marca, modelo, etc.)
    
        if ($isModal) {
            // Carrega a lista de veículos no modo modal
            include __DIR__ . '/../../view/admin/veiculoListModal.php';
        } else {
            // Carrega a lista de veículos normal
            include __DIR__ . '/../../view/admin/veiculoList.php';
        }
    }
    
    
    public function modal() {
        $veiculos = Veiculo::getAll(); // Fetch all vehicles for the modal
        include __DIR__ . '/../../view/admin/veiculoListModal.php';
    }    

    public function alterar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            // Busca o veículo pelo ID
            $veiculo = Veiculo::find($id);
    
            // Carrega as listas de marcas, modelos, cores, tipos e usuários
            $marcas = Marca::listar();
            $modelos = Modelo::listar();
            $cores = Cor::getAll();
            $usuarios = Usuario::getAll(); // Carrega os usuários para "Antigo Dono"
            $tipos = array_unique(array_column($marcas, 'tipo')); // Gera a lista de tipos a partir das marcas

            // Carrega as imagens relacionadas ao veículo
            $imagens = ImagemVeiculo::buscarPorVeiculo($veiculo['ID_veiculo']);

    
            // Verifica se o veículo foi encontrado e carrega a view de edição
            if ($veiculo) {
                include __DIR__ . '/../../view/admin/veiculoEditar.php'; // View de edição do veículo
            } else {
                header('Location: ?page=veiculoList&status=erro');
            }
        } else {
            header('Location: ?page=veiculoList&status=erro');
        }
    }
    
    public function atualizar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            // Preenche os dados do veículo a partir do formulário
            $this->veiculo->ano = $_POST['ano'] ?? null;
            $this->veiculo->tipo = $_POST['tipo'] ?? null;
            $this->veiculo->idMarca = $_POST['idMarca'] ?? null;
            $this->veiculo->idModelo = $_POST['idModelo'] ?? null;
            $this->veiculo->placa = $_POST['placa'] ?? null;
            $this->veiculo->valor = $_POST['valor'] ?? null;
            $this->veiculo->quilometragem = $_POST['quilometragem'] ?? null;
            $this->veiculo->cambio = $_POST['cambio'] ?? null;
            $this->veiculo->idCor = $_POST['idCor'] ?? null;
            $this->veiculo->combustivel = $_POST['combustivel'] ?? null;
            $this->veiculo->chassis = $_POST['chassis'] ?? null;
            $this->veiculo->ativo = isset($_POST['ativo']) ? 1 : 0;
            $this->veiculo->unicoDono = isset($_POST['unicoDono']) ? 1 : 0;
            $this->veiculo->idAntigoDono = $_POST['idAntigoDono'] ?? null;
            $this->veiculo->acessorios = $_POST['acessorios'] ?? null;
            $this->veiculo->observacoes = $_POST['observacoes'] ?? null;
    
            // Tratamento de imagens: verificar se imagens foram enviadas
            if (!empty($_FILES['imagens']['name'][0])) {
                $imagens = $_FILES['imagens'];
                
                for ($i = 0; $i < count($imagens['name']); $i++) {
                    $nomeImagem = $imagens['name'][$i];
                    $imagemTemp = $imagens['tmp_name'][$i];
                    
                    // Lê o conteúdo da imagem
                    $conteudoImagem = file_get_contents($imagemTemp);
                    
                    // Salva a imagem associada ao veículo
                    ImagemVeiculo::salvarImagem($id, $conteudoImagem, $nomeImagem);
                }
            }
    
            // Atualiza o veículo no banco de dados
            if ($this->veiculo->update($id)) {
                header('Location: ?page=veiculoList&status=sucesso');
            } else {
                header('Location: ?page=veiculo&status=erroAtualizacao');
            }
        } else {
            header('Location: ?page=veiculo&status=erroAtualizacao');
        }
    }

    // Função para carregar a tela de cadastro de veículos
    public function cadastro() {
        // Carrega as listas de tipos, marcas, modelos e cores para preencher os selects na view
        $marcas = Marca::getAll(); // Busca todas as marcas
        $tipos = array_unique(array_column($marcas, 'tipo')); // Extrai os tipos únicos das marcas
        $modelos = Modelo::getAll(); // Busca todos os modelos
        $cores = Cor::getAll(); // Busca todas as cores
        $usuarios = Usuario::getAll(); // Busca todos os usuários
        include __DIR__ . '/../../view/admin/veiculoCadastro.php'; // Inclui a view de cadastro
    }

    // Função para salvar os dados do veículo
    public function salvar() {
        $id = $_POST['id'] ?? null; // Verifica se o ID existe (para edição)
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Atribuição dos dados do formulário aos atributos do objeto
            $this->veiculo->ano = $_POST['ano'];
            $this->veiculo->quilometragem = $_POST['quilometragem'];
            $this->veiculo->valor = $_POST['valor'];
            $this->veiculo->cambio = $_POST['cambio'];
            $this->veiculo->tipo = $_POST['tipo'];
            $this->veiculo->combustivel = $_POST['combustivel'];
            $this->veiculo->placa = $_POST['placa'];
            $this->veiculo->chassis = $_POST['chassis'];
            $this->veiculo->ativo = isset($_POST['ativo']) ? 1 : 0;
            $this->veiculo->unicoDono = isset($_POST['unicoDono']) ? 1 : 0;
            $this->veiculo->idAntigoDono = !empty($_POST['idAntigoDono']) ? $_POST['idAntigoDono'] : null;
            $this->veiculo->acessorios = $_POST['acessorios'];
            $this->veiculo->observacoes = $_POST['observacoes'];
            $this->veiculo->idMarca = $_POST['idMarca'];
            $this->veiculo->idModelo = $_POST['idModelo'];
            $this->veiculo->idCor = $_POST['idCor'];
    
            if ($id) {
                // Atualizar o veículo
                if ($this->veiculo->update($id)) {
                    header('Location: ?page=veiculoList&status=sucesso');
                    exit;
                } else {
                    header('Location: ?page=veiculo&status=erroCadastro');
                    exit;
                }
            } else {
                // Inserir novo veículo
                if ($this->veiculo->cadastrar()) {
                    header('Location: ?page=veiculoList&status=sucesso');
                    exit;
                } else {
                    header('Location: ?page=veiculo&status=erroCadastro');
                    exit;
                }
            }
        } else {
            header('Location: ?page=veiculo');
            exit;
        }
    }

    // Função para excluir um veículo
    public function excluir() {
        $id = $_GET['id'] ?? null;
        if ($id && Veiculo::deleteById($id)) {
            header('Location: ?page=veiculoList&status=excluido');
        } else {
            header('Location: ?page=veiculoList&status=erro');
        }
    }
    

}