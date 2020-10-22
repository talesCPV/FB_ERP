<?php
  include "valida.inc";
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <title>Cadastro de Usuários</title>
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
    <p class="logo"> Cadastro de Usuários</p> <br>
    <form class="login-form" name="cadastro" method="POST" action="save_user.php"  >
      <label> Usuário *</label>
      <input type="text" name="user" id="edtUser" maxlength="12"/>
      <label> Senha *</label>
      <input type="password" name="pass" id="edtSenha1" maxlength="12"  />
      <label> Repita a senha *</label>
      <input type="password" name="repass" id="edtSenha2" maxlength="12" />
      <label> Tipo de Acesso </label>
      <select name="classe" id="classe">
          <option value="1">Contador</option>
          <option value="2">Comercial</option>
          <option value="3">Colorista</option>
          <option value="4">Gerente</option>
          <option value="10">CEO</option>
      </select>
      <button type="submit" onclick="return obrigatorio(['edtUser','edtSenha1']) && verif_senha(['edtSenha1','edtSenha2'])">Cadastrar</button>

    </form>
  </div>
</div>

</body>
</html>