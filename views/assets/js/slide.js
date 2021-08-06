// Mỗi slide sẽ có một chỉ số của riêng nó, để đơn giản chúng ta sẽ gán chỉ số mảng cho các slide
var slideIndex = 0;
// Cho ta biết chúng ta đang ở slide nào
var currentSlideIndex = 0;

// Xử lý bấm nút chuyển slide trước đó
function prevSlide() {
    // Tìm slide trước đó
    var nextSlideIndex;
    // Nếu chỉ số slide là 0, về slide cuối
    if (currentSlideIndex === 0) {
        nextSlideIndex = 3 - 1;
    } else {
        // Nếu không thì giảm chỉ số đi 1
        nextSlideIndex = currentSlideIndex - 1;
    }

    // Ẩn slide hiện tại, hiện slide "currentSlideIndex"
    document.getElementById("slide" + nextSlideIndex).style.left = "-100%";
    document.getElementById("slide" + currentSlideIndex).style.left = 0;

    // Thêm class để chuyển slide có animation đã định nghĩa ở bước 3
    document.getElementById("slide" + nextSlideIndex).setAttribute("class", "singleSlide slideInLeft");
    document.getElementById("slide" + currentSlideIndex).setAttribute("class", "singleSlide slideOutRight");

    // Cập nhật giá trị slide hiện tại
    currentSlideIndex = nextSlideIndex;
}

// Xử lý bấm nút chuyển slide tiếp theo
// Cách xử lý tương tự như prevSlide đã trình bày ở trên
function nextSlide() {
    var nextSlideIndex;
    if (currentSlideIndex === 3 - 1) {
        nextSlideIndex = 0;
    } else {
        nextSlideIndex = currentSlideIndex + 1;
    }

    document.getElementById("slide" + nextSlideIndex).style.left = "100%";
    document.getElementById("slide" + currentSlideIndex).style.left = 0;

    document.getElementById("slide" + nextSlideIndex).setAttribute("class", "singleSlide slideInRight");
    document.getElementById("slide" + currentSlideIndex).setAttribute("class", "singleSlide slideOutLeft");

    currentSlideIndex = nextSlideIndex;
}