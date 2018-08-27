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

        <title>Voos em Tempo Real</title>
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
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-4">
                                    <label>Portão</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group col-4">
                                    <label>Data do Voo</label>
                                    <input id="datavoo" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>CIA</label>
                                    <select id="cia" class="form-control"></select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Status do Voo</label>
                                    <select id="statusvoo" class="form-control"></select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>Estado</label>
                                    <select id="estados" class="form-control" onchange="selecionacidades()"></select>
                                </div>
                                <div class="form-group col-6">
                                    <label>Cidade</label>
                                    <select id="cidades" class="form-control"></select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-sm btn-primary" style="float: right;" onclick="cadastrar()">Salvar</button>
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

                $('#loading').delay("2000").fadeOut();

            });
        </script>

    </body>
</html>
