<?php
// set page headers
$page_title = "..."; //Cadastro de Voo

include_once "header.php";

// contents will be here
?>

    <div class="row">
        <form>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Identificação</label>
                    <input name="identificacao" type="text" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Portão</label>
                    <input name="portao" type="text" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>Data do Voo</label>
                    <input name="datavoo" type="text" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Companhia</label>
                    <input name="cia" type="text" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>Aeronave</label>
                    <select name="codigoaeronave" class="form-control">
                        <option selected>Selecione uma aeronave...</option>
                        <option value="1">Teste</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Cidade</label>
                    <select name="cidade" class="form-control">
                        <option value="" selected>Selecione uma cidade...</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Estado</label>
                    <select name="estado" class="form-control">
                        <option value="" selected>Selecione um estado...</option>
                    </select>
                </div>
            </div>

            <div class="form-row text-right">
                <button type="button" onclick="cadastrar()" class="btn btn-primary pull-right">Salvar</button>
            </div>
        </form>
    </div>

    <script>
        function cadastrar(){
            $(document).ready(function() {
                $.ajax({
                    type: "POST",
                    url: '../Controller/VooController.php',
                    data: {
                        acao: 'cadastrar',
                        identificacao: $('input[name="identificacao"]').val(),
                        portao: $('input[name="portao"]').val(),
                        cia: $('input[name="cia"]').val(),
                        datavoo: $('input[name="datavoo"]').val(),
                        codigoaeronave: $('select[name="codigoaeronave"]').val(),
                        // cidade: $('select[name="cidade"]').val(),
                        // estado: $('select[name="estado"]').val()
                    },
                    success: function(result) {
                        if(result) {
                            result = JSON.parse(result);

                            console.log(result);

                        }
                        else {
                            // alert("Data not found");
                        }
                    },
                });
            });
        }
    </script>

<?php

// footer
include_once "footer.php";

?>