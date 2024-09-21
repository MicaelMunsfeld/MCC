<?php

class HomeController {
    public function index() {
        // Ajuste o caminho para o correto utilizando __DIR__ para garantir o caminho absoluto
        require __DIR__ . '/../../view/admin/home.php';  // Corrige o caminho para o arquivo home.php
    }
}
