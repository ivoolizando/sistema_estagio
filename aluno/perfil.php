<?php
session_start();
include("../conexao.php");
include("componentes/header.php");


if (!isset($_SESSION['id'])) {
    // Se o usuário não estiver logado, redirecione para a página de login
    header('Location: login.php');
    exit();
}

$usuario = $_SESSION['id'];

// Busque os detalhes do usuário no banco de dados
$sql = "SELECT * FROM Aluno WHERE ID = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Saída dos dados de cada linha
    while ($row = $result->fetch_assoc()) {
        $nome = $row["Nome"];
        $telefone = $row["Telefone"];
        $email = $row["Email"];
        $endereco = $row["Endereco"];
        $estado = $row["Estado"];
        $cidade = $row["Cidade"];
        $bairro = $row["Bairro"];
        $curriculo = $row["Curriculo"];
    }
} else {
    echo "0 results";
}

// Se o formulário de edição de perfil for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_profile'])) {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $endereco = $_POST["endereco"];
    $estado = $_POST["estado"];
    $cidade = $_POST["cidade"];
    $bairro = $_POST["bairro"];

    $sql = "UPDATE Aluno SET Nome='$nome', Telefone='$telefone', Endereco='$endereco', Estado='$estado', Cidade='$cidade', Bairro='$bairro' WHERE ID='$usuario'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensagem'] = 'Atualizado com sucesso';
    } else {
        $_SESSION['mensagemerro'] = 'Alguma coisa deu errado';
    }
}

// Se o formulário de alteração de senha for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $senha = $_POST["senha"];
    $confirmarsenha = $_POST["confirmarsenha"];

    if ($senha == $confirmarsenha) {

        $sql = "UPDATE Aluno SET Senha='$senha' WHERE ID='$usuario'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensagem'] = 'Atualizado com sucesso';
        } else {
            $_SESSION['mensagemerro'] = 'Alguma coisa deu errado';
        }
    } else {
        $_SESSION['mensagemerro'] = 'Senhas não são iguais';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
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
            background-color: #002c5b;
        }

        button[type="submit"] {
            width: auto;
            background-color: #002c5b;
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
    <div class="container">
        <?php
        if (isset($_SESSION['mensagem'])) {
            echo '<div class="alert alert-success" role="alert">
                  ' . $_SESSION['mensagem'] . '
                  </div>';
            unset($_SESSION['mensagem']);
        }
        if (isset($_SESSION['mensagemerro'])) {
            echo '<div class="alert alert-danger" role="alert">
                  ' . $_SESSION['mensagemerro'] . '
                </div>';
            unset($_SESSION['mensagemerro']);
        }
        ?>
        <h2 class="my-3">Perfil do Aluno</h2>

        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Nome:</strong> <?php echo $nome; ?></p>
                <p><strong>Telefone:</strong> <?php echo $telefone; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Endereço:</strong> <?php echo $endereco; ?></p>
                <p><strong>Estado:</strong> <?php echo $estado; ?></p>
                <p><strong>Cidade:</strong> <?php echo $cidade; ?></p>
                <p><strong>Bairro:</strong> <?php echo $bairro; ?></p>
                <p><strong>Currículo:</strong> <a target="_blank" href="<?php echo '../' . $curriculo; ?>">Download</a></p>
            </div>
        </div>

        <div class="container" style="width: 35rem;">
            <h2 class="my-3">Editar Perfil</h2>

            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mb-3">
                <div class="form-group">
                    <label>Nome:</label>
                    <input class="form-control" type="text" name="nome" value="<?php echo $nome; ?>">
                </div>
                <div class="form-group">
                    <label>Telefone:</label>
                    <input class="form-control" type="text" name="telefone" value="<?php echo $telefone; ?>">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input class="form-control" type="text" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                    <label>Endereço:</label>
                    <input class="form-control" type="text" name="endereco" value="<?php echo $endereco; ?>">
                </div>
                <div class="form-group">
                    <label>Estado:</label>
                    <input class="form-control" type="text" name="estado" value="<?php echo $estado; ?>">
                </div>
                <div class="form-group">
                    <label>Cidade:</label>
                    <input class="form-control" type="text" name="cidade" value="<?php echo $cidade; ?>">
                </div>
                <div class="form-group">
                    <label>Bairro:</label>
                    <input class="form-control" type="text" name="bairro" value="<?php echo $bairro; ?>">
                </div>
                <input class="btn btn-primary" type="submit" name="edit_profile" value="Salvar">