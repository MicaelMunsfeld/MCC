<?php

require_once 'baseModel.php';

class Cor extends BaseModel {
    public $nomeCor;

    // Listar todas as cores
    public static function getAll() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->query("SELECT * FROM tbcor ORDER BY nome_cor");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao listar cores: ' . $e->getMessage());
            return [];
        }
    }

    // Cadastrar uma nova cor
    public function cadastrar() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("INSERT INTO tbcor (nome_cor) VALUES (:nomeCor)");
            $stmt->bindParam(':nomeCor', $this->nomeCor);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao cadastrar cor: ' . $e->getMessage());
            return false;
        }
    }

    // Encontrar uma cor pelo ID
    public static function find($id) {
        try {
            $pdo = Database::getConnection();
            // Corrija o nome da coluna para usar aspas duplas, já que está em maiúsculas
            $stmt = $pdo->prepare("SELECT * FROM tbcor WHERE \"ID_cor\" = :id"); 
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna os dados da cor como array associativo
        } catch (PDOException $e) {
            error_log('Erro ao buscar cor: ' . $e->getMessage());
            return null;
        }
    }
    

    public function update($id) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("UPDATE tbcor SET nome_cor = :nomeCor WHERE ID_cor = :id");
            $stmt->bindParam(':nomeCor', $this->nomeCor);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao atualizar cor: ' . $e->getMessage());
            return false;
        }
    }
    
    public static function delete($id) {
        try {
            $pdo = Database::getConnection();
            // Verifique se o nome da coluna está correto
            $stmt = $pdo->prepare("DELETE FROM tbcor WHERE \"ID_cor\" = :id"); // Use aspas duplas para lidar com maiúsculas
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute(); // Executa a exclusão
        } catch (PDOException $e) {
            error_log('Erro ao excluir cor: ' . $e->getMessage());
            return false;
        }
    }
    
    
}
