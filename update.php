<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        include 'views/layouts/head.php';
        include 'controller/read/read.php';
        head('Chỉnh sửa');
    ?>
    <link href="views/assets/css/library/bootstrap.min.css" rel="stylesheet">
    <link href="views/assets/css/library/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar-->
    <?php include 'views/layouts/navbar.php' ?>

    <div class="img-title"></div>
    <div class="container">
        <?php
            $id = $_GET['id'];
            if ($_GET['name'] == 'bai-viet') {
                $table =  'blog'; $title = 'Thêm bài viết'; $array = ['Tiêu đề'=>'name', 'Ảnh tiêu đề'=>'image'];
            } elseif ($_GET['name'] == 'nhan-vien') {
                $table =  'staff'; $title = 'Sửa nhân viên'; $array = ['Tên nhân viên'=>'name', 'Giới tính'=>'sex','Ngày sinh'=>'birthday', 'Ảnh đại diện'=>'image'];
            } elseif ($_GET['name'] == 'khuyen-mai') {
                $table =  'voicher'; $title = 'Sửa khuyến mãi'; $array = ['Tiêu đề'=>'name', 'Ảnh tiêu đề'=>'image', 'Ngày bát đầu'=>'start', 'Ngày kết thúc'=>'end'];
            } elseif ($_GET['name'] == 'dich-vux') {
                $table =  'service'; $title = 'Sửa dịch vụ'; $array = ['Tên dịch vụ'=>'name', 'Ảnh tiêu đề'=>'image', 'Giá cả'=>'price', 'Thuộc loại dịch vụ'=>'id_category'];
            }
            read_form($table, $title, $array);
        ?>
        <!-- advise -->
        <?php include 'views/layouts/advise.php' ?>
    </div>
    
    <div id="success" class="display" onclick="cancel()">
        <div class="box-success">
            <div class="success-img">
                <img src="views/assets/images/icon/success.png">
            </div>
            <div class="sucess-text">
                <p>Sửa thành công</p>
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
    <!-- footer -->
    <?php include 'views/layouts/footer.php' ?>
    
    <script src="views/assets/js/library/bootstrap.min.js"></script>
    <script src="views/assets/js/library/summernote.min.js"></script>
    <script src="views/assets/js/add.js"></script>
    <script>
        function get_data() {
            table = '<?php echo $table; ?>';
            id = <?php echo $id; ?>;
            var leuleu = ['description'
                <?php 
                    foreach($array as $value) {
                        echo ", '".$value."'";
                    }
                ?>
            ];
            get_class = $('.data');
            $.ajax({
                url: 'controller/update/read_data.php',
                type: 'POST',
                dataType: 'json',
                data: {table: table, id: id, leuleu: leuleu}
            })
            .done(function(data) {
                if (data.success) {
                    $('.box-pre-img').removeClass('display');
                    $('.box-pre-img').append('<img src="views/assets/images/' + data.image + '">');
                    $('#summernote').summernote('code', data.description);
                    for (i=0; i< get_class.length; i++) {
                        if (get_class[i].id == 'girl' || get_class[i].id == 'boy' || get_class[i].id == 'image') {
                            
                        } else {
                            $('#'+get_class[i].id).val(data[get_class[i].id]);
                        }
                    }
                    $('#end').val(data.end);
                } else {
                    
                }
            })
        }
        get_data();
        function add_work(id_category) {
            id_staff = <?php echo $id; ?>;
            $.ajax({
                url: 'controller/update/work.php',
                type: 'POST',
                dataType: 'json',
                data: {id_staff: id_staff, id_category: id_category}
            })
            .done(function(data) {
            })
        }
        name_image = '';
        function upFile(file, string) {
            if (file.type.includes('image')) {
                table = '<?php echo $table; ?>';
                string = string;
                name = file.name.split(".");
                name = name[0];

                data = new FormData();
                data.append('file', file);
                data.append('table', table);
                data.append('string', string);
                $.ajax({
                        url: 'controller/add/add_img.php',
                        type: 'POST',
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        data: data,
                        success: function(data) {
                            if (data.is_ok) {
                                if (data.is_ok == 'description') {
                                    $('#summernote').summernote('insertImage', data.url, name);
                                } else {
                                    name_image = data.url;
                                }
                            } else {
                                console.log(data.error);
                            }
                        }
                    })
                    .fail(function(e) {
                        console.log(e);
                    });
            } else {
                console.log("Đừng cố tải cái gì lên khác ngoài ảnh :>");
            }
        }
        $('#submit').click(function() {
            $('#wait').removeClass('display');
            $('body').attr('style','overflow: hidden;')
            get_class = $('.data');
            data = [];
            var leuleu = ['description'
                <?php 
                    foreach($array as $value) {
                        echo ", '".$value."'";
                    }
                ?>
            ];
            for (i=0; i< get_class.length; i++) {
                if (get_class[i].id == 'girl' || get_class[i].id == 'boy') {
                    data['sex'] = get_class[i].value;
                } else {
                    data[get_class[i].id] = get_class[i].value;
                }
            }
            data['description'] = $('#summernote').summernote('code');
            data['table'] = '<?php echo $table; ?>';
            data['id'] = '<?php echo $id; ?>';
            data['image'] = name_image;
            $.ajax({
                url: 'controller/update/update.php',
                type: 'POST',
                dataType: 'json',
                data: { leuleu: leuleu,
                    <?php
                        echo "table : data['table'], ";
                        foreach($array as $value) {
                            echo $value . " : data['".$value."'], ";
                        }
                        echo "description : data['description'],";
                        echo "id : data['id'],";
                        if ($table == 'staff') {
                            echo "id_category : arr,";
                        }
                    ?>}
            })
            .done(function(data) {
                if (data.success) {
                    $('#success').removeClass('display');
                    
                    $('#wait').addClass('display');
                } else {
                    for (i=0; i<$('.empty').length; i++) {
                        $('.empty').addClass('display');
                    }
                    $('.'+data.id).removeClass('display');
                    $('body').attr('style','')
                    $('#wait').addClass('display');
                }
            })
            .fail(function(error) {})
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