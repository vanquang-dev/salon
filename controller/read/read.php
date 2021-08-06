<?php

    function read($table, $str, $url, $limit) {
        $salon = new Salon();

        $query = $salon->get_limit($table, '', 0, $limit);
        if ($table == 'service') {
            $query = $salon->get_limit($table, "WHERE `id_category` = '1'", 0, $limit);
        }

        echo '
            <div class="service">
            <div class="title">
                <h3>'.$str.'</h3>
            </div>';
        if ($table != 'address') {
            echo '
            <div class="view-all">
                <a href="'.$url.'"> Xem tất cả -></a>
            </div>
            <div class="clear"></div>
            ';
        }
        echo '
            <div class="content">
        ';
        while ($row = mysqli_fetch_array($query)) {
            if ($table == 'address') {
                echo '
                <div class="box-three circle">
                    <div class="img"></div>
                    <div class="text">
                        <h3>'.$row['address'].'</h3>
                        <h4>Hotline: '.$row['hotline'].' </h4>
                    </div>
                </div>
                ';
            } elseif ($limit == 3) {
                echo '
                    <div class="box-three normal">
                    <a href="'.utf8tourl($row['name']).'-'.$table.'-'.$row["id"].'.html">
                    <div class="img" style="background:url(views/assets/images/'.$row["image"].') center center / cover ;"></div>
                        <div class="text">
                            <h3>'.$row['name'].'</h3>
                        </div>
                    </div>
                    </a>
                ';
            } else {
                echo '
                    <div class="box">
                        <a href="'.utf8tourl($row['name']).'-'.$table.'-'.$row["id"].'.html">
                        <div class="img" style="background:url(views/assets/images/'.$row["image"].') center center / cover ;"></div>
                        </a>
                        <div class="text">
                            <h4>'.$row['name'].'</h4>
                        </div>
                    </div>
                ';
            }
            
        }
        echo '
            </div>
        </div>
        ';
    }

    function read_slide($table) {
        $salon = new Salon;
        $query = $salon->get_limit($table, "WHERE `id_category` = '1'", 0, 3);
        echo '<div class="slide" id="mySlider">';
        $style = 'style="left: 0px;"';
        $i=0;
        while ($row = mysqli_fetch_array($query)) {
            echo '
            <div id="slide'.$i.'" class="singleSlide" '.$style.'>
                <div class="slide-content">
                    <h2>'.$row['name'].'</h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Numquam, hic quasi cum error nam aliquid ullam saepe minus odit eos repellat, veritatis temporibus consequuntur corporis. Molestias rem consectetur corporis. Deserunt.</p>
                    <button class="btn">Đặt lịch ngay</button>
                </div>
                <div class="slide-img">
                </div>
            </div>
            ';
            $style = '';
            $i++;
        }
        echo '
            </div>
            <div id="sliderNav">
                <div id="sliderPrev" onclick="prevSlide();"><img src="views/assets/images/icon/left-arrow.png"></div>
                <div id="sliderNext" onclick="nextSlide();"><img src="views/assets/images/icon/right-arrow.png"></div>
            </div>
        ';
    }

    function pagination($table, $title, $url) {
        $salon = new Salon();
        
        $total_records = $salon->pagination($table);

        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 8;
        $total_page = ceil($total_records / $limit);

        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;

        $result = $salon->get_limit($table, 'ORDER BY `id` DESC', $start, $limit);
        echo '
        <div class="service">
            <div class="title">
                <h3>'.$title.'</h3>
            </div>
            <div class="content">';
        while ($row = mysqli_fetch_array($result)) {
            echo '
                <div class="box">
                    <a href="'.utf8tourl($row["name"]).'-'.$table.'-'.$row["id"].'.html">
                        <div class="img" style="background:url(views/assets/images/'.$row["image"].') center center / cover ;"></div>
                    </a>
                    <div class="text">
                        <h4>'.$row["name"].'</h4>
                    </div>
                    <div class="tuychon">
                        <a href="sua-'.$url.'-'.$row["id"].'" class="hihi"> Sửa </a>
                        <a href="#" class="hihi"> Xóa </a>
                    </div>
                </div>
            ';
        }
        echo '<div class="pagination">';
        if ($current_page > 1 && $total_page > 1){
            echo '<a href="danh-sach-'.$url.'-page='.($current_page-1).'" class ="pgn-btn">Prev</a> ';
        }

        for ($i = 1; $i <= $total_page; $i++){
            if ($i == $current_page){
                echo '<span class ="pgn-btn action">'.$i.'</span> ';
            }
            else{
                echo '<a href="danh-sach-'.$url.'-page='.$i.'" class ="pgn-btn">'.$i.'</a> ';
            }
        }

        if ($current_page < $total_page && $total_page > 1){
            echo '<a href="danh-sach-'.$url.'-page='.($current_page+1).'" class ="pgn-btn">Next</a>';
        }
        echo '</div></div></div>';
    }

    function read_service() {
        $salon = new Salon();
        
        $get_category = $salon->get_all('category', '');
        echo '<div class="service">';
        while ($row = mysqli_fetch_array($get_category)) {
            $id = "'mySlider".$row['id']."'";
            echo '<div class="title"><h3>'.$row["name"].'</h3></div>';
            if (isset($_GET['name'])) {
                echo '<div style="position: relative;"><div class="content mySlider" id="mySlider'.$row['id'].'" style="width: max-content;">';
            } else {
                echo '<div class="content">';
            } 
            $where = "WHERE `id_category`='".$row["id"]."' ORDER BY `id` DESC";
            $get_service = $salon->get_all('service', $where);
            $i = 0;
            while ($row2 = mysqli_fetch_array($get_service)) {
                if (isset($_GET['name'])) {
                    echo '
                    <div class="box-slide">
                        <a href="'.utf8tourl($row2["name"]).'-service-'.$row2["id"].'.html">
                        <div class="img" style="background:url(views/assets/images/'.$row2["image"].') center center / cover ;"></div>
                        </a>
                        <div class="text">
                            <h4>'.$row2["name"].'</h4>
                        </div>
                        <div class="tuychon">
                            <a href="sua-dich-vu-'.$row2["id"].'" class="hihi"> Sửa </a>
                            <a href="#" class="hihi"> Xóa </a>
                        </div>
                    </div>
                    ';
                } else {
                    echo '<div class="box"><div class="img" style="background:url(views/assets/images/'.$row2["image"].') center center / cover ;"></div><div class="text"><h4>'.$row2["name"].'</h4></div><div class="tuychon"><button onclick="chosse_service('.$row2['id'].')" class="hihi"> Chọn </button></div></div>';
                }
                $i++;
            }
            echo '</div>';
            if (isset($_GET['name'])) {
                if ($i > 4) {
                    echo '</div><div class="sliderNav"><div class="prevslide" onclick="prevSlide('.$id.', '.$i.');"><img src="views/assets/images/icon/left-arrow.png"></div><div class="nextslide" onclick="nextSlide('.$id.', '.$i.');"><img src="views/assets/images/icon/right-arrow.png"></div></div>';
                }
            }
        }
        echo '</div>';
    }

    function read_category() {
        $salon = new Salon();
        $get_category = $salon->get_all('category', '');
        echo '<div class="list-category"><ul>';
        while ($row = mysqli_fetch_array($get_category)) {
            echo '
                <li><a href="#">'.$row["name"].'</a></li>
            ';
        }
        echo '</ul></div>';
    }

    function read_one($string) {
        $salon = new Salon();
        if (isset($_GET['id']) && isset($_GET['name'])){
            $id = $_GET['id'];
            $row = $salon->get_one($string, $id);
            echo '
            <div class="tag">
                <div class="title">
                    <h2>'.$row['name'].'</h2>
                </div>
                <div class="content">'.$row["description"].'</div>
            </div>
            ';
        } else {
            
        }
    }

    function read_work() {
        $salon = new Salon();
        $id_staff = $_GET['id'];
        $get_category = $salon->get_all('category', '');
        $where = "WHERE `id_staff` = '$id_staff'";
        
        echo '<div class="form-group"><label>Công việc:</label><br>';
        while ($row = mysqli_fetch_array($get_category)) {
            $check = $salon->get_all('staff-cate', $where);
            $x = true;
            while ($row2 = mysqli_fetch_array($check)) {
                if ($row['id'] == $row2['id_category']) {
                    echo '
                        <input type="checkbox" checked onclick="add_work('.$row["id"].')" class="work" id="checkbox'.$row["id"].'" value="'.$row["id"].'"> <label for="checkbox'.$row["id"].'" style="margin-right: 20px;">'.$row["name"].' </label>
                    ';
                    $x = false;
                }
            }
            if ($x) {
                echo '
                    <input type="checkbox" onclick="add_work('.$row["id"].')" class="work" id="checkbox'.$row["id"].'" value="'.$row["id"].'"> <label for="checkbox'.$row["id"].'" style="margin-right: 20px;">'.$row["name"].' </label>
                ';
            }
        }
        echo '</div>';
    }

    function read_form($table, $title, $array) {
        $salon = new Salon();
        echo '<div class="tag"> <div class="title"> <h3>'.$title.'</h3> </div> <div class="content">';
        $count = 0;
        $arr = [];
        if ($table == 'order') {
            echo '<div class="form-group"> <label>Dịch vụ:</label> <label class="form-control chosse" onclick="show_box()">Chọn</label> <div id="ok"><input type="hidden" id="check" value=""></div></div>';
        }
        foreach ($array as $key=>$value) {
            if ($value == 'image') {
                echo '<div class="form-group">
                <label for="'.$value.'">'.$key.':</label>
                <label class="form-control" for="'.$value.'" style="width: 91px;">Chọn ảnh</label>
                <input type="file" class="display data" id="'.$value.'">
                <div class="box-pre-img display"></div>
                </div>';
            } elseif ($value == 'date' || $value == 'birthday' || $value == 'start' || $value == 'end') {
                echo '<div class="form-group"> <label for="'.$value.'">'.$key.':</label><input class="form-control data" type="date" id="'.$value.'"> <lable class="'.$value.' empty display">*</lable></div>';
            } elseif ($value == 'time') {
                echo '<div class="form-group"> <label for="'.$value.'">'.$key.':</label><input class="form-control data" type="time" id="'.$value.'"> <lable class="'.$value.' empty display">*</lable></div>';
            } elseif ($value == 'id_category') {
                $query = $salon->get_all('category', '');
                echo '<div class="form-group"> <label for="'.$value.'">'.$key.':</label> <select class="form-control data" id="'.$value.'">';
                while ($cate = mysqli_fetch_array($query)) {
                    echo '<option value="'.$cate['id'].'">'.$cate['name'].'</option>';
                }
                echo '</select><lable class="'.$value.' empty display">*</lable></div>';
            } elseif ($value == 'id_address') {
                $get_adderss = $salon->get_all('address', '');
                echo '<div class="form-group"> <label for="'.$value.'">'.$key.':</label> <select class="form-control data" id="'.$value.'">';
                while($data_address = mysqli_fetch_array($get_adderss)) {
                    echo '<option value="'.$data_address['id'].'">'.$data_address['address'].' -- '.$data_address['hotline'].'</option>';
                }
                echo '</select></div>';
            } elseif ($value == 'sex') {
                echo '
                    <div class="form-group">
                        <label style="margin-right: 20px;">'.$key.':</label>
                        <input type="radio" class="gioitinh data" id="girl" name="sex" value="1" checked> <label for="girl" style="margin-right: 20px;"> Nữ </label>
                        <input type="radio" class="gioitinh" id="boy" name="sex" value="0"> <label for="boy"> Nam </label>
                    </div>
                ';
            } else {
                echo '<div class="form-group"> <label for="'.$value.'">'.$key.':</label><input class="form-control data" type="text" id="'.$value.'"> <lable class="'.$value.' empty display">*</lable></div>';
            }
        }
        if ($table == 'staff' && isset($_GET['id'])) {
            read_work();
        } elseif ($table == 'staff' && !isset($_GET['id'])) {
            $get_category = $salon->get_all('category', '');
            echo '<div class="form-group"><label>Công việc:</label><br>';
            while ($row = mysqli_fetch_array($get_category)) {
                $onclick = "'".$row['id']."'";
                echo '
                    <input type="checkbox" onclick="chosse('.$onclick.')" class="work" id="'.$row["id"].'"> <label for="'.$row["id"].'" style="margin-right: 20px;">'.$row["name"].' </label>
                ';
            }
            echo '</div>';
        }
        if ($table != 'order') {
            echo '<div class="form-group"><label for="summernote">Nội dung:</label><div id="summernote"></div></div>';
        }
        echo '<div class="form-group" style="text-align: center;"> <button class="btn" id="submit">Thêm</button></div> </div></div>';
    }

    function read_order() {
        $salon = new Salon();
        $code = "SELECT *, `order`.`id` AS `id_order` FROM `order` JOIN `address` ON `order`.`id_address` = `address`.`id`";
        $query = $salon->code($code);
        echo '<div class=""><div class="title"><h3>Danh sách lịch hẹn</h3></div><div class="content"><table class="table table-bordered"><thead class="thead-dark"><tr><th>Tên người đặt</th><th>Số điện thoại</th><th>Dịch vụ</th><th>Tổng thành tiền</th><th>Cơ sở Salon</th><th>Ngày hẹn</th><th>Ghi chú</th><th>Tùy chọn</th></tr></thead><tbody>';
        $price = 0;
        while ($data = mysqli_fetch_array($query)) {
            echo '
            <tr class="">
                <td class="td-name"><div class="name">'.$data['name'].'</div></td>
                <td class="td-phone"><div class="number_phone">'.$data['number_phone'].'</div></td>
                <td class="td-service"><div class="service-table">
            ';
            $code = "SELECT * FROM `order-details` JOIN `service` ON `order-details`.`id_service` = `service`.`id` WHERE `id_order` = ".$data['id_order'];
            $get_service = $salon->code($code);
            while ($data_service = mysqli_fetch_array($get_service)) {
                echo '<div class="id_service"><div class="img" style="background:url(views/assets/images/'.$data_service["image"].') center center / cover ;"></div><div class="text"><h4>'.$data_service["name"].'</h4></div></div>';
                $price = $price + (int)$data_service['price'];
            }
            echo '
                </div></td>
                <td class="td-price"><div class="price">'.$price.'</div></td>
                <td class="td-address"><div class="address">'.$data['address'].' -- '.$data['hotline'].'</div></td>
                <td class="td-datetime"><div class="datetime">'.$data['date'].' '.$data['time'].'</div></td>
                <td class="td-note"><div class="note">'.$data['note'].'</div></td>
                <td class="td-action"><button class="btn btn-info" style="margin-bottom: 10px;">Sửa</button><button class="btn btn-danger">Xóa</button></td>
            </tr>
            ';
        }
        echo '</tbody></table></div></div>';
    }

?>