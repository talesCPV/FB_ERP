
    function ClearMoney(campo){
        var ok_chr = new Array('1','2','3','4','5','6','7','8','9','0');
        var text = campo;
        var out_text = '';

        for(var i = 0; i<text.length; i++){

            if(ok_chr.includes(text.charAt(i))){
                out_text = out_text + text.charAt(i)
            }
        }
        return out_text.substr(0,out_text.length-2)+"."+out_text.substr(out_text.length-2,out_text.length) ;
    }

$(document).ready(function(){
    $('#tabItens').on('dblclick','.tbl_row', function(){
        var codProd = $.trim($(this).children('td').slice(0, 1).text().toUpperCase());
        var desc = $.trim($(this).children('td').slice(1, 2).text().toUpperCase());
        var und = $.trim($(this).children('td').slice(2, 3).text().toUpperCase());
        var etq = $.trim($(this).children('td').slice(3, 4).text());
        var preco = $.trim($(this).children('td').slice(4, 5).text().toUpperCase());
        var forn = $.trim($(this).children('td').slice(5, 6).text().toUpperCase());
        var codPed = $.trim($(this).children('td').slice(6, 7).text().toUpperCase());
        var tipo = $.trim($(this).children('td').slice(7, 8).text().toUpperCase());
        var id = $.trim($(this).children('td').slice(8, 9).text().toUpperCase());
        var table = "<table><td>Und.:</td><td>"+und+"</td></tr><td>Preço:</td><td>"+ preco +"</td></tr><td>Forn.:</td><td>"+forn+"</td></tr></table>";

        var form = "<form id='frmAddItem' method='POST' action='add_item.php'><input type='hidden' name='preco' value='"+ ClearMoney(preco) +"'><input type='hidden' name='op' value='add'><input type='hidden' name='cod_prod' value='"+id+"'><input type='hidden' name='und' value='"+und+"'><input type='hidden' name='cod_ped' value='"+codPed+"'><input type='hidden' name='tipo' value='"+tipo+"'>";
        var Btn = "<table><tr><div class='form-group mx-sm-3 mb-2'> <td> <label> Qtd. </label></td><td><input class='form-control' id='edtQtd' type='text' name='qtd'/></td></div>";
        if(tipo == 'TINTA'){
            Btn = Btn + " <td><select name='vol'><option value='0.5'>450ml</option><option selected='selected' value='1'>900ml</option><option value='2'>1.8L</option><option value='3'>2.7L</option><option value='4'>3.6L</option></select></td>";
        }else{
            Btn = Btn + "<input type='hidden' name='vol' value='1'>";
        }

        Btn = Btn + "<td><button class='btn btn-primary' name='adicionar' id='btnAdd'>Adicionar</button></td></tr></table></form>";

        $(document).off('click', '#btnAdd').on('click', '#btnAdd', function() {
            $('#frmAddItem').submit();
        });

        $(document).off('keyup', '#edtQtd').on('keyup', '#edtQtd', function() {
            txt = $('#edtQtd').val()
            $("#edtQtd").val($(this).numeros(txt));
        });         

        $(".content").html(table+form+Btn);
        $('#popTitle').html(desc);
        $(".overlay").css("visibility", "visible").css("opacity", "1");  

    });

    $('#tabChoise').on('dblclick','.tbl_row', function(){ // SELECIONANDO UM ÍTEM DA TABELA (DUPLO CLIQUE)
        $('[name="cod_prod"]').val($.trim($(this).children('td').slice(0, 1).text().toUpperCase()));
        $('[name="qtd"]').val($.trim($(this).children('td').slice(3, 4).text().toUpperCase()));
        $('[name="preco"]').val(ClearMoney($.trim($(this).children('td').slice(4, 5).text().toUpperCase())));
//            $('[name="preco"]').val($(this).moeda($.trim($(this).children('td').slice(4, 5).text().toUpperCase())));


        $(document).off('keyup', '#edtEdtQtd').on('keyup', '#edtEdtQtd', function() { // VALIDA OS FORMULARIOS 
            txt = $('#edtEdtQtd').val()
            $("#edtEdtQtd").val($(this).numeros(txt));
        }); 

         $(document).off('keyup', '#edtEdtPreco').on('keyup', '#edtEdtPreco', function() { // VALIDA OS FORMULÁRIOS
            txt = $('#edtEdtPreco').val()
//                $("#edtEdtPreco").val(ClearMoney(txt));
            $("#edtEdtPreco").val($(this).moeda(txt));
        }); 
    });

     // POPUP CLOSE
     $('.close').click(function(){ // BOTÃO FECHAR DO POPUP
        $(".overlay").css("visibility", "hidden").css("opacity", "0");

    }); 

});