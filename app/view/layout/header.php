<!-- header.php -->
<?php
// Verifica se o dispositivo é mobile
require_once $_SERVER['DOCUMENT_ROOT'] . '/MCC/public/dispositivoMovel.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCC - Munsfeld Car Control</title>
    <!-- Link para Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha384-nMPbTgkHslJIo9Ihc8YXXv3qEjTAPlGRA8Hu7jxdyqaGv+Jkld9gbYqMY8BEAZD6" crossorigin="anonymous">
    <!-- Link para o CSS Customizado -->
    <link href="/MCC/public/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Inclui o Menu Lateral -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/sidebar.php'; ?>

    <!-- Container Principal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 d-none d-md-block">
                <!-- Sidebar vai aqui em telas maiores -->
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/MCC/app/view/layout/sidebar.php'; ?>
            </div>

            <div class="col-12 col-md-9">
                <!-- Conteúdo principal responsivo -->
                <div class="main-content p-4">
                    <!-- Aqui começa o conteúdo principal das páginas -->
