<?php

require_once 'baseModel.php';

class Modelo extends BaseModel {

    public $nomeModelo;
    public $idMarca;

    public function __construct() {
        parent::__construct();
    }

    // Método para listar todos os modelos
    public static function listar() {
        try {
            $pdo = Database::getConnection();
            // Faz o JOIN para obter o nome da marca
            $stmt = $pdo->query("
                SELECT m.\"ID_modelo\", m.nome_modelo, ma.nome_marca 
                FROM tbmodelo m
                JOIN tbmarca ma ON m.\"ID_marca\" = ma.\"ID_marca\" 
                ORDER BY m.nome_modelo
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao listar modelos: ' . $e->getMessage());
            return [];
        }
    }
    

    // Novo método getAll para buscar todos os modelos
    public static function getAll() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->query("SELECT * FROM tbmodelo ORDER BY nome_modelo");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar todos os modelos: ' . $e->getMessage());
            return [];
        }
    }

    // Método para cadastrar o modelo no banco de dados
    public function cadastrar() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("INSERT INTO tbmodelo (nome_modelo, \"ID_marca\") VALUES (:nomeModelo, :idMarca)");
            $stmt->bindParam(':nomeModelo', $this->nomeModelo);
            $stmt->bindParam(':idMarca', $this->idMarca, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao cadastrar modelo: ' . $e->getMessage());
            return false;
        }
    }

    // Método para encontrar um modelo pelo ID
    public static function find($id) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT * FROM tbmodelo WHERE \"ID_modelo\" = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar modelo: ' . $e->getMessage());
            return null;
        }
    }

    // Método para atualizar um modelo existente
    public function update($id) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("UPDATE tbmodelo SET nome_modelo = :nomeModelo, \"ID_marca\" = :idMarca WHERE \"ID_modelo\" = :id");
            $stmt->bindParam(':nomeModelo', $this->nomeModelo);
            $stmt->bindParam(':idMarca', $this->idMarca, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao atualizar modelo: ' . $e->getMessage());
            return false;
        }
    }

    // Método para excluir um modelo
    public static function delete($id) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("DELETE FROM tbmodelo WHERE \"ID_modelo\" = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao excluir modelo: ' . $e->getMessage());
            return false;
        }
    }
}
?>
