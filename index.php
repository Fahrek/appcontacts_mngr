<!DOCTYPE html>
<html lang="es">

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Agenda de contactos</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="css/bootstrap-tagsinput.css">
</head>

<body>
<div class="container">
        <div class="table-wrapper">
                <div class="table-title">
                        <div class="row">
                                <div class="col-sm-6">
                                        <h2>Administrar <b>Contactos</b></h2>
                                </div>
                                <div class="col-sm-6">
                                        <form method="post" action="ajax/export.php" align="center">
                                                <input id="export" type="submit" name="export" value="CSV Export" class="btn btn-success" />
                                        </form>
                                        <a href="#addProductModal" class="btn btn-success" data-toggle="modal">
                                                <i class="material-icons">&#xE147;</i>
                                                <span>Agregar nuevo contacto</span>
                                        </a>
                                </div>
                        </div>
                </div>
<!--                <div class='col-sm-4 pull-right'>-->
<!--                        <div id="custom-search-input">-->
<!--                                <div class="input-group col-md-12">-->
<!--                                        <input type="text" class="form-control" placeholder="Buscar" id="q" onkeyup="load(1);"/>-->
<!--                                        <span class="input-group-btn">-->
<!--                                    <button class="btn btn-info" type="button" onclick="load(1);">-->
<!--                                        <span class="glyphicon glyphicon-search"></span>-->
<!--                                    </button>-->
<!--                                </span>-->
<!--                                </div>-->
<!--                        </div>-->
<!--                </div>-->
<!--                <div class='clearfix'></div>-->
<!--                <hr>-->
                <div id="loader"></div><!-- Carga de datos ajax aqui -->
                <div id="resultados"></div><!-- Carga de datos ajax aqui -->
                <div class='outer_div'></div><!-- Carga de datos ajax aqui -->
        </div>
</div>

<!-- Edit Modal HTML -->
<?php include 'html/modal_add.php'; ?>
<!-- Edit Modal HTML -->
<?php include 'html/modal_edit.php'; ?>
<!-- Delete Modal HTML -->
<?php include 'html/modal_delete.php'; ?>

<script src="js/ajax.js"></script>
<script src="js/bootstrap-tagsinput.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="https://kit.fontawesome.com/f120471f65.js" crossorigin="anonymous"></script>

</body>
</html>
