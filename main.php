<?php
  include "valida.inc";
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Menu Principal</title>
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
  	  	<?php
  	  		if (IsSet($_COOKIE["message"])){
  	  			echo $_COOKIE["message"];
          }

  	  	?>
	  </div>


  <?php 

  if (file_exists("lousa/".$user.".txt")) {
    echo"  <div class=\"page_form\" id=\"no_margin\">";

          $fp = fopen("lousa/".$user.".txt", "r");
          while (!feof ($fp)) {
            $valor = fgets($fp,4096);
            echo $valor."<br>" ;
          }
          fclose($fp);

    echo"  
          <form class=\"login-form\" name=\"limpa\" method=\"POST\" action=\"limpa_lousa.php\" onsubmit=\"return verifica(); return false;\">
 
            <button type=\"submit\" name=\"limpar\" value = \"1\">Limpar Lousa</button>
            <input type=\"hidden\" name=\"file\" value=\"lousa/".$user.".txt\">
          </form>    
          </div>";

  } 

    
  ?>

  </div>



</body>
</html>