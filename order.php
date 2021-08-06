<!DOCTYPE html>
<html lang="en">

<head>
    <link href="views/assets/css/library/bootstrap.min.css" rel="stylesheet">
    <?php 
        include 'views/layouts/head.php';
        include 'controller/read/read.php';
        head('Đặt lịch hẹn');
    ?>
</head>
<body>
    
    <!-- Navbar-->
    <?php include 'views/layouts/navbar.php' ?>
    <div class="img-title"></div>
    <div class="container">
        <?php
            $table =  'order'; $title = 'Thêm lịch hẹn'; $array = ['Họ và tên'=>'name', 'Số điện thoại'=>'number_phone', 'Ngày hẹn'=>'date', 'Giờ hẹn'=>'time', 'Chọn cơ sở'=>'id_address', 'Ghi chú'=>'note'];
            read_form($table, $title, $array);
        ?>
        
        <!-- advise -->
        <?php include 'views/layouts/advise.php' ?>
    </div>
    <!-- footer -->
    <?php include 'views/layouts/footer.php' ?>
    <div class="box-service display">
        <div style="position:relative; width: 1000px; margin: 0 auto;">
            <div id="box"></div>
            <div id="cancel">X</div>
        </div>
    </div>
    <div id="success" class="display">
        <div class="box-success">
            <div class="success-img">
                <img src="views/assets/images/icon/success.png">
            </div>
            <div class="sucess-text">
                <p>Nhân viên của chúng tôi sẽ liên hệ với bạn sau ít phút nữa</p>
            </div>
            <div class="success-btn">
                <a class="btn" href="trang-chu">Trang chủ</a>
            </div>
        </div>
    </div>
    <div id="wait" class="display">
        <div class="loading">
            <h3 id="h3">Loading...</h3>
            <div class="border">
                <div id="load"></div>
            </div>
        </div>
    </div>
    <script src="views/assets/js/library/jquery.min.js"></script>
    <script>
        
        function show_box() {
            $('.box-service').removeClass('display');
            $('#box').html('<?php read_service(); ?>');
        }
        $('#cancel').click(function() {
            $('.box-service').addClass('display');
            $('#box').html('');
        })
        function chosse_service(id) {
            $.ajax({
                url: 'controller/read/read_service.php',
                type: 'POST',
                dataType: 'json',
                data: {id: id}
            })
            .done(function(data) {
                if (data.success) {
                    price = Number($('#price').val());
                    if (print == null) {print = 0;}
                    price = price + Number(data.price);

                    $('#ok').append(data.html);
                    $('#price').html(price);
                    $('.box-service').addClass('display');
                    $('#box').html('');
                    $('#check').val('true');
                } else {
                    
                }
            })
            .fail(function(error) {})
        }
        function delete_box(id) {
            $("#"+id).remove();
            id_service = $('.id_service');
            if (id_service.length == 0) {
                $('#check').val('');
            }
        }
        function chosse_service(id) {
            $.ajax({
                url: 'controller/read/read_service.php',
                type: 'POST',
                dataType: 'json',
                data: {id: id}
            })
            .done(function(data) {
                if (data.success) {
                    price = Number($('#price').val());
                    if (print == null) {print = 0;}
                    price = price + Number(data.price);

                    $('#ok').append(data.html);
                    $('#price').html(price);
                    $('.box-service').addClass('display');
                    $('#box').html('');
                    $('#check').val('true');
                } else {
                    
                }
            })
            .fail(function(error) {})
        }
        function delete_box(id) {
            $("#"+id).remove();
            id_service = $('.id_service');
            if (id_service.length == 0) {
                $('#check').val('');
            }
        }
        $('#submit').click(function() {
            if ($('#check').val()) {
                $('#wait').removeClass('display');
                $('body').attr('style','overflow: hidden;')
                id_service = $('.id_service');
                arr = [];
                for (i=0; i<id_service.length;i++) {
                    arr[i] = String(id_service[i].id);
                }
                var leuleu = [
                    <?php 
                        foreach($array as $value) {
                            echo "'".$value."',";
                        }
                    ?>
                ];
                data = {
                    table : 'order',
                    id_address: $('#id_address').val(),
                    name: $('#name').val(),
                    number_phone: $('#number_phone').val(),
                    date: $('#date').val(),
                    time: $('#time').val(),
                    note: $('#note').val(),
                    id_service: arr,
                    leuleu: leuleu
                };
                $.ajax({
                    url: 'controller/add/add.php',
                    type: 'POST',
                    dataType: 'json',
                    data: data
                })
                .done(function(data) {
                    if (data.success) {
                        $('#wait').addClass('display');
                        $('#success').removeClass('display');
                    } else {
                        for (i=0; i<$('.empty').length; i++) {
                            $('#wait').addClass('display');
                            $('.empty').addClass('display');
                        }
                        $('.'+data.id).removeClass('display');
                        $('body').attr('style','')
                    }
                })
                .fail(function(error) {})
            } else {
                console.log('hihi')
            }
                
        })
    </script>
    <script>
        var text = document.querySelector('h3#h3');
        var div = document.querySelector('div#load');
        var trangthai = "motcham";
        var x = 0;
        var w = 0;
        var loading = setInterval(cham,200);
        var divplus = setInterval(daira,40);
        function cham(){
            if(trangthai == 'motcham'){
            text.innerHTML = 'Loading' + '.';
            trangthai = 'haicham';
            }
            else if(trangthai == 'haicham'){
            text.innerHTML = 'Loading' + '..';
            trangthai = 'bacham';
            }
            else if(trangthai == 'bacham'){
            text.innerHTML = 'Loading' + '...';
            trangthai = 'motcham';
            }
            if(x == 100 && trangthai == 'motcham'){
                clearInterval(loading);
            }
        }
        function daira(){
            w += 1;
            div.style.width = w +'px';
            if(w == 100){
                clearInterval(divplus);
            }
        }
    </script>
</body>

</html>