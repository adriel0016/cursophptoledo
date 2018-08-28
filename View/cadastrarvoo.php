<?php
/**
 * Created by PhpStorm.
 * User: ADRIE
 * Date: 26/08/2018
 * Time: 20:39
 */

?>

    <!doctype html>
    <html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/custom.css">

        <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css" />

        <link rel="stylesheet" href="assets/css/sweetalert.css">

        <title>Cadastrar Voos</title>
    </head>
    <body>

        <?php
        include_once "header.php";
        ?>

        <div class="site">
            <div class="container">
                <form>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <label>Identificação</label>
                                    <input name="identificacao" type="text" class="form-control" required>
                                </div>
                                <div class="form-group col-4">
                                    <label>Portão</label>
                                    <input name="portao" type="text" class="form-control" required>
                                </div>
                                <div class="form-group col-4">
                                    <label>Data do Voo</label>
                                    <input id="datavoo" name="datavoo" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>Companhia</label>
                                    <select id="cia" name="cia" class="form-control" required></select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Status do Voo</label>
                                    <select id="statusvoo" name="statusvoo" class="form-control" required></select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>Estado</label>
                                    <select id="estados" class="form-control" onchange="selecionacidades()" required></select>
                                </div>
                                <div class="form-group col-6">
                                    <label>Cidade</label>
                                    <select id="cidades" name="cidade" class="form-control" required></select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <?php
                                if(isset($_GET['codigo'])){ ?>
                                    <button type="button" class="btn btn-sm btn-primary" style="float: right;" onclick="editar(<?= $_GET['codigo'] ?>)">Editar</button>
                            <?php } else{ ?>
                                     <button type="button" class="btn btn-sm btn-primary" style="float: right;" onclick="cadastrar()">Salvar</button>
                            <?php } ?>
                        </div>
                    </div>
                </form>

                <div id="loading" style="display: none;">
                    <img src="assets/img/loading.gif" alt="">
                </div>
            </div>
        </div>

        <?php
        include_once "footer.php";
        ?>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="assets/js/locales/bootstrap-datetimepicker.pt-BR.js" charset="UTF-8"></script>

        <script src="assets/js/sweetalert.min.js"></script>

        <!--<script src="assets/js/functions.js"></script>-->

        <script>

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
                            alert("Ocorreu um erro ao carregar CIA!");
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
                            alert("Ocorreu um erro ao carregar Status Voo!");
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
                            // alert("Ocorreu um erro ao carregar Estados!");
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
                            // alert("Ocorreu um erro ao carregar Estados!");
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
                            // alert("Data not found");
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
                            // alert("Data not found");
                        }
                    },
                });
            }
        </script>

    </body>
</html>
