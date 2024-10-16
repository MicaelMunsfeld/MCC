<?php

require_once 'baseModel.php'; // Certifique-se de que o BaseModel está configurado corretamente

class Sobre extends BaseModel {
    
    public function __construct() {
        parent::__construct();
    }

    public static function getSobre() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->query("SELECT * FROM tbsobre LIMIT 1");
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar informações sobre: ' . $e->getMessage());
            return null;
        }
    }

    // Método para inserir ou atualizar o conteúdo sobre a empresa
    public static function salvarSobre($conteudo) {
        try {
            $pdo = Database::getConnection();
            
            // Verifica se já existe um registro
            $stmtCheck = $pdo->query("SELECT \"id_sobre\" FROM tbsobre LIMIT 1");
            $exists = $stmtCheck->fetch(PDO::FETCH_ASSOC);
            
            if ($exists) {
                // Se já existir, fazemos um update
                $stmt = $pdo->prepare("UPDATE tbsobre SET conteudo = :conteudo WHERE \"id_sobre\" = :id");
                $stmt->bindParam(':conteudo', $conteudo);
                $stmt->bindParam(':id', $exists['id_sobre'], PDO::PARAM_INT);
            } else {
                // Caso contrário, inserimos um novo registro
                $stmt = $pdo->prepare("INSERT INTO tbsobre (conteudo) VALUES (:conteudo)");
                $stmt->bindParam(':conteudo', $conteudo);
            }
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao salvar informações sobre: ' . $e->getMessage());
            return false;
        }
    }
}