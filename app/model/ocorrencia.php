<?php

require_once 'baseModel.php';

class Ocorrencia extends BaseModel {

    public $ID_veiculo;
    public $titulo;
    public $descricao;
    public $data_hora;
    public $cidade;
    public $estado;
    public $endereco;

    public function __construct() {
        parent::__construct();
    }

    public static function listar() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->query("SELECT o.\"ID_ocorrencia\", o.titulo, o.descricao, o.data_hora, o.cidade, o.endereco, o.estado, 
                                        CONCAT(m.nome_marca, ' ', mo.nome_modelo, ' - ', v.placa) AS nome_veiculo
                                 FROM tbocorrencia o
                                 JOIN tbveiculo v ON o.\"ID_veiculo\" = v.\"ID_veiculo\"
                                 JOIN tbmarca m ON v.\"ID_marca\" = m.\"ID_marca\"
                                 JOIN tbmodelo mo ON v.\"ID_modelo\" = mo.\"ID_modelo\"
                                 ORDER BY o.data_hora DESC");
            $ocorrencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Convertendo o código do estado para o nome usando a API do IBGE
            foreach ($ocorrencias as &$ocorrencia) {
                $ocorrencia['estado_nome'] = self::buscarNomeEstadoIBGE($ocorrencia['estado']);
            }
    
            return $ocorrencias;
        } catch (PDOException $e) {
            error_log('Erro ao listar ocorrências: ' . $e->getMessage());
            return [];
        }
    }
    
    public static function buscarNomeEstadoIBGE($codigoEstado) {
        $url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$codigoEstado}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        if ($response) {
            $estado = json_decode($response, true);
            return $estado['nome'] ?? 'Estado desconhecido';
        }
        return 'Estado desconhecido';
    }
  
    public static function find($id) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT * FROM tbocorrencia WHERE \"ID_ocorrencia\" = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna os dados da ocorrência como um array associativo
        } catch (PDOException $e) {
            error_log('Erro ao buscar ocorrência: ' . $e->getMessage());
            return null;
        }
    }    
    
    public function update($id) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("UPDATE tbocorrencia SET
                titulo = :titulo,
                descricao = :descricao,
                data_hora = :data_hora,
                cidade = :cidade,
                endereco = :endereco,
                estado = :estado,
                \"ID_veiculo\" = :ID_veiculo
                WHERE \"ID_ocorrencia\" = :id");
    
            $stmt->bindParam(':titulo', $this->titulo);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':data_hora', $this->data_hora);
            $stmt->bindParam(':cidade', $this->cidade);
            $stmt->bindParam(':endereco', $this->endereco);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':ID_veiculo', $this->ID_veiculo);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao atualizar ocorrência: ' . $e->getMessage());
            return false;
        }
    }    

    public function cadastrar() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("INSERT INTO tbocorrencia (\"ID_veiculo\", titulo, descricao, data_hora, estado, cidade, endereco)
                                   VALUES (:ID_veiculo, :titulo, :descricao, :data_hora, :estado, :cidade, :endereco)");
            $stmt->bindParam(':ID_veiculo', $this->ID_veiculo);
            $stmt->bindParam(':titulo', $this->titulo);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':data_hora', $this->data_hora);
            $stmt->bindParam(':estado', $this->estado);
            $stmt->bindParam(':cidade', $this->cidade);
            $stmt->bindParam(':endereco', $this->endereco);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao cadastrar ocorrência: ' . $e->getMessage());
            return false;
        }
    }

    public static function deleteById($id) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("DELETE FROM tbocorrencia WHERE \"ID_ocorrencia\" = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao excluir ocorrência: ' . $e->getMessage());
            return false;
        }
    }
}
