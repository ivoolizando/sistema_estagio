<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $myemail = mysqli_real_escape_string($conn, $_POST['Email']);
   $mypassword = mysqli_real_escape_string($conn, $_POST['Senha']);

   $sql = "SELECT id FROM Aluno WHERE Email = '$myemail' and Senha = '$mypassword'";
   $result = mysqli_query($conn, $sql);
   $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

   $count = mysqli_num_rows($result);

   // Se o resultado for 1, o usuário e senha estão corretos
   if ($count == 1) {
      header("location: welcome.php");
   } else {
      $error = "Email ou senha inválidos!";
   }
}
?>

<html>

<head>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
   <div align="center">
      <div style="width:300px; border: solid 1px #333333;border-radius: 15px; " align="center">
         <div style="background-color:#333333; color:#FFFFFF; padding:3px;border-radius: 15px 15px 0px 0px;"><b>Login</b></div>

         <div style="display: flex; flex-direction: row; gap:30px; justify-content: center;">
            <button class="btn btn-primary" id="aluno" onclick="highlightButton('aluno')">Aluno</button>
            <button class="btn btn-primary" id="empresa" onclick="highlightButton('empresa')">Empresa</button>
         </div>


         <div style="margin:30px">

            <form action="" method="post">
               <label>E-mail  </label><input type="text" name="Email" class="box" /><br /><br />
               <label>Senha  </label><input type="password" name="Senha" class="box" /><br /><br />
               <input type="submit" value=" Enviar " /><br />
               <a id="cadastro" href="cadastroAluno.php">Cadastrar-se</a>

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
         document.getElementById('cadastro').href = 'cadastroAluno.php';
         if (id == "empresa") {
            document.getElementById('cadastro').href = 'cadastroEmpresa.php';
         }
         elseif(id == "aluno");
         {
            document.getElementById('cadastro').href = 'cadastroAluno.php';
   
         }
      }
      </script>

</body>

</html>