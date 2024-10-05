<?php

require_once __DIR__ . '/../site/homeControllerSite.php';
require_once __DIR__ . '/../site/sobreControllerSite.php';

class SiteController {

    public function home() {
        $oController = new HomeControllerSite();
        $oController->index();
    }

    public function contato() {
        include __DIR__ . '/../../view/site/contato.php';
    }

    public function veiculos() {
        include __DIR__ . '/../../view/site/veiculos.php';
    }

    public function sobre() {
        $oController = new sobreControllerSite();
        $oController->index();
    }

    public function politica() {
        include __DIR__ . '/../../view/site/politica.php';
    }
    
}