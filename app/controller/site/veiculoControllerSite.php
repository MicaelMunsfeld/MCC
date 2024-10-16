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

        // Carregar a view com os dados
        include __DIR__ . '/../../view/site/veiculos.php';
    }

    // Função para formatar o preço removendo pontos e substituindo vírgula por ponto
    private function formatarPreco($preco) {
        // Remove os pontos de milhares e substitui a vírgula por ponto
        $precoFormatado = str_replace(['.', ','], ['', '.'], $preco);
        return $precoFormatado;
    }
}