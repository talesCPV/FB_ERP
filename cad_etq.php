<?php
  include "valida.inc";
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Etiquetas</title>
    <!--Bootsrap 4 CDN-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--JQUERY CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <!--Custom styles-->
    <link rel="stylesheet" type="text/css"  href="css/estilo.css" />

    <!--Custom Javascript-->  
    <script src="js/edt_mask.js"></script> 
    <script src="js/cad_etq.js"></script> 
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
                
                    <h2>Etiquetas</h2>
                    <p>Criador de etiquetas p/ tintas e solventes Farben/Flexibus</p>

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#Produto">Produto</a></li>
                        <li><a data-toggle="tab" href="#Campos">Campos</a></li>
                        <li><a data-toggle="tab" href="#Visualizar"> Visualizar</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="Produto" class="tab-pane fade in active">
                            <div class="page_form" id="no_margin">
                                <p class="logo"> Pesquisa </p> <br>
                                <form class="login-form" method="POST" action="#">
                                    <table class="search-table"  border="0">
                                        <tr>
                                            <td> <label> Busca por: </label> </td>
                                            <td><select id="selBusca" name="campo">
                                                    <option value="desc">Descricao</option>
                                                    <option value="cod">Codigo</option>
                                                    <option value="cod_bar">Cod. Produto</option>
                                                </select></td>
                                            <td><input type="text" id="edtBusca" name="valor" maxlength="12"/></td>
                                            <td><button name="prod" id="botao_inline" type="submit">OK</button></td>
                                        </tr>  
                                    </table>
                                </form>
                            </div>



                            <?php
                                $qtd_lin = 0;
                                if (IsSet($_POST ["campo"])){

                                include "conecta_mysql.inc";
                                if (!$conexao)
                                die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());

                                $campo = $_POST ["campo"];
                                $valor = $_POST ["valor"];

                                if ($campo == "desc"){
                                    $query =  "SELECT id, cod, descricao, cod_bar, tipo FROM tb_produto WHERE descricao LIKE '%".$valor."%' AND cod >=7000 ORDER BY cod desc;";
                                }
                                else
                                if ($campo == "cod"){
                                    $query =  "SELECT id, cod, descricao, cod_bar, tipo FROM tb_produto WHERE cod = '".$valor."' ORDER BY cod ;";
                                }
                                else
                                if ($campo == "cod_bar"){
                                    $query =  "SELECT id, cod, descricao, cod_bar, tipo FROM tb_produto WHERE cod_bar = '".$valor."' ORDER BY cod ;";
                                }

                                $result = mysqli_query($conexao, $query);

                                $qtd_lin = $result->num_rows;



                            echo"  <div class=\"page_form\" id=\"no_margin\">
                                <table class=\"search-table\" id=\"tabItens\">
                                    <tr>
                                    <th class=\"center_text\">Cod.</th>
                                    <th class=\"center_text\">Descricao</th>
                                    <th class=\"center_text\">Cod. Prod.</th>
                                    </tr>";
                                    while($fetch = mysqli_fetch_row($result)){

                                        $cod_prod = $fetch[0];
                                        $desc = $fetch[2];
                                        $cod_prefix = $fetch[3];

                                        echo "<tr class='tbl_row'>
                                                <td class=\"center_text\" >" .$fetch[1] . "</td>
                                                <td>" .$fetch[2] . "</td>
                                                <td class=\"center_text\" >" .$fetch[3] . "</td>
                                            </tr>";
                                        
                                    }
                                    echo"
                                </table> 

                                </div>
                                ";
                                $conexao->close();
                                }
                            ?>


                        </div>
                        <div id="Campos" class="tab-pane fade">

                            
                            <div class="page_form" id= "no_margin">
                            <form class="login-form" method="POST" action="#"   >
                            <label> Fornecedor </label>
                            <input type="text" name="forn" maxlength="30" value="FLEXIBUS SANFONADOS LTDA" />
                            <label> Cliente </label>
                            <input type="text" name="cli" maxlength="30"/>
                            <label> Descrição </label>";
                            <?php
                                if (IsSet($_POST ["desc"])){
                                    echo "<input type=\"text\" name=\"desc\" id='edtDesc' maxlength=\"60\" value='".$_POST["desc"]."' />";
                                }else{
                                    echo "<input type=\"text\" name=\"desc\" id='edtDesc' maxlength=\"60\" value='' />";
                                }
                            ?>
                            <label> Tipo de Tinta </label>
                            <select name="tipo">
                                <option value="ES">Esmalte Sintético</option>
                                <option selected="selected" value="AC">PU Acrílico</option>
                                <option value="AL">PU Alquídico</option>
                                <option value="LN">Laca Nitro</option>
                                <option value="PL">Poliéster</option>
                                <option value="EP">Epóxi</option>
                                <option value="SB">PU Acrílico Semi-Brilho</option>
                            </select>
                            <label> Fabricação </label>
                            <input type="text" name="fab" maxlength="25" value= <?php echo"'".date('d/m/Y')."'" ?> />
                            <label> Validade (3 anos)</label>
                            <input type="text" name="val" maxlength="25" value= <?php echo"'". date('d/m/Y', strtotime("+ 3 years",strtotime(date('Y-m-d')))) ."'" ?>/>    
                            <label> Volume </label>
                            <select name="vol">
                                <option value="450ml">450ml</option>
                                <option selected="selected" value="900ml">900ml</option>
                                <option value="1.8L">1.8 litro</option>
                                <option value="2.7L">2.7 litros</option>
                                <option value="3.6L">3.6 litros</option>
                                <option value="5L">5 litros</option>
                                <option value="18L">18 litros</option>
                            </select>
                            <table><tr>
                                <td><label> Qtd. Etiquetas </label></td>
                                <td><input type='number' name='qtd' maxlength='2' value='1' onkeyup='return float_number(this)'/></td>
                                <td><button name='adicionar' id='botao_inline' class= 'btnAdicionar' type='submit'>Adicionar</button></td>
                            </tr></table>
                            <input type="hidden" name="cod_prod" id='hdn_CPD' value=<?php echo "'".get_etq("CPD")."'" ?>\>
                            </form>
                            </div> 

                        </div>
                        <div id="Visualizar" class="tab-pane fade">
                            <?php
                                $path = "config/etq_data.cfg";
                                echo"
                                    <div class=\"page_form\" id= \"no_margin\">
                                    <form class=\"login-form\" name=\"cadastro\" method=\"POST\" action=\"#\" >
                                    <select name=\"sel_etq\" size=\"10\">
                                    <optgroup label=\"Selecione a linha para deletar\">";
                                $count = 0;
                                if (file_exists($path)){
                                    $fp = fopen($path, "r");
                                    while (!feof ($fp)) {  // varre as linhas do arquivo
                                    
                                        $linha = fgets($fp,4096);
                                        $field = explode("|", $linha);
                                        if(count($field) > 7){
                                        echo"<option value=\"".$count."\" >".$field[6]." - ".$field[2]."</option>";
                                        $count++;
                                        }
                                    }
                                    fclose($fp);
                                }                  
                    // colocar o select e o botão del sob o mesmo form
                                echo"
                                    </optgroup>
                                    </select>    
                                    <table><tr>            
                                    <td><button name=\"del\" id=\"botao_inline\" type=\"submit\">Deletar Linha</button></td>
                                    <td><button name=\"limpar\" id=\"botao_inline\" type=\"submit\">Limpar Tudo</button></td>
                                    </form>  
                                    <form class=\"login-form\" name=\"cadastro\" method=\"POST\" action=\"pdf_etq.php\" >
                                    <td><button name=\"imprimir\" id=\"botao_inline\" type=\"submit\">Imprimir</button></td>
                                    </form>  
                                    </tr></table>
                                    </div>";

                            ?>
                        </div>
  
                    </div>
               


                <?php

                    switch (get_post_action('adicionar', 'limpar', 'del')) {
                    case 'adicionar':

                        if (IsSet($_POST ["forn"])){
                            $text = ""; 
                            for($i=0; $i < $_POST ["qtd"]; $i++){
                            $text = $text . $_POST ["forn"]."|".$_POST ["cli"]."|".$_POST ["desc"]."|".$_POST ["tipo"]."|".$_POST ["fab"]."|".$_POST ["val"]."|".$_POST ["vol"]."|".$_POST ["cod_prod"]."\r\n";
                            }
                            $fp = fopen("config/etq_data.cfg", "a");
                            fwrite($fp, $text);
                            fclose($fp);

                            echo '<script>
                                    $(document).ready(function(){ 
                                        $("#btnVisualizar").click();
                                    });
                                </script>';
                        }
                            
                        break;

                    case 'limpar':
                        $path = "config/etq_data.cfg";
                        if (file_exists($path))
                        {unlink($path);
                        }
                        break;

                    case 'del':
                        $path = "config/etq_data.cfg";

                        if (IsSet($_POST ["sel_etq"])){
                            if (file_exists($path)){
                                $fp = fopen($path, "r");
                                $count = 0;
                                $txt="";
                                while (!feof ($fp)) {  // varre as linhas do arquivo                
                                $linha = fgets($fp,4096);
                                if ($count != $_POST ["sel_etq"]){
                                    $txt = $txt . $linha;
                                }
                                $count++;
                                }
                            }
                            fclose($fp);
                            $fp = fopen($path, "w");
                            fwrite($fp, $txt);
                            fclose($fp);
                        }
                        break;

                    }   


                ?>



                
            </div>
        </div>
    </body>
</html>