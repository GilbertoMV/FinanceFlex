<?php
session_start();
include __DIR__ .'\..\error-log.php';
error_log($_SESSION['id_ejecutivo']);

if(isset($_SESSION['id_ejecutivo'])){
    require_once __DIR__ .'\..\includes\db.php';
    $records = $conn->prepare('SELECT * FROM cuenta');
    $records->bindParam(':id_ejecutivo', $_SESSION['id_ejecutivo']);
    $records->execute();    
    $results = $records->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceFlex</title>
    <link rel="shortcut icon" href="../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/mainEjecutive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
    <script defer src="../public/js/navbar.js"></script>
</head>
<body>
    <header class="header">
        <?php require 'nav.php'?>
    <div class="linea"></div>
    </header>
    <main>
        <div class="main">
            <div>
                <h1 class="title">Lista de clientes</h1>
            </div>
            <div class="colum2">
                <div class="buscar">
                    <input type="text" placeholder="Buscar" required>
                    <div class="btn">
                        <i class="fas fa-search icon"></i>
                    </div>
                </div>
            </div>
        </div>
        <ol class="lista">
                        <?php foreach ($results as $result) {?>
                        <li><?php print_r($results);?></li>
                        <?php }?>
    </main>
    <script src="../public/js/app.js"></script>
</body>
</html>
<?php
}else{
    header('Location:../login.php');
}
?>