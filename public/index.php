<?php

// Ajuste os caminhos usando __DIR__ para garantir que os arquivos sejam encontrados
require_once __DIR__ . '/../app/controller/admin/homeController.php';
require_once __DIR__ . '/../app/controller/admin/veiculoController.php';
require_once __DIR__ . '/../app/controller/admin/usuarioController.php'; 
require_once __DIR__ . '/../app/controller/admin/usuarioSistemaController.php'; 
require_once __DIR__ . '/../app/controller/admin/marcaController.php'; // Adiciona o controlador de Marca
require_once __DIR__ . '/../app/controller/admin/modeloController.php';
require_once __DIR__ . '/../app/controller/admin/corController.php';
require_once __DIR__ . '/../app/controller/admin/movimentacaoController.php';
require_once __DIR__ . '/../app/controller/admin/ocorrenciaController.php';

// Roteamento simples para decidir qual controlador chamar
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($page) {
    case 'veiculo':
        $controller = new VeiculoController();

        switch ($action) {
            case 'incluir':
                $controller->cadastro(); 
                break;
            case 'salvar':
                $controller->salvar(); 
                break;
            case 'alterar': // Adiciona a rota para alterar
                $controller->alterar(); 
                break;
            case 'atualizar':
                $controller->atualizar(); 
                break;
            case 'excluir':
                $controller->excluir();
                break;
            default:
                $controller->index(); // Carrega a lista de veículos se nenhuma ação for definida
                break;
        }
        break;
    case 'veiculoListModal':
        $controller = new VeiculoController();
        $controller->modal(); // Create a modal method to load the list without menu
        break;
    
    case 'veiculoList':
        $controller = new VeiculoController();
        $controller->index(); 
        break;

    case 'usuario':
        $controller = new UsuarioController();

        switch ($action) {
            case 'incluir':
                $controller->cadastro();
                break;
            case 'salvar':
                $controller->salvar(); 
                break;
            case 'alterar':
                $controller->alterar();
                break;
            case 'alterar':
                $controller->alterar();
                break;
            case 'excluir':
                $controller->excluir();
                break;
            default:
                $controller->index(); 
                break;
        }
        break;

    case 'usuarioList':
        $controller = new UsuarioController();
        $controller->index(); 
        break;

    case 'movimentacao':
        $controller = new MovimentacaoController();
        switch ($action) {
            case 'incluir':
                $controller->cadastro();
                break;
            case 'salvar':
                $controller->salvar();
                break;
            default:
                $controller->index();
                break;
        }
        break;

    case 'usuarioSistema':
        $controller = new UsuarioSistemaController(); 

        switch ($action) {
            case 'cadastro': 
                $controller->cadastro(); 
                break;
            case 'salvar':
                $controller->salvar(); 
                break;
            default:
                header('Location: ?page=usuarioList'); 
                break;
        }
        break;

    case 'login': // Adiciona o caso para login usando o UsuarioSistemaController
        $controller = new UsuarioSistemaController();
        $controller->index(); // Chama o método index para exibir a tela de login
        break;

    case 'marca': // Adiciona as rotas para marcas
        $controller = new MarcaController();

        switch ($action) {
            case 'incluir': // Ajuste para chamar o método correto
                $controller->cadastro(); 
                break;
            case 'salvar':
                $controller->salvar(); 
                break;
            case 'alterar':
                $controller->alterar(); 
                break;
            case 'atualizar':
                $controller->atualizar(); 
                break;
            case 'excluir':
                $controller->excluir(); 
                break;
            default:
                $controller->index(); 
                break;
        }
        break;

    case 'ocorrencia':
        $controller = new OcorrenciaController();
        
        switch ($action) {
            case 'incluir':
                $controller->cadastro();
                break;
            case 'salvar':
                $controller->salvar();
                break;
            case 'alterar':
                $controller->alterar();
                break;
            case 'atualizar':
                $controller->atualizar();
                break;
            case 'excluir':
                $controller->excluir();
                break;
            default:
                $controller->index();
                break;
        }
        break;

    case 'modelo': // Adiciona as rotas para modelos
        $controller = new ModeloController();

        switch ($action) {
            case 'incluir':
                $controller->cadastro();
                break;
            case 'salvar':
                $controller->salvar();
                break;
            case 'alterar':
                $controller->alterar();
                break;
            case 'atualizar':
                $controller->atualizar();
                break;
            case 'excluir':
                $controller->excluir();
                break;
            default:
                $controller->index();
                break;
        }
        break;
    case 'cor':
        $controller = new CorController();
    
        switch ($action) {
            case 'incluir':
                $controller->cadastro();
                break;
            case 'salvar':
                $controller->salvar();
                break;
            case 'alterar':
                $controller->alterar();
                break;
            case 'atualizar':
                $controller->atualizar();
                break;
            case 'excluir':
                $controller->excluir();
                break;
            default:
                $controller->index();
                break;
        }
        break;
    case 'home':
    default:
        $controller = new HomeController();
        $controller->index(); 
        break;
}
?>
