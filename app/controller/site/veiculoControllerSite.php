<?php

require_once __DIR__ . '/../../model/Veiculo.php';
require_once __DIR__ . '/../../model/Marca.php';
require_once __DIR__ . '/../../model/Modelo.php';

class veiculoControllerSite {

    public function index() {
        // Coletar os filtros da requisição via GET
        $filtros = [
            'marca' => $_GET['marca'] ?? null,
            'modelo' => $_GET['modelo'] ?? null,
            'ano' => $_GET['ano'] ?? null,
            'preco_min' => isset($_GET['preco_min']) ? $this->formatarPreco($_GET['preco_min']) : null,
            'preco_max' => isset($_GET['preco_max']) ? $this->formatarPreco($_GET['preco_max']) : null,
        ];

        // Definir o número de veículos por página
        $limitePorPagina = 6;

        // Capturar a página atual (padrão é 1)
        $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

        // Garantir que a página atual nunca seja menor que 1
        if ($paginaAtual < 1) {
            $paginaAtual = 1;
        }

        // Calcular o offset para a busca
        $offset = ($paginaAtual - 1) * $limitePorPagina;

        // Buscar o número total de veículos filtrados
        $totalVeiculos = Veiculo::contarVeiculosFiltrados($filtros);

        // Calcular o número total de páginas
        $totalPages = ceil($totalVeiculos / $limitePorPagina);

        // Buscar os veículos filtrados e paginados
        $veiculos = Veiculo::obterVeiculosFiltradosPaginados($filtros, $limitePorPagina, $offset);

        // Obter todas as marcas e modelos para os filtros
        $marcas = Marca::getAll();
        $modelos = Modelo::getAll();

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
