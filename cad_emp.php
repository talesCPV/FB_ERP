<?php
  include "valida.inc";
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
    <title>Cadastro de Empresas</title>
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
    <p class="logo"> Cadastro de Empresas</p> <br>
    <form class="login-form" name="cadastro" method="POST" action="save_emp.php" id="frmSaveEmp">
      <label> Nome *</label>
      <input type="text" name="nome" maxlength="50" id="edtNome"/>
      <label> Endereço </label>
      <input type="text" name="endereco" maxlength="60"/>
      <label> Cidade </label>
      <input type="text" name="cidade" maxlength="30"/>
      <label> Bairro </label>
      <input type="text" name="bairro" maxlength="60"  />
      <label> Numero </label>
      <input type="text" name="num" maxlength="5" onkeyup="return int_number(this)"/>
      <label> Estado </label>
      <select name="estado" id="estado">
        <option value="AC">Acre</option>
        <option value="AL">Alagoas</option>
        <option value="AP">Amapa</option>
        <option value="AM">Amazonas</option>
        <option value="BA">Bahia</option>
        <option value="CE">Ceara</option>
        <option value="ES">Espirito Santo</option>
        <option value="DF">Distrito Federal</option>
        <option value="MA">Maranhao</option>
        <option value="MT">Mato Grosso</option>
        <option value="MS">Mato Grosso do Sul</option>
        <option value="MG">Minas Gerais</option>
        <option value="PA">Para</option>
        <option value="PB">Paraiba</option>
        <option value="PR">Parana</option>
        <option value="PE">Pernambuco</option>
        <option value="PI">Piaui</option>
        <option value="RJ">Rio de Janeiro</option>
        <option value="RN">Rio Grande do Norte</option>
        <option value="RS">Rio Grande do Sul</option>
        <option value="RO">Rondonia</option>
        <option value="RR">Roraima</option>
        <option value="SC">Santa Catarina</option>
        <option selected="selected" value="SP">Sao Paulo</option>
        <option value="SE">Sergipe</option>
        <option value="TO">Tocantins</option>
      </select>
      <label> CEP </label>
      <input type="text" name="cep" maxlength="10" onkeyup="return format_cep(this)"/>
      <label> CNPJ </label>
      <input type="text" name="cnpj" maxlength="18" onkeyup="return format_cnpj(this)" />
      <label> Inscrição Estadual </label>
      <input type="text" name="ie" maxlength="15" onkeyup="return format_ie(this)"/>
      <label> Tipo </label>
      <select name="tipo">
        <option value="FOR">Fornecedor</option>
        <option value="CLI">Cliente</option>
      </select>
      <label> Telefone </label>
      <input type="text" name="fone" maxlength="14" onkeyup="return format_fone(this)"/>
      <button type="submit" onclick="return obrigatorio(['edtNome'])">Cadastrar</button>
    </form>
  </div>
</div>

</body>
</html>