<?php

require_once 'baseModel.php'; // BaseModel gerencia a conexão com o banco de dados

class Veiculo extends BaseModel {
    public $idVeiculo;
    public $ano;
    public $quilometragem;
    public $valor;
    public $cambio;
    public $tipo;
    public $combustivel;
    public $placa;
    public $chassis;
    public $ativo;
    public $unicoDono;
    public $idAntigoDono;
    public $acessorios;
    public $observacoes;
    public $idMarca;
    public $idModelo;
    public $idCor;
    public $imagem;

    public function __construct() {
        parent::__construct(); // Chama o construtor do BaseModel para inicializar a conexão com o banco
    }

    public static function find($id) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("SELECT v.*, m.nome_marca AS marca, mo.nome_modelo AS modelo, c.nome_cor AS cor
                                   FROM tbveiculo v
                                   JOIN tbmarca m ON v.\"ID_marca\" = m.\"ID_marca\"
                                   JOIN tbmodelo mo ON v.\"ID_modelo\" = mo.\"ID_modelo\"
                                   JOIN tbcor c ON v.\"ID_cor\" = c.\"ID_cor\"
                                   WHERE v.\"ID_veiculo\" = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar veículo: ' . $e->getMessage());
            return null;
        }
    }

    // Método para cadastrar o veículo no banco de dados
    public function cadastrar() {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("INSERT INTO tbveiculo (
                    ano, quilometragem, valor, cambio, tipo, combustivel, placa, chassis, ativo, unico_dono, 
                    \"ID_antigo_dono\", acessorios, observacoes, \"ID_marca\", \"ID_modelo\", \"ID_cor\")
                VALUES (:ano, :quilometragem, :valor, :cambio, :tipo, :combustivel, :placa, :chassis, :ativo, :unico_dono, 
                    :ID_antigo_dono, :acessorios, :observacoes, :ID_marca, :ID_modelo, :ID_cor)");
            
            // Bind the parameters
            $stmt->bindParam(':ano', $this->ano, PDO::PARAM_INT);
            $stmt->bindParam(':quilometragem', $this->quilometragem, PDO::PARAM_INT);
            $stmt->bindParam(':valor', $this->valor, PDO::PARAM_STR);
            $stmt->bindParam(':cambio', $this->cambio, PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $this->tipo, PDO::PARAM_STR);
            $stmt->bindParam(':combustivel', $this->combustivel, PDO::PARAM_STR);
            $stmt->bindParam(':placa', $this->placa, PDO::PARAM_STR);
            $stmt->bindParam(':chassis', $this->chassis, PDO::PARAM_STR);
            $stmt->bindParam(':ativo', $this->ativo, PDO::PARAM_BOOL);
            $stmt->bindParam(':unico_dono', $this->unicoDono, PDO::PARAM_BOOL);
            $stmt->bindParam(':ID_antigo_dono', $this->idAntigoDono, PDO::PARAM_INT);
            $stmt->bindParam(':acessorios', $this->acessorios, PDO::PARAM_STR);
            $stmt->bindParam(':observacoes', $this->observacoes, PDO::PARAM_STR);
            $stmt->bindParam(':ID_marca', $this->idMarca, PDO::PARAM_INT);
            $stmt->bindParam(':ID_modelo', $this->idModelo, PDO::PARAM_INT);
            $stmt->bindParam(':ID_cor', $this->idCor, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao cadastrar veículo: ' . $e->getMessage());
            return false;
        }
    }
    
    public function update($id) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("UPDATE tbveiculo SET
                ano = :ano,
                quilometragem = :quilometragem,
                valor = :valor,
                cambio = :cambio,
                tipo = :tipo,
                combustivel = :combustivel,
                placa = :placa,
                chassis = :chassis,
                ativo = :ativo,
                unico_dono = :unico_dono,
                \"ID_antigo_dono\" = :ID_antigo_dono,
                acessorios = :acessorios,
                observacoes = :observacoes,
                \"ID_marca\" = :ID_marca,
                \"ID_modelo\" = :ID_modelo,
                \"ID_cor\" = :ID_cor
                WHERE \"ID_veiculo\" = :id");
    
            // Bind dos parâmetros
            $stmt->bindParam(':ano', $this->ano, PDO::PARAM_INT);
            $stmt->bindParam(':quilometragem', $this->quilometragem, PDO::PARAM_INT);
            $stmt->bindParam(':valor', $this->valor, PDO::PARAM_STR);
            $stmt->bindParam(':cambio', $this->cambio, PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $this->tipo, PDO::PARAM_STR);
            $stmt->bindParam(':combustivel', $this->combustivel, PDO::PARAM_STR);
            $stmt->bindParam(':placa', $this->placa, PDO::PARAM_STR);
            $stmt->bindParam(':chassis', $this->chassis, PDO::PARAM_STR);
            $stmt->bindParam(':ativo', $this->ativo, PDO::PARAM_BOOL);
            $stmt->bindParam(':unico_dono', $this->unicoDono, PDO::PARAM_BOOL);
            $stmt->bindParam(':ID_antigo_dono', $this->idAntigoDono, PDO::PARAM_INT);
            $stmt->bindParam(':acessorios', $this->acessorios, PDO::PARAM_STR);
            $stmt->bindParam(':observacoes', $this->observacoes, PDO::PARAM_STR);
            $stmt->bindParam(':ID_marca', $this->idMarca, PDO::PARAM_INT);
            $stmt->bindParam(':ID_modelo', $this->idModelo, PDO::PARAM_INT);
            $stmt->bindParam(':ID_cor', $this->idCor, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao atualizar veículo: ' . $e->getMessage());
            return false;
        }
    }    

    // Método para buscar todos os veículos
    public static function getAll() {
        try {
            $pdo = Database::getConnection();
            // Buscar o primeiro registro de imagem associada ao veículo
            $stmt = $pdo->query("SELECT v.*, m.nome_marca AS marca, mo.nome_modelo AS modelo, img.imagem
                                 FROM tbveiculo v
                                 JOIN tbmarca m ON v.\"ID_marca\" = m.\"ID_marca\"
                                 JOIN tbmodelo mo ON v.\"ID_modelo\" = mo.\"ID_modelo\"
                                 LEFT JOIN (
                                     SELECT DISTINCT ON (\"ID_veiculo\") \"ID_veiculo\", imagem
                                     FROM tbveiculoimagem
                                     ORDER BY \"ID_veiculo\", \"id_imagem\"
                                 ) img ON v.\"ID_veiculo\" = img.\"ID_veiculo\"
                                 GROUP BY v.\"ID_veiculo\", m.nome_marca, mo.nome_modelo, img.imagem
                                 ORDER BY v.\"ID_veiculo\"");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar veículos: ' . $e->getMessage());
            return [];
        }
    }    

    // Método para buscar um veículo pelo ID
    public static function getById($id) {
        try {
            $pdo = Database::getConnection();
            $stmt = $pdo->prepare("
                SELECT v.\"ID_veiculo\", m.nome_marca, mo.nome_modelo, v.placa 
                FROM tbveiculo v
                JOIN tbmarca m ON v.\"ID_marca\" = m.\"ID_marca\"
                JOIN tbmodelo mo ON v.\"ID_modelo\" = mo.\"ID_modelo\"
                WHERE v.\"ID_veiculo\" = :id
            ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar veículo: ' . $e->getMessage());
            return null;
        }
    }
    
    public static function deleteById($id) {
        try {
            $pdo = Database::getConnection();
    
            // Excluir todas as ocorrências relacionadas ao veículo
            $stmt = $pdo->prepare("DELETE FROM tbocorrencia WHERE \"ID_veiculo\" = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            // Excluir todas as movimentações relacionadas ao veículo
            $stmt = $pdo->prepare("DELETE FROM tbmovimentacao WHERE \"ID_veiculo\" = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            // Agora excluir o veículo da tabela tbveiculo
            $stmt = $pdo->prepare("DELETE FROM tbveiculo WHERE \"ID_veiculo\" = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao excluir veículo: ' . $e->getMessage());
            return false;
        }
    }
 
    public static function getAllFiltered($filtros) {
        try {
            $pdo = Database::getConnection();
            $sql = "SELECT DISTINCT ON (v.\"ID_veiculo\") v.*, m.nome_marca AS marca, mo.nome_modelo AS modelo, img.imagem
                    FROM tbveiculo v
                    JOIN tbmarca m ON v.\"ID_marca\" = m.\"ID_marca\"
                    JOIN tbmodelo mo ON v.\"ID_modelo\" = mo.\"ID_modelo\"
                    LEFT JOIN tbveiculoimagem img ON v.\"ID_veiculo\" = img.\"ID_veiculo\"
                    WHERE 1=1"; // Filtros dinâmicos

            $params = [];

            // Aplicar filtro de marca se existir
            if (!empty($filtros['marca'])) {
                $sql .= " AND v.\"ID_marca\" = :marca";
                $params[':marca'] = $filtros['marca'];
            }

            // Aplicar filtro de modelo se existir
            if (!empty($filtros['modelo'])) {
                $sql .= " AND v.\"ID_modelo\" = :modelo";
                $params[':modelo'] = $filtros['modelo'];
            }

            // Aplicar filtro de ano considerando apenas os primeiros 4 dígitos
            if (!empty($filtros['ano'])) {
                $sql .= " AND SUBSTRING(v.ano, 1, 4) = :ano";
                $params[':ano'] = $filtros['ano'];
            }

            // Aplicar filtro de preço mínimo
            if (!empty($filtros['preco_min'])) {
                $sql .= " AND v.valor >= :preco_min";
                $params[':preco_min'] = $filtros['preco_min'];
            }

            // Aplicar filtro de preço máximo
            if (!empty($filtros['preco_max'])) {
                $sql .= " AND v.valor <= :preco_max";
                $params[':preco_max'] = $filtros['preco_max'];
            }

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar veículos filtrados: ' . $e->getMessage());
            return [];
        }
    }
    
}