<?php

require_once 'baseModel.php';

class ImagemVeiculo extends BaseModel {

    public $idVeiculo;
    public $imagem;
    public $descricao;

    public function __construct() {
        parent::__construct(); // Garante que a conexão é estabelecida conforme o BaseModel
    }

    // Método para cadastrar a imagem no banco de dados
    public function cadastrar() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("INSERT INTO tbveiculoimagem (\"ID_veiculo\", imagem, descricao) VALUES (:idVeiculo, :imagem, :descricao)");
            $stmt->bindParam(':idVeiculo', $this->idVeiculo, PDO::PARAM_INT);
            $stmt->bindParam(':imagem', $this->imagem, PDO::PARAM_LOB); // Usa PARAM_LOB para grandes dados binários
            $stmt->bindParam(':descricao', $this->descricao);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao cadastrar imagem: ' . $e->getMessage());
            return false;
        }
    }

    public static function salvarImagem($idVeiculo, $conteudoImagem, $descricao = null) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("
                INSERT INTO tbveiculoimagem (\"ID_veiculo\", imagem, descricao) 
                VALUES (:idVeiculo, :imagem, :descricao)
            ");
            $stmt->bindParam(':idVeiculo', $idVeiculo, PDO::PARAM_INT);
            $stmt->bindParam(':imagem', $conteudoImagem, PDO::PARAM_LOB); // Salva o conteúdo da imagem em formato binário
            $stmt->bindParam(':descricao', $descricao);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao salvar imagem: ' . $e->getMessage());
            return false;
        }
    }

    // Método para buscar as imagens associadas a um veículo
    public static function buscarPorVeiculo($idVeiculo) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("
                SELECT * FROM tbveiculoimagem 
                WHERE \"ID_veiculo\" = :idVeiculo
            ");
            $stmt->bindParam(':idVeiculo', $idVeiculo, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar imagens: ' . $e->getMessage());
            return [];
        }
    }

}
