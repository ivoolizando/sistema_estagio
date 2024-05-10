<?php
include("conexao.php");

// Inserir dados do formulário no banco de dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST["nome"];
  $telefone = $_POST["telefone"];
  $email = $_POST["email"];
  $senha = $_POST["senha"];
  $confirmarsenha = $_POST["confirmarsenha"];
  $endereco = $_POST["endereco"];
  $estado = $_POST["estado"];
  $bairro = $_POST["bairro"];

  if ($senha == $confirmarsenha) {

    $sql = "INSERT INTO Aluno (nome, telefone, email, senha, endereco, estado, bairro)
  VALUES ('$nome', '$telefone', '$email','$senha','$endereco', '$estado', '$bairro')";

    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
                alert('Cadastro realizado com sucesso!');
                window.location.href = 'index.php';
              </script>";
      //echo "Novo registro criado com sucesso";
    } else {
      echo "Erro: " . $sql . "<br>" . $conn->error;
    }
  } elseif ($senha !== $confirmarsenha) {
    echo "<script type='text/javascript'>
                alert('Senhas não são iguais!');
                window.location.href = 'index.php';
              </script>";
    //echo ("Senhas não são iguais");
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
    Bairro: <input type="text" name="bairro">
    <br>
    <input --bs-primary type="submit">
  </form>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>