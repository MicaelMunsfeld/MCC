<?php
require_once __DIR__ . '/../../model/veiculo.php';

class HomeController {

    public function index() {
        // Buscar os veículos cadastrados
        $veiculos = Veiculo::getAll(); // Função que traz os detalhes completos
        include __DIR__ . '/../../view/admin/home.php'; // Inclui a view home com os cards
    }
    
}
