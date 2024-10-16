<?php

require_once 'baseModel.php';

class Usuario extends BaseModel {
    public $nome;
    public $sobrenome;
    public $telefone;
    public $sexo;
    public $email;
    public $cidade;
    public $estado;
    public $tipo_usuario;

    public function __construct() {
        parent::__construct();
    }

    // Função para buscar todos os usuários no banco de dados
    public static function getAll() {
        try {
            $pdo = Database::getConnection();
            // Seleciona todas as colunas de tbusuario e adiciona a coluna concatenada 'nome_completo'
            $stmt = $pdo->query("SELECT \"ID_usuario\", nome, sobrenome, telefone, sexo, email, cidade, tipo_usuario, CONCAT(nome, ' ', sobrenome) AS nome_completo FROM tbusuario ORDER BY nome");
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os usuários com o nome completo
        } catch (PDOException $e) {
            error_log('Erro ao buscar usuários: ' . $e->getMessage());
            return [];
        }
    }    

    // Função para buscar um usuário pelo ID
    public static function getById($id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM tbusuario WHERE \"ID_usuario\" = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Função para criar um novo usuário
    public function cadastrar() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("INSERT INTO tbusuario (nome, sobrenome, telefone, sexo, email, cidade, estado, tipo_usuario)
                                   VALUES (:nome, :sobrenome, :telefone, :sexo, :email, :cidade, :estado, :tipo_usuario)");
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':sobrenome', $this->sobrenome);
            $stmt->bindParam(':telefone', $this->telefone);
            $stmt->bindParam(':sexo', $this->sexo);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':cidade', $this->cidade);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':tipo_usuario', $this->tipo_usuario);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao cadastrar usuário: ' . $e->getMessage());
            return false;
        }
    }

    // Função para atualizar um usuário pelo ID
    public function alterar($id) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("UPDATE tbusuario SET nome = :nome, sobrenome = :sobrenome, telefone = :telefone,
                                   sexo = :sexo, email = :email, cidade = :cidade, estado = :estado, tipo_usuario = :tipo_usuario
                                   WHERE \"ID_usuario\" = :id");
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':sobrenome', $this->sobrenome);
            $stmt->bindParam(':telefone', $this->telefone);
            $stmt->bindParam(':sexo', $this->sexo);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':cidade', $this->cidade);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':tipo_usuario', $this->tipo_usuario);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Corrigindo o mapeamento do ID
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao alterar usuário: ' . $e->getMessage());
            return false;
        }
    }

    // Função para excluir um usuário pelo ID
    public static function deleteById($id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("DELETE FROM tbusuario WHERE \"ID_usuario\" = :id");
        $stmt->execute(['id' => $id]);
    }

    public static function findByNomeSobrenome($nome, $sobrenome) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT * FROM tbusuario WHERE nome = :nome AND sobrenome = :sobrenome");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':sobrenome', $sobrenome);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar usuário: ' . $e->getMessage());
            return null;
        }
    }    

}