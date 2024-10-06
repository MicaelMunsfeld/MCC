<?php

require_once __DIR__ . '/../site/homeControllerSite.php';
require_once __DIR__ . '/../site/sobreControllerSite.php';
require_once __DIR__ . '/../site/contatoControllerSite.php';
require_once __DIR__ . '/../site/veiculoControllerSite.php';

class SiteController {

    public function home() {
        $oController = new HomeControllerSite();
        $oController->index();
    }

    public function contato() {
        $oController = new contatoControllerSite();
        $oController->index();
    }

    public function veiculos() {
        $oController = new veiculoControllerSite();
        $oController->index();
    }

    public function sobre() {
        $oController = new sobreControllerSite();
        $oController->index();
    }

    public function politica() {
        include __DIR__ . '/../../view/site/politica.php';
    }
    
}