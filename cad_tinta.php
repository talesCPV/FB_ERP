<?php
  include "valida.inc";
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Cadastro de Produtos</title>
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
      include "funcoes.inc";
    ?>
  </header>

<div class="page_container">  
  <div class="page_form">
    <p class="logo"> Cadastro de Tintas</p> <br>
    <form class="login-form" name="cadastro" method="POST" action="#" id="frmSaveTinta">
      <label> Descrição *</label>
      <input type="text" name="nome" maxlength="80" id="edtDesc"/>
      <input type="hidden" name="forn" value="FARBEN S/A INDÚSTRIA QUÍMICA" />
      <input type="hidden" name="und" value="LATA" />
      <input type="hidden" name="estoque" value="99" />
      <input type="hidden" name="tipo" value="TINTA" />
      <input type="hidden" name="est_min" value="0" />
      <?php  

      include "conecta_mysql.inc";
      if (!$conexao)
        die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());

        $query = "SELECT * from tb_produto ORDER BY  cod";
        $result = mysqli_query($conexao, $query);
        $cod = 0;

        while($fetch = mysqli_fetch_row($result)){
          $cod = $fetch[7];
        }
        $conexao->close();
        $cod = intval($cod) + 1;
        echo "<input type=\"hidden\" name=\"cod\" value=\"".$cod."\" />";

      ?>

      <label> Codigo do Produto</label>
      <input type="text" name="cod_bar" maxlength="15"/>
      <input type="hidden" name="ncm" value="38081010" />
      <label> Preço de Custo R$ - 900ml *</label>
      <input type="text" name="compra" maxlength="15" onkeyup="return float_number(this)" id="edtPreco"/>
      <label> Margem de Lucro %</label>
      <input type="text" name="margem" value="90" maxlength="15" onkeyup="return float_number(this)"/>
      <button name="save" type="submit" id="btnSaveTinta" onclick="return obrigatorio(['edtDesc','edtPreco'])">Cadastrar</button>
      </form>

<?php
      switch (get_post_action('save')) {
        case 'save':

          if (IsSet($_POST ["nome"])){

            $nome = $_POST ["nome"];
            $cod = $_POST ["cod"];
            $cod_bar = $_POST ["cod_bar"];
            $compra = $_POST ["compra"];
            $margem = $_POST ["margem"];

            include "conecta_mysql.inc";
            if (!$conexao)
              die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());

            $query = "INSERT INTO tb_produto ( descricao, estoque, etq_min, unidade, cod, cod_bar, id_emp, ncm, preco_comp, margem, tipo) 
            VALUES ('$nome', '99', '0','1/4', '$cod', '$cod_bar', 16, '32081010', '$compra', '$margem', 'TINTA')";
            
            mysqli_query($conexao, $query);
            $conexao->close();

          }

        break;
      }
?>

  </div>
</div>

</body>
</html>