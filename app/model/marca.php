<?php

require_once 'baseModel.php';

class Marca extends BaseModel {

    public $nomeMarca;
    public $tipo;

    public function __construct() {
        parent::__construct(); // Garante que a conexão é estabelecida conforme o BaseModel
    }

    public static function listar() {
        try {
            $pdo = Database::getConnection(); // Utiliza a conexão do BaseModel
            $stmt = $pdo->query("SELECT * FROM tbmarca ORDER BY nome_marca");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao listar marcas: ' . $e->getMessage());
            return [];
        }
    }

    // Novo método getAll para buscar todas as marcas
    public static function getAll() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->query("SELECT * FROM tbmarca ORDER BY nome_marca");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar todas as marcas: ' . $e->getMessage());
            return [];
        }
    }

    // Método para cadastrar a marca no banco de dados
    public function cadastrar() {
        try {
            $pdo = Database::getConnection(); // Utiliza a conexão do BaseModel
            $stmt = $pdo->prepare("INSERT INTO tbmarca (nome_marca, tipo) VALUES (:nomeMarca, :tipo)");
            $stmt->bindParam(':nomeMarca', $this->nomeMarca);
            $stmt->bindParam(':tipo', $this->tipo);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao cadastrar marca: ' . $e->getMessage());
            return false;
        }
    }

    // Método para encontrar uma marca pelo ID
    public static function find($id) {
        try {
            $pdo = Database::getConnection(); // Utiliza a conexão do BaseModel
            $stmt = $pdo->prepare("SELECT * FROM tbmarca WHERE \"ID_marca\" = :id"); // Ajusta para tratar o nome corretamente
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar marca: ' . $e->getMessage());
            return null;
        }
    }

    // Método para atualizar uma marca existente
    public function update($id) {
        try {
            $pdo = Database::getConnection(); // Utiliza a conexão do BaseModel
            $stmt = $pdo->prepare("UPDATE tbmarca SET nome_marca = :nomeMarca, tipo = :tipo WHERE \"ID_marca\" = :id");
            $stmt->bindParam(':nomeMarca', $this->nomeMarca);
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao atualizar marca: ' . $e->getMessage());
            return false;
        }
    }

    // Método para excluir uma marca
    public static function delete($id) {
        try {
            $pdo = Database::getConnection(); // Utiliza a conexão do BaseModel
            $stmt = $pdo->prepare("DELETE FROM tbmarca WHERE \"ID_marca\" = :id"); // Ajuste para o uso correto da coluna com aspas
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao excluir marca: ' . $e->getMessage());
            return false;
        }
    }
}
?>
