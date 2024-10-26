<?php

require_once 'baseModel.php';

class UsuarioSistema extends BaseModel {
    public $idUsuario;
    public $senha;

    public function __construct() {
        parent::__construct();
    }

    // Função para cadastrar ou atualizar o acesso do usuário no banco de dados
    public function salvar() {
        try {
            $pdo = Database::getConnection();

            // Verificar se o usuário já possui senha cadastrada
            $stmt = $pdo->prepare("SELECT senha FROM tbusuariosistema WHERE \"ID_usuario\" = :idUsuario");
            $stmt->bindParam(':idUsuario', $this->idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                // Se o usuário já tem senha, atualiza
                $stmt = $pdo->prepare("UPDATE tbusuariosistema SET senha = :senha WHERE \"ID_usuario\" = :idUsuario");
                $stmt->bindParam(':idUsuario', $this->idUsuario, PDO::PARAM_INT);
                $stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            } else {
                // Caso contrário, cria uma nova entrada
                $stmt = $pdo->prepare("INSERT INTO tbusuariosistema (\"ID_usuario\", senha) VALUES (:idUsuario, :senha)");
                $stmt->bindParam(':idUsuario', $this->idUsuario, PDO::PARAM_INT);
                $stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            }

            return $stmt->execute();
        } catch (PDOException $e) {
            // Log de erro para depuração
            error_log('Erro ao salvar acesso: ' . $e->getMessage());
            return false;
        }
    }

    // Função para verificar a senha do usuário
    public static function verificarSenha($idUsuario, $senha) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT senha FROM tbusuariosistema WHERE \"ID_usuario\" = :idUsuario");
            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return md5($senha) == $resultado['senha'];
        } catch (PDOException $e) {
            error_log('Erro ao verificar senha: ' . $e->getMessage());
            return false;
        }
    }
    
}
