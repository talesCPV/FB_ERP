<?php
  include "valida.inc";
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Entrada de Material</title>
    <!--Bootsrap 4 CDN-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--JQUERY CDN-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> 

    <!--Custom styles-->
  	<link rel="stylesheet" type="text/css"  href="css/estilo.css" />

    <!--Custom Javascript-->
    <script src="js/funcoes.js"></script>
</head>
<body>
  <header>

    <?php
      include "menu.php";
    ?>
  </header>

<div class="page_container">  
  <div class="page_form">
    <p class="logo"> Entrada de Material</p> <br>
    <form class="login-form" name="cadastro" method="POST" action="save_ent.php">
      <label> Nota Fiscal (NF) </label>
      <input type="text" name="nf" maxlength="15" />
      <label> Fornecedor </label>
      <?php  

      include "conecta_mysql.inc";
      if (!$conexao)
        die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());

        $query = "SELECT * from tb_empresa where tipo = \"FOR\"";
        $result = mysqli_query($conexao, $query);

          echo "<td><select name=\"forn\" id=\"emp\">";

        while($fetch = mysqli_fetch_row($result)){
            echo $fetch[1] . "<br>";
            echo "<option value=\"". $fetch[0] ."\">". $fetch[1] ."</option>";
        }

            echo "</select> </td>";
          $conexao->close();
      ?>
      <label> Data </label>
      <input type="date" name="data_ent" value="<?php echo date('Y-m-d'); ?>">
      <label> Emitido por</label>
      <input type="text" name="resp" value="<?php if (IsSet($_COOKIE["usuario"])){ echo $_COOKIE["usuario"]; } ?>" readonly/>
      <button type="submit">Salvar</button>

    </form>
  </div>
</div>

</body>
</html>