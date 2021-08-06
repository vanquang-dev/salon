<?php
    include '../../model/database.php';
    include '../objects/object.php';
    $salon = new Salon();
    $table = $_POST['table'];
    $id = $_POST['id'];

    $query = $salon->get_one($table, $id);
    $data = [];

    foreach ($_POST['leuleu'] as $value) {
        $data[$value] = $query[$value];
    }
    $data['success'] = true;
    echo json_encode($data);
?>