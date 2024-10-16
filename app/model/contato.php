<?php

require_once 'baseModel.php';

class Contato extends BaseModel {

    public $idContato;
    public $nome;
    public $telefone;
    public $email;
    public $cidade;
    public $estado;
    public $assunto;
    public $mensagem;
    public $dataHora;

    public function __construct() {
        parent::__construct(); // Chama o construtor da classe base para conexão com o banco
    }

    public static function listar() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->query("SELECT * FROM tbcontato ORDER BY data_hora DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao listar contatos: ' . $e->getMessage());
            return [];
        }
    }

    public static function find($id) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT * FROM tbcontato WHERE \"ID_contato\" = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar contato: ' . $e->getMessage());
            return null;
        }
    }

    public static function excluir($id) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("DELETE FROM tbcontato WHERE \"ID_contato\" = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao excluir contato: ' . $e->getMessage());
            return false;
        }
    }

    public function salvar() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("INSERT INTO tbcontato (nome, telefone, email, cidade, estado, assunto, mensagem, data_hora)
                                   VALUES (:nome, :telefone, :email, :cidade, :estado, :assunto, :mensagem, NOW())");
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':telefone', $this->telefone);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':cidade', $this->cidade);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':assunto', $this->assunto);
            $stmt->bindParam(':mensagem', $this->mensagem);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao salvar contato: ' . $e->getMessage());
            return false;
        }
    }
}