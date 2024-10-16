<?php

require_once 'baseModel.php';

class UsuarioSistema extends BaseModel {
    public $idUsuario;
    public $senha;

    public function __construct() {
        parent::__construct();
    }

    // Função para cadastrar o acesso do usuário no banco de dados
    public function cadastrar() {
        try {
            $pdo = Database::getConnection();
            // Corrigindo a referência da coluna "ID_usuario" para evitar erros de reconhecimento
            $stmt = $pdo->prepare("INSERT INTO tbusuariosistema (\"ID_usuario\", senha) VALUES (:idUsuario, :senha)");
            $stmt->bindParam(':idUsuario', $this->idUsuario, PDO::PARAM_INT);
            $stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            // Log de erro para depuração
            error_log('Erro ao cadastrar acesso: ' . $e->getMessage());
            return false;
        }
    }

    public static function verificarSenha($idUsuario, $senha) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT senha FROM tbusuariosistema WHERE \"ID_usuario\" = :idUsuario");
            $stmt->bindParam(':idUsuario', $idUsuario);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return password_verify($senha, $resultado['senha']);
        } catch (PDOException $e) {
            error_log('Erro ao verificar senha: ' . $e->getMessage());
            return false;
        }
    }    

}