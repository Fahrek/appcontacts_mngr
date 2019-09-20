<?php

/* Connect To Database*/
require_once '../conexion.php';

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] !== NULL) ? $_REQUEST['action'] : '';

if ($action === 'ajax') {
    $tables = 'users';
    $campos = '*';
//    $query = mysqli_real_escape_string($con, strip_tags($_REQUEST['query'], ENT_QUOTES));
//    $sWhere = " tblprod.prod_name LIKE '%" . $query . "%'";
//    $sWhere .= ' order by tblprod.prod_name';

    include 'pagination.php'; //include pagination file

    //pagination variables
    $page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page  = (int)$_REQUEST['per_page']; //how much records you want to show
    $adjacents = 4; //gap between pages after number of adjacents
    $offset    = ($page - 1) * $per_page;

    //Count the total number of row in your table
    $count_query = mysqli_query($con, "SELECT count(*) AS numrows FROM $tables");

    if ($row = mysqli_fetch_array($count_query)) {
        $numrows = $row['numrows'];
    } else {
        echo mysqli_error($con);
    }

    $total_pages = ceil($numrows / $per_page);
    //main query to fetch the data
    $query = mysqli_query($con, "SELECT $campos FROM  $tables LIMIT $offset,$per_page");
    //loop through fetched data

    if ($numrows > 0) {
            ?>

            <div class="table-responsive">
                    <table class="table table-striped table-hover">
                            <thead>
                                    <tr>
                                            <th class = 'text-center'>ID</th>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Email</th>
                                            <th>Categoría</th>
                                            <th></th>
                                    </tr>
                            </thead>
                            <tbody>
                            <?php
                            $finales    = 0;
                            $text_class = 0;
                            $i          = 1;

                            while ($row = mysqli_fetch_array($query)) {
                                $contact_id    = $row['id'];
                                $contact_name  = $row['name'];
                                $contact_lname = $row['lname'];
                                $contact_email = $row['email'];
                                $contact_cat   = $row['cat'];
                                $finales++;
                                ?>
                                    <tr class="<?php echo $text_class ?>">
                                            <td><?php echo $i++           ?></td>
                                            <td><?php echo $contact_name  ?></td>
                                            <td><?php echo $contact_lname ?></td>
                                            <td><?php echo $contact_email ?></td>
                                            <td><?php echo $contact_cat   ?></td>
                                            <td id="buttons">

                                                    <button class = "edit clear"
                                                            href = "#"
                                                               data-target   = "#editProductModal"
                                                               data-toggle   = "modal"
                                                               data-name     = "<?php echo $contact_name  ?>"
                                                               data-lname    = "<?php echo $contact_lname ?>"
                                                               data-email    = "<?php echo $contact_email ?>"
                                                               data-cat      = "<?php echo $contact_cat   ?>"
                                                               data-id       = "<?php echo $contact_id    ?>">
                                                            <i style="font-size: 1.3rem; margin:0px 5px 0px 0px;"
                                                               class = "fas fa-pen"
                                                               data-toggle = "tooltip"
                                                               title = "Editar"></i>
                                                            EDITAR</button>

                                                    <button class = "delete clear"
                                                            href = "#"
                                                               data-target = "#deleteProductModal"
                                                               data-toggle = "modal"
                                                               data-id     = "<?php echo $contact_id; ?>">
                                                                    <i style="font-size: 1.3rem; margin:0px 5px 0px 0px;"
                                                                       class = "fas fa-trash"
                                                                       data-toggle = "tooltip"
                                                                       title = "Eliminar"></i>

                                                            BORRAR</button>
                                            </td>
                                    </tr>
                            <?php } ?>
                            <tr>
                                    <td colspan='6'>
                                        <?php
                                        $inicios =  $offset  + 1;
                                        $finales += $inicios - 1;
                                        echo "Mostrando del $inicios al $finales de $numrows registros";
                                        echo paginate($page, $total_pages, $adjacents);
                                        ?>
                                    </td>
                            </tr>
                            </tbody>
                    </table>
            </div>
        <?php
    }
}
?>


