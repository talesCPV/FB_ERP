
$(document).ready(function(){


    $.fn.perm = function(classe, area){ 
        var stay = true;
        var pathname = window.location.pathname.split('/')[2] ; 
        var fileJson = '';    
        dados = 'path=../config/menu.json';
    
        $.ajax({
            url: 'ajax/ajax_getJson.php',
            type: 'POST',
            dataType: 'html',
            data: dados,
            async: false,
            success: function(data){
                fileJson = data;
    
            }
    
        });	
        
        var par = $.parseJSON(fileJson);
        $.each(par['access'], function(index, value) {
            if(pathname == value['url']){
    
                if( $.inArray( parseInt(classe) , value[area] ) !== -1 ){
                    stay = true;
                }else{
                    stay = false;
                }
            }
        });
        return (stay);
    }


    var classe = getCookies('classe');

    if (!$(this).perm(classe,'open')){
        $(window.document.location).attr('href',$(this).urlPath(window.location.href) + 'main.php');
    }

    // DUPLO CLIQUE NA TEBELA tabItens


    $('#tabItens').on('dblclick','.tbl_row', function(){ // SELECIONANDO UM ÍTEM DA TABELA (DUPLO CLIQUE)

        var id_cargo = $.trim($(this).children('td').slice(0, 1).text().toUpperCase());
        var cargo = $.trim($(this).children('td').slice(1, 2).text().toUpperCase());
        var tipo = $.trim($(this).children('td').slice(2, 3).text().toUpperCase());
        var sal = ClearMoney($.trim($(this).children('td').slice(3, 4).text()));

        var table = "<table><tr><td>Cargo *</td><td> <input type='text' name='cargo' maxlength='40' id='edtCargo' value='"+cargo+"'/></td></tr>";
        table +=   "<tr><td>Salário * R$</td><td><input type='text' name='edtSal' id='edtSal' onkeyup='return money(this)' value='"+sal+"'/></td></tr>";
        if(tipo == "HORISTA"){
            table +=   "<tr><td>Tipo</td><td><select name='tipo' id= 'selTipo'> <option selected='selected' value='HORA'>HORISTA</option><option value='MENSAL'>MENSALISTA</option></select></td></tr>";
        }else{
            table +=   "<tr><td>Tipo</td><td><select name='tipo' id= 'selTipo'> <option value='HORA'>HORISTA</option><option selected='selected' value='MENSAL'>MENSALISTA</option></select></td></tr>";
        }
        table +=   "<tr><td><button id='btn_Save'>Salvar</button></td><td><button id='btn_Del'>Deletar</button></td></tr></table>";
        table +=   "<form id='frmRefresh' method='POST' action='#'></form>";

        $(document).off('click', '#btn_Save').on('click', '#btn_Save', function() {
            var cargo = $('#edtCargo').val().trim().toUpperCase();
            if(cargo != "" && $('#edtSal').val().trim() != ""){
                var sal = parseFloat($('#edtSal').val());
                var tipo = $('#selTipo').val();
                var query = "query=UPDATE tb_cargos SET cargo = '"+ cargo +"', salario = "+ sal +", tipo = '"+ tipo+"' WHERE id = '"+ id_cargo +"';";
                queryDB(query);  
                $('#frmRefresh').submit();                               
            }else{
                alert('Todos os campos com * são obrigatórios');

            }
        });

        $(document).off('click', '#btn_Del').on('click', '#btn_Del', function() {
            if (confirm('Confirma a exclusão deste cargo?')) {                    
                var query = "query=DELETE FROM tb_cargos WHERE id = '"+ id_cargo +"';";
                queryDB(query); 
                $('#frmRefresh').submit();  
            }
        });                


        alert(table);


        $(".content").html(table);
        $('#popTitle').html('Cadastro de Cargos e Funções');    

    });


     // POPUP CLOSE
     $('.close').click(function(){ // BOTÃO FECHAR DO POPUP
        $(".overlay").css("visibility", "hidden").css("opacity", "0");

    }); 

});