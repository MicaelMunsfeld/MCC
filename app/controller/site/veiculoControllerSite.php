<?php

require_once __DIR__ . '/../../model/Veiculo.php';
require_once __DIR__ . '/../../model/Marca.php';
require_once __DIR__ . '/../../model/Modelo.php';

class veiculoControllerSite {

    public function index() {
        // Coletar os filtros da requisição via POST
        $filtros = [
            'marca' => !empty($_POST['marca']) ? $_POST['marca'] : null,
            'modelo' => !empty($_POST['modelo']) ? $_POST['modelo'] : null,
            'ano' => !empty($_POST['ano']) ? $_POST['ano'] : null,
            'preco_min' => !empty($_POST['preco_min']) ? $this->formatarPreco($_POST['preco_min']) : null,
            'preco_max' => !empty($_POST['preco_max']) ? $this->formatarPreco($_POST['preco_max']) : null
        ];

        // Obter lista de veículos filtrados
        $veiculos = Veiculo::getAllFiltered($filtros);

        // Obter todas as marcas e modelos para os filtros
        $marcas = Marca::getAll();
        $modelos = Modelo::getAll();

        // Definir o número de veículos por página
        $limitePorPagina = 6;
        
        // Capturar a página atual (padrão é 1)
        $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

        // Garantir que a página atual nunca seja menor que 1
        if ($paginaAtual < 1) {
            $paginaAtual = 1;
        }

        $offset = ($paginaAtual - 1) * $limitePorPagina;

        // Buscar o número total de veículos
        $totalVeiculos = Veiculo::contarVeiculosAtivos(); // Essa função deve retornar o total de veículos ativos

        // Calcular o número total de páginas
        $totalPages = ceil($totalVeiculos / $limitePorPagina);

        // Buscar os veículos para a página atual
        $veiculos = Veiculo::obterVeiculosPaginados($limitePorPagina, $offset); // Essa função deve retornar os veículos com base no limite e offset

        // Enviar as variáveis para a view
        include __DIR__ . '/../../view/site/veiculos.php';
    }

    public function detalhamento() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            // Busca o veículo pelo ID
            $veiculo = Veiculo::find($id);
            if ($veiculo) {
                include __DIR__ . '/../../view/site/veiculoDetalhamento.php'; // Exibe a página de detalhamento
            } else {
                echo "Veículo não encontrado.";
            }
        } else {
            echo "ID do veículo não fornecido.";
        }
    }

    // Função para formatar o preço removendo pontos e substituindo vírgula por ponto
    private function formatarPreco($preco) {
        // Remove os pontos de milhares e substitui a vírgula por ponto
        $precoFormatado = str_replace(['.', ','], ['', '.'], $preco);
        return $precoFormatado;
    }
}