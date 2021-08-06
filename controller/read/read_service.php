<?php
    include '../../model/database.php';
    include '../objects/object.php';
    $salon = new Salon();
    $id = $_POST['id'];
    $data = [];
    $data_service = $salon->get_one('service', $id);
    $data['html'] = '<div class="id_service" id="'.$data_service['id'].'"><div class="delete" onclick="delete_box('.$data_service['id'].')">X</div><div class="img" style="background:url(views/assets/images/'.$data_service["image"].') center center / cover ;"></div><div class="text"><h4>'.$data_service["name"].'</h4></div></div>';
    $data['price'] = $data_service['price'];
    $data['success'] = 'success';
    echo json_encode($data);
?>