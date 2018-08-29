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

                $("#estado").html(
                    '<option value="" selected>Selecione um estado...</option>'
                );

                result.forEach(function(obj, key) {
                    $("#estado").append(
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
            codigoestado: $("#estado").val()
        },
        success: function(result) {
            if(result) {
                result = JSON.parse(result);

                $("#cidade").html(
                    '<option value="" selected>Selecione uma cidade...</option>'
                );

                result.forEach(function(obj, key) {
                    $("#cidade").append(
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
            identificacao: $('#identificacao').val(),
            portao: $('#portao').val(),
            datavoo: $('#datavoo').val(),
            cia: $('#cia').val(),
            statusvoo: $('#statusvoo').val(),
            cidade: $('#cidade').val(),
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
    // Editar voo
    $.ajax({
        type: "POST",
        url: '../Controller/VooController.php',
        data: {
            acao: 'editar',
            identificacao: $('#identificacao').val(),
            portao: $('#portao').val(),
            datavoo: $('#datavoo').val(),
            cia: $('#cia').val(),
            statusvoo: $('#statusvoo').val(),
            cidade: $('#cidade').val(),
            codigo: codigo
        },
        success: function(result) {

            if(result) {
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

function selecionarvoo(codigo){
    // Selecionar voo
    $.ajax({
        type: "POST",
        url: '../Controller/VooController.php',
        data: {
            acao: 'selecionar',
            codigo: codigo
        },
        success: function(result) {

            if(result) {
                result = JSON.parse(result);

                $('#identificacao').val(result.identificacao);
                $('#portao').val(result.portao);
                $('#datavoo').val(result.datavoo);

                $('#cia').val(result.cia.codigo);
                $('#statusvoo').val(result.statusvoo.codigo);
                $('#estado').val(result.cidades.codigoestado);
                $('#cidade').val(result.cidades.codigo);

            }
            else {
                swal(
                    'Ops!',
                    'Não foi possível selecionar o Voo!',
                    'error'
                );
            }
        },
    });
}