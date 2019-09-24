<?php require_once '../conexion.php';

//$tags = explode(',', $_POST['tags']);
$sql = 'SELECT name FROM tags';
$res = $con->query($sql);
$arr = [];
$i   = 0;

if ($res->num_rows > 0) {
    // output data of each row
    while ($row = $res->fetch_assoc()) {
        $arr[$i] = strtolower($row['name']);
        $i++;
    }
}

// insert en la base
$stmt = $con->prepare('INSERT INTO tags (name) VALUES (?)');
//foreach ($tags as $key => $value) {
//    if($value !== ''){
//        $stmt->bind_param("is",$id, $value);
//        $stmt->execute();
//    }
//}

// Cerrar la conexión
//$stmt = null;
//$mysqli = null;

// Devolver una respuesta a JavaScript
//echo "Se grabó la etiqueta tags";

echo json_encode($arr);
$con->close();
