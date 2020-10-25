<?php
	setcookie("cod_serv");
  	include "valida.inc";
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Feriados</title>
    <!--Bootsrap 4 CDN-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--JQUERY CDN-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
  	  	<p class="logo"> Feriados</p> <br>
      <button id="btn_NovoFeriado">Novo</button>

	  </div>
	  <?php

        include "conecta_mysql.inc";
        if (!$conexao)
            die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());

            $query =  "SELECT *	FROM tb_feriados ORDER BY mes, dia;";

        $result = mysqli_query($conexao, $query);
				  

        echo"  <div class=\"page_form\" id=\"no_margin\">
                <table class=\"search-table\" id=\"tabChoise\" >   
                    <tr>
                        <th>Data.</th>
                        <th>Descrição</th>
                    </tr>";
                    while($fetch = mysqli_fetch_row($result)){
                        echo "<tr class='tbl_row'>".
                                    "<td style='display: none;'>" .$fetch[0] . "</td>".
                                    "<td>" .sprintf("%02d", $fetch[1])  ."/".sprintf("%02d", $fetch[2]) . "</td>".
                                    "<td style='display: none;'>" .$fetch[3] . "</td>".
                                    "<td>" .$fetch[4] . "</td></tr>";
                                    
                    }
        echo"    </table> 
                </div>";
				$conexao->close();
	  ?>
  	  
  </div>

<div class="overlay">	
  <div class="popup">
    <h2 id="popTitle"></h2>
    <div class="close" >&times</div>
    <div class="content"></div>
  </div>
</div>

</body>
</html>