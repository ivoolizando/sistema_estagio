<?php
if (isset($_POST['logout'])) {
    session_start();
    session_destroy();
    header('Location: ../login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Página</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
            TEXT-ALIGN: center;
        }

        .list-group {
            display: flex;
            flex-direction: column;
            align-items: center;

        }

        .list-group-item {
            width: 600px;
        }

        .content {
            background-color: #f8f8f8;
            margin: 0 auto;
            padding: 20px;
            width: 600px;
            border-radius: 8px;
        }

        input[type="password"],
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #007BFF;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        button[type="submit"] {
            width: auto;
            background-color: #007BFF;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #002c5b;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], 'perfil.php')) echo 'active'; ?>">
                        <a class="nav-link" href="perfil.php">Meu perfil</a>
                    </li>
                    <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], 'vagas.php')) echo 'active'; ?>">
                        <a class="nav-link" href="vagas.php">Vagas</a>
                    </li>
                    <!-- <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], 'cursos.php')) echo 'active'; ?>">
                        <a class="nav-link" href="cursos.php">Cursos</a> -->
                    </li>
                    <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], 'candidaturas.php')) echo 'active'; ?>">
                        <a class="nav-link" href="candidaturas.php">Minhas Vagas</a>
                    </li>
                </ul>
            </div>
            <style>
                button[type="submit"] {
                    width: auto;
                    background-color: #007BFF;
                    color: white;
                    padding: 14px 20px;
                    margin: 8px 0;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }
            </style>
            <form class="form-inline my-2 my-lg-0" method="post">
                <button class="submit my-2 my-sm-0" type="submit" name="logout">Deslogar</button>
            </form>
        </nav>
    </header>
</body>

</html>