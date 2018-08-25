$(document).ready(function() {

    // setInterval(function(){

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

                    console.log(result);

                    $("table tbody").html("");

                    result.forEach(function(obj, key) {
                        $("table tbody").append('<tr>'+
                            '<td class="text-center">'+ obj.horavoo +'</td>' +
                            '<td class="destaque">'+ obj.cidades.nome + ' - ' + obj.cidades.estados.sigla +'</td>' +
                            '<td class="text-center">' +
                            '<img src="assets/img/cia-logotipos/'+ obj.cia.codigo +'.jpg" alt="" width="70">' +
                            '</td>' +
                            '<td>'+ obj.identificacao +'</td>' +
                            '<td class="text-center">'+ obj.portao +'</td>' +
                            '<td class="text-center">'+ obj.statusvoo.nome +'</td>' +
                            '</tr>');
                    });

                    if(result.length === 0){
                        $("table tbody").append('<tr>'+
                            '<td colspan="6" class="text-center">Não há voos agendados para hoje!</td>' +
                            '</tr>');
                    }

                    $('#loading').delay("2000").fadeOut();
                    // $('#loading').fadeOut(0);
                }
                else {
                    // alert("Data not found");
                }
            },
        });

    // }, 5000);


});