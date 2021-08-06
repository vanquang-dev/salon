<?php
    include '../../model/database.php';
    include '../objects/object.php';
    $salon = new Salon();
    $table = $_POST['table'];

    $value1 = '';
    $value2 = '';
    foreach ($_POST['leuleu'] as $row) {
        if ($_POST[$row] != '' || $row == 'note') {
            if ($value2 == '') {
                $value1 = "`" . $row ."`";
                $value2 = "'" . $_POST[$row] ."'";
            } else {
                $value1 = $value1 .", `" . $row ."`";
                $value2 = $value2 . ", '" . $_POST[$row] ."'";
            }
        } else {
            $message['error'] = '*Khong duoc de trong !';
            $message['id'] = $row;
            echo json_encode($message);
            die();
        }
    }
    $salon->insert($table, $value1, $value2);
    if ($table == 'staff') {
        $id_staff = mysqli_fetch_array($salon->get_max_id($table));
        $id_staff = $id_staff['MAX(id)'];
        foreach ($_POST['id_category'] as $value) {
            $value3 = "`id_staff`, `id_category`";
            $value4 = "'$id_staff', '.$value.'";
            $salon->insert('staff-cate', $value3, $value4);
        }
    } elseif ($table == 'order') {
        $id_order = mysqli_fetch_array($salon->get_max_id($table));
        $id_order = $id_order['MAX(id)'];
        foreach ($_POST['id_service'] as $value) {
            $value3 = "`id_order`, `id_service`";
            $value4 = "'$id_order', '.$value.'";
            $salon->insert('order-details', $value3, $value4);
        }
    }
    $message['success'] = 'Success';
    echo json_encode($message);
?>