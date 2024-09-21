<?php

// Ajuste o caminho para o arquivo database.php usando __DIR__
require_once __DIR__ . '/../../config/database.php';

class BaseModel {
    protected $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
}
