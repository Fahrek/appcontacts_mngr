<?php

if (empty($_POST['id'])) {
        var_dump($_POST['id']);
    $errors[] = 'ID está vacío.';
} elseif (isset($_POST['id'])) {
    require_once '../conexion.php';//Contiene funcion que conecta a la base de datos
    // escaping, additionally removing everything that could be (html/javascript-) code
//    $prod_code = mysqli_real_escape_string($con, strip_tags($_POST['edit_code'], ENT_QUOTES));
    $contact_name  = mysqli_real_escape_string($con, strip_tags($_POST['name'],  ENT_QUOTES));
    $contact_lname = mysqli_real_escape_string($con, strip_tags($_POST['lname'], ENT_QUOTES));
    $contact_email = mysqli_real_escape_string($con, strip_tags($_POST['email'], ENT_QUOTES));
    $contact_cat   = mysqli_real_escape_string($con, strip_tags($_POST['cat'],   ENT_QUOTES));
//    $stock = (int)$_POST['edit_stock'];
//    $price = (float)$_POST['edit_price'];

    $id = (int)$_POST['id'];
    // UPDATE data into database
    $sql   = "UPDATE users SET name = '" . $contact_name . "', lname = '" . $contact_lname . "', email = '" . $contact_email . "', cat = '" . $contact_cat . "' WHERE id = '" . $id . "' ";
    $query = mysqli_query($con, $sql);
    // if contact has been added successfully
    if ($query) {
        $messages[] = 'Contacto editado correctamente.';
    } else {
        $errors[] = 'Error al actualizar contacto.';
    }
} else {
    $errors[] = 'desconocido.';
}

if (isset($errors)) {

    ?>
        <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong>
            <?php
            foreach ($errors as $error) {
                echo $error;
            }
            ?>
        </div>
    <?php
}

if (isset($messages)) {

    ?>
        <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>De acuerdo</strong>
            <?php
            foreach ($messages as $message) {
                echo $message;
            }
            ?>
        </div>
    <?php
}
?>
