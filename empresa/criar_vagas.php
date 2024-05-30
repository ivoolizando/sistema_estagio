  <?php
    include("../conexao.php");
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $Titulo = $_POST['titulo'];
        $Descricao = $_POST['descricao'];
        $Curso = $_POST['curso'];
        $Setor = $_POST['setor'];
        $Turno = $_POST['turno'];
        $VagaStatus = true;
        $DataPeriodoInicio = $_POST['periodo_inicio'];
        $DataPeriodoFinal = $_POST['periodo_final'];
        $DataEstagioInicio = $_POST['estagio_inicio'];
        $DataEstagioFinal = $_POST['estagio_final'];
        $Valor = $_POST['valor'];
        $Empresa_id = $_SESSION['id'];

        $sql = "INSERT INTO vaga(
    Titulo,
    Descricao,
    Curso ,
	Setor ,
	Turno,
    VagaStatus,
	DataPeriodoInicio,
    DataPeriodoFinal ,
	DataEstagioInicio ,
    DataEstagioFinal ,
	ValorBolsa,
    EmpresaID
     ) VALUES 
     (
     '$Titulo',
     '$Descricao',
     '$Curso',
     '$Setor',
     '$Turno',
     '$VagaStatus',
     '$DataPeriodoInicio',
     '$DataPeriodoFinal',
     '$DataEstagioInicio',
     '$DataEstagioFinal',
     '$Valor',
     '$Empresa_id');";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensagem'] = "Vaga criada com sucesso!";
            header('Location: vagas.php');
            exit();
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } else {
    }

    ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <body>
      <a href="vagas.php"><button class="btn">Voltar</button></a>
      <form class="content" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
          <h2>Cadastrar nova vaga</h2>

          <label for="">Título:</label>
          <input type="text" name="titulo">

          <label for="">Curso:</label>
          <input type="text" name="curso">

          <label for="">Setor:</label>
          <input type="text" name="setor">

          <label for="">Turno:</label>
          <select class="form-select" name="turno" required>
              <option value="Manhã" selected>Manhã</option>
              <option value="Tarde">Tarde</option>
              <option value="Noite">Noite</option>
          </select>

          <label for="">Periodo de Seleção Inicial:</label>
          <input type="date" name="periodo_inicio">

          <label for="">Periodo de Seleção Final:</label>
          <input type="date" name="periodo_final">

          <label for="">Inicio do estagio:</label>
          <input type="date" name="estagio_inicio">

          <label for="">Final do estagio:</label>
          <input type="date" name="estagio_final">

          <label for="">Valor da bolsa</label>
          <input type="text" name="valor">

          <label for="">Descrição</label>
          <textarea type="text" name="descricao"></textarea>

          <input type="submit" value="Criar vaga">

      </form>
  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
  </html>
  <style>
      textarea {
        height: 200px;
    }
    
      h2 {
          margin: auto;
      }
      
      select {
        margin-bottom: 20px;
        width: 20%;
      }

      body {
          font-family: Arial, sans-serif;
          background-color: #f0f0f0;
          padding: 20px;
      }

      form {
          display: flex;
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
          margin: 20px;
      }

      input[type="submit"]:hover {
          background-color: #0056b3;
      }

      .btn {
          width: auto;
          background-color: #007BFF;
          color: #FFF;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          border-radius: 4px;
          cursor: pointer;
      }

      .btn:hover {
          background-color: #002c5b;
          color: #FFF;
      }
  </style>