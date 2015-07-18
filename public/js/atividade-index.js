var oTable;
var giRedraw = false;

$(document).ready(function() {

    // click na linha do grid
    $(".datagrid tbody").click(function(event) {

        if($(event.target.parentNode).hasClass('selected')){
            $(event.target.parentNode).removeClass('selected');
        }else{
            $(event.target.parentNode).addClass('selected');
        }

    });

    // duplo click na linha do grid
    $(".datagrid tbody").dblclick(function(event) {
        $(oTable.fnSettings().aoData).each(function (){
            $(this.nTr).removeClass('selected');
        });

        $(event.target.parentNode).addClass('selected');

        edit();

    });

    // DATAGRID
    oTable = $(".datagrid").dataTable({
        "bStateSave": false,
        "aLengthMenu": [[1,10, 20, 50, 100, -1], [1,10, 20, 50, 100, "Todos"]],
        "oLanguage": {
            "sProcessing":   "Processando...",
            "sLengthMenu":   "Mostrar _MENU_ registros",
            "sZeroRecords":  "Não foram encontrados resultados",
            "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
            "sInfoPostFix":  "",
            "sSearch":       "",
            "sUrl":          ""
        },
        "sPaginationType": "full_numbers",
        "aaSorting": [[ 1, "asc" ]],
        "aoColumnDefs": [
            { "bSearchable": false, "bVisible": true, "aTargets": [ 0 ] },
            { "bSearchable": false, "bVisible": false, "aTargets": [ 1 ] },
            { "bSearchable": true, "bVisible": true, "aTargets": [ 2 ] },
            { "bSearchable": true, "bVisible": true, "aTargets": [ 3 ] }
        ]
    });

    // EDIT
    $('a#edit').click(function() {
        edit();
    });


    // VIEW
    /*$('a#view').click(function() {
     view();
     });*/

    // SELECT ALL
    $("a#select_all").click(function() {
        $(oTable.fnSettings().aoData).each(function (){
            $(this.nTr).addClass('selected');
        });
    });

    // SELECT NONE
    $("a#select_none").click(function() {
        $(oTable.fnSettings().aoData).each(function (){
            $(this.nTr).removeClass('selected');
        });
    });


    // DELETE
    $('a#delete').click(function() {

        var ids = "";
        var count = 0;

        // percorre as linhas selecionadas
        oTable.$("tr").filter(".selected").each(function (index, row){
            var nTds = $('td', row);
            var id = $(nTds[0]).text();

            ids+="-" + id;
            count++;
        });

        if(count>=1) {
            ids = ids.substring(1, ids.length);
            idsMsg = ids.split("-");
            idsMsg = idsMsg.join(", ");
            idsMsg = idsMsg.replace(/,\s([^,]+)$/, ' e $1');

            var msg = "";
            if(count>1)
                msg = "Deseja realmente excluir os registros <b>" + idsMsg + "</b> ?";
            else
                msg = "Deseja realmente excluir o registro <b>" + idsMsg + "</b> ?";

            $.msgBox({
                title: "Excluir?",
                content: msg,
                type: "confirm",
                buttons: [{ value: "Sim" }, { value: "Não" }, { value: "Cancelar"}],
                success: function (result) {
                    if (result == "Sim") {
                        remove(ids);
                    }
                }
            });

        }else{

            $.msgBox({
                title:"Atenção",
                content:"Nenhum registro selecionado!",
                type:"info"
            });

        }

    });


    $("#sortable").sortable({
        revert: true
    });


    $("#save-sortable").click( function(e){

        var values = "";
        var i = 0;
        $("ul#sortable li").each( function(){
            if ( i == 0 )
                values = $(this).attr('id');
            else
                values += "-" + $(this).attr('id');

            i++;
        });

        if ( values ) {

            $.getJSON('/atividade/reorganize',{
                ids: values,
                ajax: 'true'
            }, function(j){

                if ( j.sucess ) {

                    $.msgBox({
                        title:"Atenção",
                        content:"Salvo com sucesso!",
                        type:"info",
                        buttons: [{ value: "Ok" }],
                        success: function (result) {
                            if (result == "Ok") {
                                var host = window.location.toString();
                                $(window.location).attr('href', host);
                            }
                        }
                    });

                } else {

                    $.msgBox({
                        title:"Atenção",
                        content:"ERRO ao tentar ao reorganizar!",
                        type:"error"
                    });
                }

            });

        }
    } );

});// document.read


function partnerInfoToJSON() {
    return JSON.stringify({
        "titulo": "TEST",
        "descricao": "Meus testes"
    });
};

function edit() {

    var anSelected = fnGetSelected( oTable );

    var nTds = $('td', anSelected);
    var id = $(nTds[0]).text();

    if (id){
        var host = window.location.toString();
        $(window.location).attr('href', host + '/edit/' + id);
        ev.stopPropagation();
    } else {

        $.msgBox({
            title:"Atenção",
            content:"Nenhum registro selecionado!",
            type:"info"
        });

    }
}

function remove(ids) {
    var host = window.location.toString();
    $(window.location).attr('href', host + '/delete/' + ids);
}

function fnGetSelected( oTableLocal ) {

    var aReturn = new Array();
    var aTrs = oTableLocal.fnGetNodes();

    for ( var i=0 ; i<aTrs.length ; i++ ) {

        if ( $(aTrs[i]).hasClass('selected') ) {
            aReturn.push( aTrs[i] );
        }
    }
    return aReturn;
}