<?php
    include '../../model/database.php';
    include '../objects/object.php';
    $salon = new Salon();
    $id_staff = $_POST['id_staff'];
    $id_category = $_POST['id_category'];
    $where = "WHERE `id_staff` = '$id_staff' AND `id_category` = '$id_category'";
    $table = 'staff-cate';
    $check = $salon->get_all($table, $where);
    $count = mysqli_num_rows($check);
    if ($count != 0) {
        $salon->delete($table, $where);
        echo json_encode('Delete success');
        die();
    } else {
        $value1 = '`id_staff`, `id_category`';
        $value2 = "'$id_staff', '$id_category'";
        $salon->insert($table, $value1, $value2);
        echo json_encode('Insert success');
        die();
    }
?>