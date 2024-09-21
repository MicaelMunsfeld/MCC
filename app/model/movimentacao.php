<?php

require_once 'baseModel.php';

class Movimentacao extends BaseModel {

    public $data_hora;
    public $tipo;
    public $ID_veiculo;
    public $ID_usuario;

    public function __construct() {
        parent::__construct();
    }

    // Método para listar todas as movimentações
    public static function listar() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->query("SELECT mv.data_hora, mv.tipo, CONCAT(m.nome_marca, ' ', mo.nome_modelo, ' - ', v.placa) AS nome_veiculo, u.nome
                                 FROM tbmovimentacao mv
                                 JOIN tbveiculo v ON mv.\"ID_veiculo\" = v.\"ID_veiculo\"
                                 JOIN tbmarca m ON v.\"ID_marca\" = m.\"ID_marca\"
                                 JOIN tbmodelo mo ON v.\"ID_modelo\" = mo.\"ID_modelo\"
                                 JOIN tbusuario u ON mv.\"ID_usuario\" = u.\"ID_usuario\"
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao listar movimentações: ' . $e->getMessage());
            return [];
        }
    }
    

    // Método para cadastrar uma movimentação
    public function cadastrar() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("INSERT INTO tbmovimentacao (data_hora, tipo, \"ID_veiculo\", \"ID_usuario\")
                                   VALUES (:data_hora, :tipo, :ID_veiculo, :ID_usuario)");
            $stmt->bindParam(':data_hora', $this->data_hora);
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':ID_veiculo', $this->ID_veiculo, PDO::PARAM_INT);
            $stmt->bindParam(':ID_usuario', $this->ID_usuario, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao cadastrar movimentação: ' . $e->getMessage());
            return false;
        }
    }
}
