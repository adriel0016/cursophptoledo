$(document).ready(function() {

    $('#loading').fadeIn(0);

    $(function () {
        $("#datavoo").datetimepicker({
            language: 'pt-BR',
            format: "dd/mm/yyyy - hh:ii",
            todayBtn: 0,
            autoclose: 1,
            showMeridian: 0,
            pickerPosition: "bottom-right",
            startDate: new Date(),
            minuteStep: 10,
            daysOfWeekDisabled: []
        });
    });

    // Carregar CIA
    $.ajax({
        type: "POST",
        url: '../Controller/CiaController.php',
        data: {
            acao: 'selecionartodos'
        },
        success: function(result) {
            if(result) {
                result = JSON.parse(result);

                $("#cia").html(
                    '<option value="" selected>Selecione uma cia...</option>'
                );

                result.forEach(function(obj, key) {
                    $("#cia").append(
                        '<option value="'+obj.codigo+'" class="text-center">'+ obj.nome +'</option>'
                    );
                });

            }
            else {
                swal(
                    'Ops!',
                    'Ocorreu um erro ao carregar CIA!',
                    'error'
                );
            }
        },
    });

    // Carregar Status do Voo
    $.ajax({
        type: "POST",
        url: '../Controller/StatusVooController.php',
        data: {
            acao: 'selecionartodos'
        },
        success: function(result) {
            if(result) {
                result = JSON.parse(result);

                $("#statusvoo").html(
                    '<option value="" selected>Selecione um status...</option>'
                );

                result.forEach(function(obj, key) {
                    $("#statusvoo").append(
                        '<option value="'+obj.codigo+'" class="text-center">'+ obj.nome +'</option>'
                    );
                });

            }
            else {
                swal(
                    'Ops!',
                    'Ocorreu um erro ao carregar Status Voo!',
                    'error'
                );
            }
        },
    });

    // Carregar Estados
    $.ajax({
        type: "POST",
        url: '../Controller/EstadosController.php',
        data: {
            acao: 'selecionartodos'
        },
        success: function(result) {
            if(result) {
                result = JSON.parse(result);

                $("#estados").html(
                    '<option value="" selected>Selecione um estado...</option>'
                );

                result.forEach(function(obj, key) {
                    $("#estados").append(
                        '<option value="'+obj.codigo+'" class="text-center">'+ obj.nome +'</option>'
                    );
                });

            }
            else {
                swal(
                    'Ops!',
                    'Ocorreu um erro ao carregar Estados!',
                    'error'
                );
            }
        },
    });

    $('#loading').delay("2000").fadeOut();

});

function selecionacidades(){
    $.ajax({
        type: "POST",
        url: '../Controller/CidadesController.php',
        data: {
            acao: 'selecionarporestado',
            codigoestado: $("#estados").val()
        },
        success: function(result) {
            if(result) {
                result = JSON.parse(result);

                $("#cidades").html(
                    '<option value="" selected>Selecione uma cidade...</option>'
                );

                result.forEach(function(obj, key) {
                    $("#cidades").append(
                        '<option value="'+obj.codigo+'" class="text-center">'+ obj.nome +'</option>'
                    );
                });

            }
            else {
                swal(
                    'Ops!',
                    'Ocorreu um erro ao carregar Cidades!',
                    'error'
                );
            }
        },
    });
}

function cadastrar(){
    // Cadastrar voo
    $.ajax({
        type: "POST",
        url: '../Controller/VooController.php',
        data: {
            acao: 'cadastrar',
            identificacao: $('input[name="identificacao"]').val(),
            portao: $('input[name="portao"]').val(),
            datavoo: $('input[name="datavoo"]').val(),
            cia: $('select[name="cia"]').val(),
            statusvoo: $('select[name="statusvoo"]').val(),
            cidade: $('select[name="cidade"]').val()
        },
        success: function(result) {

            if(result > 0) {
                result = JSON.parse(result);

                swal(
                    'Opa!',
                    'Voo cadastrado com sucesso!',
                    'success'
                );

                $('form')[0].reset();

            }
            else {
                swal(
                    'Ops!',
                    'Não foi possível cadastrar o Voo!',
                    'error'
                );
            }
        },
    });
}

function editar(codigo){
    // Cadastrar voo
    $.ajax({
        type: "POST",
        url: '../Controller/VooController.php',
        data: {
            acao: 'editar',
            identificacao: $('input[name="identificacao"]').val(),
            portao: $('input[name="portao"]').val(),
            datavoo: $('input[name="datavoo"]').val(),
            cia: $('select[name="cia"]').val(),
            statusvoo: $('select[name="statusvoo"]').val(),
            cidade: $('select[name="cidade"]').val(),
            codigo: codigo
        },
        success: function(result) {

            if(result > 0) {
                result = JSON.parse(result);

                swal(
                    'Opa!',
                    'Voo editado com sucesso!',
                    'success'
                );

                $('form')[0].reset();

            }
            else {
                swal(
                    'Ops!',
                    'Não foi possível editar o Voo!',
                    'error'
                );
            }
        },
    });
}