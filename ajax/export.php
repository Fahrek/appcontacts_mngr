<?php require_once '../conexion.php';

if (isset($_POST['export']))
{
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    $output = fopen('php://output', 'wb');
    fputcsv($output, array('ID', 'Nombre', 'Apellidos', 'Email', 'Categoria'));
    $query = 'SELECT * from users ORDER BY id DESC';
    $res = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($res)) {
        fputcsv($output, $row);
    }
    fclose($output);
}
