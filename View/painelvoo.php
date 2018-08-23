<?php
/**
 * Created by PhpStorm.
 * User: Adriel
 * Date: 23/08/2018
 * Time: 10:38
 */

?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <title>Voos em Tempo Real</title>
    </head>
    <body>

        <div class="container">
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">Hora</th>
                        <th scope="col">Destino</th>
                        <th scope="col">Cia</th>
                        <th scope="col">Voo</th>
                        <th scope="col">Portão</th>
                        <th scope="col">Observação</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script type="application/javascript">
            $(document).ready(function() {
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

                            result.forEach(function(obj, key) {
                                $("table tbody").append('<tr>'+
                                                            '<td>'+ obj.datavoo +'</td>' +
                                                            '<td>'+ obj.destino +'</td>' +
                                                            '<td>'+ obj.cia +'</td>' +
                                                            '<td>'+ obj.identificacao +'</td>' +
                                                            '<td>'+ obj.portao +'</td>' +
                                                            '<td>'+ obj.status +'</td>' +
                                                        '</tr>');
                            });

                            // alert("Data found");
                        }
                        else {
                            // alert("Data not found");
                        }
                    },
                });
            });
        </script>

    </body>
</html>