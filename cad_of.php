<?php
  include "valida.inc";
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Ordem de Fabricação</title>
    <!--Bootsrap 4 CDN-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--JQUERY CDN-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> 

    <!--Custom styles-->
  	<link rel="stylesheet" type="text/css"  href="css/estilo.css" />

    <!--Custom Javascript-->
    <script src="js/edt_mask.js"></script>
</head>
<body>
  <header>

    <?php
      include "menu.php";
    ?>
  </header>

<div class="page_container">  
  <div class="page_form">
    <p class="logo"> Ordem de Fabricação</p> <br>
    <form class="login-form" name="cadastro" method="POST" action="save_of.php">
      <?php  

      include "conecta_mysql.inc";
      if (!$conexao)
        die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());

      $gera_cod = substr(strtoupper(date('Y')), 2, 2).date('md');

      $query = "select * from tb_servico where num_serv like '".$gera_cod."%';";
      $result = mysqli_query($conexao, $query);
      $qtd_lin  = $result->num_rows + 1;

echo"
      <label> OF Num. * </label>
      <input type=\"text\" name=\"num_of\" id='edtNumOF' maxlength=\"15\" value=\"".$gera_cod."-".$qtd_lin."\" />
";

      ?>
      <label> Tipo </label>
      <select name="selTipo">
        <option value="OF" > Ordem de Fabricação </option>
        <option value="OS" > Ordem de Serviço </option>
      </select>
      <label> Data </label>
      <input type="date" name="data_of" value="<?php echo date('Y-m-d'); ?>">
      <label> Funcionário Resp.:</label>
      <input type="text" name="func" maxlength="30" />
      <label> Emitido por</label>
      <input type="text" name="responsavel" value="<?php if (IsSet($_COOKIE["usuario"])){ echo $_COOKIE["usuario"]; } ?>" readonly/>
      <button type="submit" onclick="return obrigatorio(['edtNumOF'])">Gerar</button>
      <input type="hidden" name="novo" value="1">

    </form>
  </div>
</div>

</body>
</html>