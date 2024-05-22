<?php
session_start();
include("conexao.php");

// Obtém os dados do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmarsenha = $_POST["confirmarsenha"];
    $endereco = $_POST["endereco"];
    $estado = $_POST["estado"];
    $cidade = $_POST["cidade"];
    $bairro = $_POST["bairro"];
    $curriculo = $_FILES["cv"]["name"];

    // Verifica se a pasta de uploads existe, senão cria
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Obtém a extensão do arquivo
    $file_extension = pathinfo($_FILES["cv"]["name"], PATHINFO_EXTENSION);

    // Cria um nome de arquivo com base no e-mail do aluno
    $new_filename = $email . "." . $file_extension;
    $target_file = $target_dir . $new_filename;

    // Move o arquivo para o diretório de uploads
    move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file);

    // Criptografa a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    if ($senha == $confirmarsenha) {
        $sql = "INSERT INTO Aluno (nome, telefone, email, senha, endereco, estado, cidade, bairro, curriculo)
                VALUES ('$nome', '$telefone', '$email', '$senha_hash', '$endereco', '$estado', '$cidade', '$bairro', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensagem'] = 'Cadastro realizado com sucesso!';
            echo "<script type='text/javascript'>
                    alert('Cadastro realizado com sucesso!');
                    window.location.href = 'login.php';
                  </script>";
            exit();
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script type='text/javascript'>
                alert('Senhas não são iguais!');
                window.location.href = 'cadastroAluno.php';
              </script>";
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h2 {
      color: #333;
      TEXT-ALIGN: center;
    }

    form {
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
  </style>

</head>

<body>
  <h2>CADASTRO DE ALUNO</h2>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    Nome: <input type="text" name="nome">
    <br>
    Telefone: <input type="text" name="telefone">
    <br>
    Email: <input type="text" name="email">
    <br>
    Senha: <input type="password" name="senha">
    <br>
    Confirmar Senha: <input type="password" name="confirmarsenha">
    <br>
    Endereço: <input type="text" name="endereco">
    <br>
    Estado: <input type="text" name="estado">
    <br>
    Cidade: <input type="text" name="cidade">
    <br>
    Bairro: <input type="text" name="bairro">
    <br>
    Currículo/CV: <input type="file" name="cv">
    <br>
    <input --bs-primary type="submit">
  </form>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>