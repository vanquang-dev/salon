<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        include 'views/layouts/head.php';
        include 'controller/read/read.php';
        head('Trang chủ');
    ?>
</head>

<body>
    <!-- Navbar-->
    <?php include 'views/layouts/navbar.php' ?>

    <!-- Slide -->
    <?php read_slide('service'); ?>

    <!-- Container -->
    <div class="container">

        <!-- introduce -->
        <div class="introduce">
            <div class="title">
                <h3>Thone Hair Care</h3>
            </div>
            <div class="content">
                <h4>Chào mừng bạn đến với THON Hair Care nơi mỗi khách hàng đều khao khắt muốn đến và cảm nhận</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rerum neque nulla vero, corrupti quia adipisci voluptatibus quidem illo ad eius, pariatur tempore quos non ipsa, at amet vel impedit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, unde pariatur rem minus voluptas placeat, nobis praesentium corrupti nihil officia illo ipsa expedita, consequuntur aperiam saepe doloremque modi alias? Libero!</p>
            </div>
        </div>

        <!-- service -->
        <?php read('service', 'Dịch vụ', 'danh-sach-dich-vu', 4); ?>

        <!-- voicher -->
        <?php read('voicher', 'Khuyến mãi', 'danh-sach-khuyen-mai', 4); ?>

        <!-- feedback -->
        <div class="feedback">
            <div class="feedback-content">
                <h2>Khách hàng nói gì về chúng tôi</h2>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Numquam, hic quasi cum error nam aliquid ullam saepe minus odit eos repellat, veritatis temporibus consequuntur corporis. Molestias rem consectetur corporis. Deserunt.</p>
                <h3>HOT TEEN: HOÀNG DUNG</h3>
            </div>
        </div>

        <!-- address -->
        <?php read('address', 'Hệ thống Salon của Thon', '', 3); ?>

        <!-- blog -->
        <?php read('blog', 'Bài viết', 'danh-sach-bai-viet', 3); ?>

        <!-- advise -->
        <?php include 'views/layouts/advise.php' ?>
    </div>

    <!-- Footer -->
    <?php include 'views/layouts/footer.php' ?>

    <script src="views/assets/js/slide.js"></script>
</body>

</html>