<?php

require_once __DIR__ . '/../../model/Veiculo.php';

class HomeControllerSite {

    public function index() {
        $veiculoModel = new Veiculo();
        $veiculos = $veiculoModel::getAll();
        include __DIR__ . '/../../view/site/home.php';
    }
}