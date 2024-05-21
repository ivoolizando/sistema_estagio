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
                <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], 'cursos.php')) echo 'active'; ?>">
                    <a class="nav-link" href="cursos.php">Cursos</a>
                </li>
                <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], 'candidaturas.php')) echo 'active'; ?>">
                    <a class="nav-link" href="candidaturas.php">Minhas Vagas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Relatórios</a>
                </li>
            </ul>
        </div>
        <!-- mudando o link p um botão clicavel -->
        <form class="form-inline my-2 my-lg-0" method="post">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="logout">Deslogar</button>
        </form>
    </nav>
</header>
<?php

if(isset($_POST['logout'])) {
    session_start();
    session_destroy();
    header('Location: ../login.php');
    exit;
}
?>

