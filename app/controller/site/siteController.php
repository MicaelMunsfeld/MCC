<?php

class SiteController {

    public function home() {
        include __DIR__ . '/../../view/site/home.php';
    }

    public function contato() {
        include __DIR__ . '/../../view/site/contato.php';
    }

    public function veiculos() {
        include __DIR__ . '/../../view/site/veiculos.php';
    }

    public function sobre() {
        include __DIR__ . '/../../view/site/sobre.php';
    }

    public function politica() {
        include __DIR__ . '/../../view/site/politica.php';
    }
    
}