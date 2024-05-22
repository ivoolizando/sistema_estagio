<?php
session_start();
include("conexao.php");

// Aqui vai inserir os dados do formulário no banco de dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cnpj = $_POST["cnpj"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmarsenha = $_POST["confirmarsenha"];

    // Criptografa a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    if ($senha == $confirmarsenha) {
        $sql = "INSERT INTO Empresa (nome, cnpj, email, senha)
        VALUES ('$nome', '$cnpj', '$email', '$senha_hash')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensagem'] = 'Cadastro realizado com sucesso!';
            echo "<script type='text/javascript'>
                alert('Cadastro realizado com sucesso!');
                window.location.href = 'login.php';
              </script>";
            header('Location: login.php');
            exit();
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script type='text/javascript'>
                alert('Senhas não são iguais!');
                window.location.href = 'cadastroEmpresa.php';
              </script>";
        exit();
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