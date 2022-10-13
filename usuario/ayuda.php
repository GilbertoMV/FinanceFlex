<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinanceFlex</title>
    <link rel="shortcut icon" href="../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6dc1722754.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script defer src="../public/js/navbar.js"></script>
</head>
<header class="header">
    <img class="logo" src="../public/img/logito.png" alt="">
    <h1 class="h1">
        <a href="#" class="title-logo">FinanceFlex</a>
    </h1>
    <button class="button">
      <svg class="svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg>
    </button>
    <?php require 'nav.php' ?>
</header>
<body>
    <section class="pregun">
        <div class="frecuente">
            <h2>Preguntas Frecuentes (FAQs)</h2>
            <div class="fline"></div>
        </div>
        <div class="pregunt">
            <p><i class="fa-solid fa-caret-down"></i>¿Cómo puedo crear una cuenta?</p>
            <p><i class="fa-solid fa-caret-down"></i>¿Cómo solicito un prestamo?</p>
            <p><i class="fa-solid fa-caret-down"></i>¿Cuánto es el interés?</p>
        </div>
        <div class="quest">
        </div>
    </section>
</body>
</html>