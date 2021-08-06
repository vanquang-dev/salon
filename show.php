<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        include 'views/layouts/head.php';
        include 'controller/read/read.php';
        head('Bài viết');
    ?>
</head>

<body>
    <!-- Navbar-->
    <?php include 'views/layouts/navbar.php' ?>

    <div class="img-title"></div>

    <div class="container">
        <?php

            if ($_GET['name'] == 'voicher') {
                $string = 'voicher'; $title = 'Khuyến mãi'; $url = 'danh-sach-khuyen-mai'; $limit = 3;
            } elseif ($_GET['name'] == 'service') {
                $string = 'service'; $title = 'Dịch vụ'; $url = 'danh-sach-dich-vu'; $limit = 3;
            } elseif ($_GET['name'] == 'blog') {
                $string = 'blog'; $title = 'Bài viết'; $url = 'danh-sach-bai-viet'; $limit = 3;
            } elseif ($_GET['name'] == 'staff') {
                $string = 'staff';   
            } 
            
            read_one($string);
            if ($_GET['name'] != 'staff') {
                read($string, $title, $url, $limit);
            }
            
        ?>

        <!-- advise -->
        <?php include 'views/layouts/advise.php' ?>
    </div>

    <!-- footer -->
    <?php include 'views/layouts/footer.php' ?>
</body>

</html>