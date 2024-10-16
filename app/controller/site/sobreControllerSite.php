<?php

class sobreControllerSite {

    public function index() {
        $sobre = Sobre::getSobre();
        include __DIR__ . '/../../view/site/sobre.php';
    }
}