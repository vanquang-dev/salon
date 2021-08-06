<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        include 'views/layouts/head.php';
        include 'controller/read/read.php';
        head('Danh sách');
    ?>
</head>

<body>
    <!-- Navbar-->
    <?php include 'views/layouts/navbar.php' ?>

    <div class="img-title"></div>
    <?php
        if (isset($_GET['name'])) {
            if ($_GET['name'] == 'dich-vu') {
                read_category();
            }
        }
    ?>
    <div class="container">
        <?php
            if (isset($_GET['name'])) {
                $name = $_GET['name'];
                if ($name == 'khuyen-mai') {
                    pagination('voicher', 'Danh sách khuyến mãi','khuyen-mai');
                } elseif ($name == 'nhan-vien') {
                    pagination('staff', 'Danh sách nhân viên', 'nhan-vien');
                } elseif ($name == 'bai-viet') {
                    pagination('blog', 'Danh sách bài viết', 'bai-viet');
                } elseif ($name == 'dich-vu') {
                    read_service('');
                } elseif ($name == 'lich-hen') {
                    read_order();
                }
            }
        ?>

        <!-- advise -->
        <?php include 'views/layouts/advise.php' ?>
    </div>

    <!-- footer -->
    <?php include 'views/layouts/footer.php' ?>
    <script>
        
        var x = 1;
        function nextSlide(id, i) {
            var i = i - 4;
            action = x*(-280);
            hihi = action+'px';
            $('#'+id).attr('style', 'width: max-content; transform: translate3d('+hihi+', 0, 0);');
            if (x == i) {
                x = 0;
            } else {
                x++; 
            }
            
            console.log(x);
        }

        function prevSlide(id, i) {
            var i = i - 4;
            x--;
            if (x != 0) {
                x--;
            }
            action = x*(-280);
            hihi = action+'px';
            $('#'+id).attr('style', 'width: max-content; transform: translate3d('+hihi+', 0, 0);');
            x++;
            if (x == 0) {
                x = 1;
            }
            console.log(x);
        }
    </script>
</body>

</html>