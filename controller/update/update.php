<?php
    include '../../model/database.php';
    include '../objects/object.php';
    $salon = new Salon();
    $table = $_POST['table'];
    $id = $_POST['id'];
    $set = '';
    $where = "`id` = '$id'";
    foreach ($_POST['leuleu'] as $row) {
        if ($_POST[$row] != '' || $row == 'note' || $row == 'image') {
            if ($row == 'image') {
                if ($_POST[$row] != '') {
                    if ($set == '') {
                        $set = "`$row` = '$_POST[$row]'";
                    } else {
                        $set = $set .", `$row` = '$_POST[$row]'";
                    }
                } else {
                    continue;
                }
            } elseif ($_POST[$row] != '') {
                if ($set == '') {
                    $set = "`$row` = '$_POST[$row]'";
                } else {
                    $set = $set .", `$row` = '$_POST[$row]'";
                }
            }
        } else {
            $message['error'] = '*Khong duoc de trong !';
            $message['id'] = $row;
            echo json_encode($message);
            die();
        }
    }
    $salon->update($table, $set, $where);
    $message['success'] = 'Success';
    echo json_encode($message);
?>