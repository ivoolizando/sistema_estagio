<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
include("componentes/header.php");
session_start();
?>

<body>
    <p>Usuário: <?php if (isset($_SESSION['usuario'])) echo $_SESSION['usuario']; ?></p>
    <p>ID: <?php if (isset($_SESSION['id'])) echo $_SESSION['id']; ?></p>
    <p>Email: <?php if (isset($_SESSION['email'])) echo $_SESSION['email']; ?></p>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>