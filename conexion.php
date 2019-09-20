<?php

// DB credentials.
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'contacts');

# Conectar la base de datos
$con = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$con) {
    die('Imposible conectarse: ' . mysqli_error($con));
}
if (@mysqli_connect_errno()) {
    die('Error de conexión: ' . mysqli_connect_errno() . ' : ' . mysqli_connect_error());
}