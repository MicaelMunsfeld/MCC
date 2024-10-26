<?php
require_once __DIR__ . '/../../model/veiculo.php';

class HomeController {

    public function index() {
        // Buscar veículos ativos, limitando a 6 veículos
        $veiculos = Veiculo::getAllActiveLimited(6);
        include __DIR__ . '/../../view/admin/home.php';
    }
    
}