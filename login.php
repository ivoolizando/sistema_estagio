<?php
include("conexao.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $myemail = mysqli_real_escape_string($conn, $_POST['Email']);
   $mypassword = mysqli_real_escape_string($conn, $_POST['Senha']);
   $switch = mysqli_real_escape_string($conn, $_POST['switch']);

   if ($switch == 0) {
      $sql = "SELECT id, senha FROM Aluno WHERE Email = '$myemail'";
   } else if ($switch == 1) {
      $sql = "SELECT id, senha FROM Empresa WHERE Email = '$myemail'";
   }

   $result = mysqli_query($conn, $sql);
   $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

   if ($row) {
      $stored_hash = $row['senha']; // Senha criptografada armazenada no banco de dados
      if (password_verify($mypassword, $stored_hash)) {
         // Autenticação bem-sucedida
         $id = $row['id'];
         $email = $myemail;

         // Armazena os dados na sessão
         $_SESSION['usuario'] = $email;
         $_SESSION['id'] = $id;

         if ($switch == 0) {
            header('Location: aluno/index.php');
            exit();
         } elseif ($switch == 1) {
            header('Location: empresa/index.php');
            exit();
         }
      } else {
         $_SESSION['mensagemerro'] = "E-mail ou Senha não coincidem.";
         header('Location: login.php');
         exit();
      }
   } else {
      $_SESSION['mensagemerro'] = "Usuário não encontrado.";
      header('Location: login.php');
      exit();
   }
}
?>

<html>

<head>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
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
   <div align="center">
      <br>
      <h1>Sistema Estágio</h1>
      <br>
      <div style="width:400px; border: solid 1px #333333;border-radius: 15px; " align="center">
         <div style="background-color:#333333; color:#FFFFFF; padding:3px;border-radius: 15px 15px 0px 0px;"><b>Login</b></div>
         <br>
         <h5>Entrar como:</h5>
         <div style="display: flex; flex-direction: row; gap:30px; justify-content: center;">
            <button class="btn btn-success btn-primary" id="aluno" onclick="highlightButton('aluno')">Aluno</button>
            <button class="btn btn-primary" id="empresa" onclick="highlightButton('empresa')">Empresa</button>
         </div>

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


         <div style="margin:30px">
            <form action="" method="post">
               <input type="hidden" name="switch" id="switch" value="0" />
               <label>E-mail:</label><input style="margin-left: 2px;" type="text" name="Email" class="box" /><br /><br />
               <label>Senha:</label><input style="margin-left: 2px;" type="password" name="Senha" class="box" /><br /><br />
               <input class="btn btn-primary" style="margin-bottom: 5px;" type="submit" value=" Entrar " /><br />
               <p>Ou tente <a id="cadastro" href="cadastroAluno.php">Cadastrar-se</a></p>

            </form>

            <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php
                                                                        if (isset($error)) {
                                                                           echo $error;
                                                                        }  ?></div>

         </div>

      </div>

   </div>
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

   <script>
      function highlightButton(id) {
         document.getElementById('aluno').classList.remove('btn-success');
         document.getElementById('empresa').classList.remove('btn-success');
         document.getElementById(id).classList.add('btn-success');

         if (id == "aluno") {
            document.getElementById('switch').value = "0";
            document.getElementById('cadastro').href = 'cadastroAluno.php';
         } else if (id == "empresa") {
            document.getElementById('switch').value = "1";
            document.getElementById('cadastro').href = 'cadastroEmpresa.php';
         }
      }
   </script>
</body>

</html>