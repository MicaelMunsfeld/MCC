<?php

require_once __DIR__ . '/../../model/Veiculo.php';

class HomeControllerSite {

    public function index() {
        $veiculos = Veiculo::getAllActiveLimited(6);
        include __DIR__ . '/../../view/site/home.php';
    }
}