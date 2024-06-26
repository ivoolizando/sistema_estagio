<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .btn-success {
            color: #fff;
            background-color: #002c5b;
            border-color: #002c5b;
        }

        .btn-success:hover {
            color: #fff;
            background-color: #002c5b;
            border-color: #002c5b;
        }

        .btn-success:focus {
            box-shadow: none;
            background-color: #002c5b;
            border-color: #002c5b;
        }
    </style>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="vagas.php">Vagas <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Empresas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Relatórios</a>
                    </li>
                </ul>
            </div>

            <form class="form-inline my-2 my-lg-0" method="post">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="logout">Deslogar</button>
            </form>

        </nav>
    </header>
</head>
<?php
// verifica se o botão foi pressionado
if (isset($_POST['logout'])) {
    session_start();
    session_destroy();
    header('Location: ../login.php');
    exit;
}
?>