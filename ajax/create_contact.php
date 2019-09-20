<?php

if (empty($_POST['name'])) {
    $errors[] = 'Introduce el nombre del contacto.';
} elseif (isset($_POST['name'])) {
    require_once '../conexion.php';//Contiene funcion que conecta a la base de datos
    // escaping, additionally removing everything that could be (html/javascript-) code
//    $prod_code = mysqli_real_escape_string($con, strip_tags($_POST["code"], ENT_QUOTES));
    $contact_name  = mysqli_real_escape_string($con, strip_tags($_POST["name"], ENT_QUOTES));
    $contact_lname = mysqli_real_escape_string($con, strip_tags($_POST["lname"], ENT_QUOTES));
    $contact_email = mysqli_real_escape_string($con, strip_tags($_POST["email"], ENT_QUOTES));
    $contact_cat   = mysqli_real_escape_string($con, strip_tags($_POST["cat"], ENT_QUOTES));
//    $stock = (int)$_POST['stock'];
//    $price = (float)$_POST['price'];

    // REGISTER data into database
    $sql = "INSERT INTO users (id, name, lname, email, cat) VALUES (NULL, '$contact_name', '$contact_lname', '$contact_email', '$contact_cat')";
//    var_dump($sql);
//    die;
    $query = mysqli_query($con, $sql);
    // if contact has been added successfully
    if ($query) {
        $messages[] = 'El contacto ha sido guardado con éxito.';
    } else {
        $errors[] = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.';
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
                <strong>¡Bien hecho!</strong>
            <?php
            foreach ($messages as $message) {
                echo $message;
            }
            ?>
        </div>
    <?php
}
?>
