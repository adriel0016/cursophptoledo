$(document).ready(function() {

    $('#loading').fadeIn(0);

    $.ajax({
        type: "POST",
        url: '../Controller/VooController.php',
        data: {
            acao: 'selecionartodos'
        },
        success: function(result) {
            if(result) {
                result = JSON.parse(result);

                $("table tbody").html("");

                result.forEach(function(obj, key) {
                    $("table tbody").append('<tr>'+
                        '<td class="text-center">'+ obj.horavoo +'</td>' +
                        '<td class="destaque">'+ obj.cidades.nome + ' - ' + obj.cidades.estados.sigla +'</td>' +
                        '<td class="text-center">' +
                        '<img src="assets/img/cia-logotipos/'+ obj.cia.codigo +'.jpg" alt="" width="70" height="30">' +
                        '</td>' +
                        '<td>'+ obj.identificacao +'</td>' +
                        '<td class="text-center">'+ obj.portao +'</td>' +
                        '<td class="text-center">'+ obj.statusvoo.nome +'</td>' +
                        '<td class="text-center">' +
                        '<a href="cadastrarvoo.php?codigo='+ obj.codigo + '" style="font-size: 14px; color: #b7b7b7; margin: 0 5px;">' +
                        '<i class="fa fa-edit"></i>' +
                        '</a>' +

                        '<i class="fa fa-trash-alt" onclick="excluir('+ obj.codigo + ')" style="font-size: 14px; color: #b7b7b7; margin: 0 5px; cursor: pointer;"></i>' +
                        '</td>' +
                        '</tr>');
                });

                if(result.length === 0){
                    $("table tbody").append('<tr>'+
                        '<td colspan="7" class="text-center">Não há voos agendados para hoje!</td>' +
                        '</tr>');
                }

                $('#loading').delay("2000").fadeOut();
            }
            else {
                swal(
                    'Ops!',
                    'Ocorreu um erro ao carregar os Voos!',
                    'error'
                );
            }
        },
    });

});

function excluir(codigo){
    // Excluir voo
    $.ajax({
        type: "POST",
        url: '../Controller/VooController.php',
        data: {
            acao: 'excluir',
            codigo: codigo
        },
        success: function(result) {

            if(result) {
                location.reload();
            }
            else {
                swal(
                    'Ops!',
                    'Não foi possível excluir um Voo!',
                    'error'
                );
            }
        },
    });
}