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
                                    <input id="identificacao" type="text" class="form-control" required>
                                </div>
                                <div class="form-group col-4">
                                    <label>Portão</label>
                                    <input id="portao" type="text" class="form-control" required>
                                </div>
                                <div class="form-group col-4">
                                    <label>Data do Voo</label>
                                    <input id="datavoo" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>Companhia</label>
                                    <select id="cia" class="form-control" required></select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Status do Voo</label>
                                    <select id="statusvoo" class="form-control" required></select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>Estado</label>
                                    <select id="estado" class="form-control" onchange="selecionacidades()" required></select>
                                </div>
                                <div class="form-group col-6">
                                    <label>Cidade</label>
                                    <select id="cidade" class="form-control" required></select>
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

        <!-- FUNÇÕES JS REFERENTES AO CADASTRO -->
        <script src="assets/js/functions-cadastrarvoo.js"></script>

        <?php if(isset($_GET['codigo'])){ ?>
            <script>
                selecionarvoo('<?= $_GET['codigo'] ?>');
            </script>
        <?php } ?>

    </body>
</html>
