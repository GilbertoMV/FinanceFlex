<?php
$id=$_POST['id'];
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
    <?php require 'nav.php' ?>
    <main>
        <?php echo($id)?>
    </main>
        
    <script type="text/javascript" src="../public/js/datatable.js"></script>
    <script src="../public/js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js/alertas.js"></script>
</body>
</html>