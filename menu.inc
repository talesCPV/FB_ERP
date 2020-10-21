    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  -->
    <!-- <script src="js/jqFunc.js"></script>                                                      -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Flexibus</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>


<?php


  setlocale(LC_MONETARY,"pt_BR", "ptb");

  if (IsSet($_COOKIE["classe"])){
    $classe = $_COOKIE["classe"];
    $user = $_COOKIE["usuario"];
  }

    // LÊ O ARQUIVO MENU.JSON
    $arquivo = "config/menu.json";
    $fp = fopen($arquivo, "r");
    $menu_json = fread($fp, filesize($arquivo));
    fclose($fp);

    $json_str = json_decode($menu_json, true);

		foreach ( $json_str['menu'] as $e ) {

    	echo" <li class='nav-item dropdown'> ";


      $main_name = $e['modulo'];
      $main_perm = $e['perm'];
      $main_id = $e['id'];
      $main_link = $e['link'];

      if(in_array($classe, $main_perm)){

        echo"
            <a class='nav-link dropdown-toggle' href='". $main_link ."' id='". $main_id ."' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                ". $main_name ." </a>  ";


        foreach ($e['itens'] as $a ) {
          if(in_array($classe, $a['perm'])){
//            echo"<li><a href='". $a['link']."'>". $a['nome'] ."</a></li>";
              echo "  <a class='dropdown-item' href='". $a['link']."'>". $a['nome'] ."</a>  ";
          }
        }
      }



        echo("</li>");


		} 

    echo"
		    
		   
		    <div class=\"top_bar_rigth\">".strtoupper($user);
        if (IsSet($_COOKIE["mail_pass"])){
            echo " <a href=\"email.php\"><img src=\"img/small_mail.png\"></a>";
        }
     echo" <a href=\"profile.php\"><img src=\"img/small_gear.png\"></a> <a href=\"logout.php\"><img src=\"img/small_logout.png\"></a></div>";

     echo"   </div>"; // fim do echo principal


?>

    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">



            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    main menu
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>



          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
    </nav>