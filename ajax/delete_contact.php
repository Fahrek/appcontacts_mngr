<?php

if (empty($_POST['delete_id'])) {
    $errors[] = 'Id vacío.';
} elseif (isset($_POST['delete_id'])) {
    require_once '../conexion.php';//Contiene funcion que conecta a la base de datos
    // escaping, additionally removing everything that could be (html/javascript-) code

    $id_contact = (int)$_POST['delete_id'];


    // DELETE FROM  database
    $sql   = "DELETE FROM users WHERE id='$id_contact'";
    $query = mysqli_query($con, $sql);
    // if contact has been added successfully
    if ($query) {
        $messages[] = 'Contacto eliminado correctamente';
    } else {
        $errors[] = 'Error al borrar contacto';
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
