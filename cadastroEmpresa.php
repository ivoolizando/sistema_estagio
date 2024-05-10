<?php
include("conexao.php");

// Inserir dados do formulário no banco de dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cnpj = $_POST["cnpj"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmarsenha = $_POST["confirmarsenha"];

    if ($senha == $confirmarsenha) {
        $sql = "INSERT INTO Empresa (nome, cnpj, email, senha)
        VALUES ('$nome','$cnpj', '$email','$senha')";

        if ($conn->query($sql) === TRUE) {
            echo ("Cadastro realizado com sucesso!");
            //header('Location: index.php');
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($senha !== $confirmarsenha) {
        echo ("Senhas não são iguais");
        //header('Location: index.php');
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Empresa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        form {
            display: flex;
            align-items: center;
            flex-direction: column;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 90%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            display: block;
            padding: 10px 20px;
            margin: auto;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <form action="cadastroEmpresa.php" method="post">
        <label for="nome">Nome da Empresa:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="cnpj">CNPJ:</label>
        <input type="text" id="cnpj" name="cnpj" required><br><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required><br><br>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="senha" required><br><br>

        <label for="password">Confirma Senha:</label>
        <input type="password" id="password" name="confirmarsenha" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>

</html>