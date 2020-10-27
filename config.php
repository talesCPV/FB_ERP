<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Configuracoes</title>
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

      $unid = 'config/unidades.txt';
      $ass = 'config/'.$user.'_ass.txt';
      $color = "config/".$user."_colors.txt";

      if (IsSet($_POST ["edtUnd"]) and $classe >=4 ){
         $texto = $_POST ["edtUnd"];
         $fp = fopen($unid, "w");
         fwrite($fp, $texto);
         fclose($fp);
      }
      if (IsSet($_POST ["edtMail"])){
        $texto = $_POST ["edtMail"];
        $fp = fopen($ass, "w");
        fwrite($fp, $texto);
        fclose($fp);
     }
     if (IsSet($_POST ["edtLousa"])){
        $destino = $_POST ["destino"];
        $texto = "\n \n".$user." escreveu em ".date('d/m/Y')."\n \n".$_POST ["edtLousa"];
        $fp = fopen("lousa/".$destino.".txt", "a");
        fwrite($fp, $texto);
        fclose($fp);
      }
      if (IsSet($_POST ["menu-color"])){
        $texto = $_POST ["barra-color"] ."\r\n".$_POST ["background-color"] ."\r\n".$_POST ["btn0-color"]."\r\n".$_POST ["menu-color"]."\r\n".$_POST ["sel-color"]."\r\n".$_POST ["form-color"]."\r\n".$_POST ["fonte-color"];
        $fp = fopen($color, "w");
        fwrite($fp, $texto);
        fclose($fp);
     }


     if(file_exists ($color)){
       $fp = fopen($color, "a+");
       $barra = fgets($fp,4096);
       $back = fgets($fp,4096);
       $btn0 = fgets($fp,4096);
       $menu = fgets($fp,4096);
       $menuSel = fgets($fp,4096);
       $form = fgets($fp,4096);
       $fonte = fgets($fp,4096);
       fclose($fp);
     }else{
      $barra = '#f0f0f0';
      $back =  '#2e2e2e';
      $btn0 = '#2e2e2e';
      $menu = '#f0f0f0';
      $menuSel = '#2e2e2e';
      $form = '#ffffff';
      $fonte = '#2e2e2e';
     }

    ?>
  </header>

<div class="page_container">  
  <div class="page_form">
    <p class="logo"> Configuracao</p> <br>
    <form class="login-form" name="cadastro" method="POST" action="#" onsubmit="return validaCampo(); return false;">
      <label> Unidades de Medida </label>
      <?php  
          echo "<textarea class='edtTextArea' name='edtUnd' cols='112' rows='5'>";
          if(file_exists ($unid)){
            $fp = fopen($unid, "a+");
            while (!feof ($fp)) {
              $valor = fgets($fp,4096);
              echo $valor;
            }
            fclose($fp);
          }
      echo"</textarea>";

      echo "<label> Assinatura de Email </label>
      <textarea class='edtTextArea' name=\"edtMail\" cols=\"112\" rows=\"5\" >";
      
          if(file_exists ($ass)){
            $fp = fopen($ass, "a+");
            while (!feof ($fp)) {
              $valor = fgets($fp,4096);
              echo $valor;
            }
            fclose($fp);
          }
      
      
      echo "</textarea>";
  

      include "conecta_mysql.inc";
      if (!$conexao)
        die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());

        $query = "SELECT * from tb_usuario where user != \"".$user."\"";
        $result = mysqli_query($conexao, $query);


        echo"<br><br><label> Lousa de Recados </label>

           <td><select name=\"destino\" >
           <option selected value=\"0\"> Nenhum </option>";


        while($fetch = mysqli_fetch_row($result)){
            echo $fetch[1] . "<br>";
            echo "<option value=\"". $fetch[1] ."\">". $fetch[1] ."</option>";
        }

            echo "</select> </td>";
          $conexao->close();
  
        echo"<textarea class='edtTextArea' name=\"edtLousa\" cols=\"112\" rows=\"5\" >";

        echo"</textarea>";

      ?>

        <label> Cores <br></label>
        <table><tr>
          <td> Barra Superior.... </td>
          <td> Fundo </td>
          <td>  <input name="barra-color" type="color" <?php echo"value='". trim($barra) ."'" ?> /> </td>
          <td> Menu </td>     
          <td> <input name="menu-color" type="color" <?php echo"value='". trim($menu) ."'" ?> /> </td>
          <td> Fonte </td>     
          <td> <input name="sel-color" type="color" <?php echo"value='". trim($menuSel) ."'" ?> /> </td>
        </tr><tr> 
          <td> Tela.................... </td>
          <td> Fundo </td>     
          <td> <input name="background-color" type="color" <?php echo"value='". trim($back) ."'" ?> /> </td>
          <td> Form </td>     
          <td> <input name="form-color" type="color" <?php echo"value='". trim($form) ."'" ?> /> </td>
          <td> Botões </td>     
          <td> <input name="btn0-color" type="color" <?php echo"value='". trim($btn0) ."'" ?> /> </td>
          <td> fonte </td>     
          <td> <input name="fonte-color" type="color" <?php echo"value='". trim($fonte) ."'" ?> /> </td>
        </tr></table>

      <button type="submit">Salvar</button> <br>

    </form>      

  </div>
</div>


</body>
</html>