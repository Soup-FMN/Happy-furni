<?php
include "../layouts/header.php";
include "../layouts/slider.php";
include "../database.php";
include "../class/category_class.php";
?>

<?php
$category = new category;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // var_dump($_FILES);
    // sau khi có biến category name -> dùng hàm insert_category để sử lí -> sau khi sử lí sẽ insert vào bảng dữ liệu
    $insert_category = $category -> insert_category($_POST, $_FILES);
}
?>

<div class="right-contents">
            <div class="right-contents-item right-contents-category_insert">
                <h1>Thêm danh mục</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- Nhập liệu vào input -->
                    <input required name="category_name"
                    type="text" placeholder="Nhập tên danh mục">
                    <br>
                    <br>
                    <label for="">Ảnh danh mục <span style="color: red;">*</span></label>
                    <br>
                    <input name="category_img" required type="file">
                    <!-- Sau khi nhấn cái nút submit thì sẽ có cái biến chứa dữ liệu là $category_name-->
                    <button class="btn" type="submit">Thêm</button>
                </form>
            </div>
        </div>

    </section>

    <!-- contents end-->


    <!-- script start -->
    <script>
        const options = document.querySelectorAll('.left-contents > ul > li > .item-btn-option');
        options.forEach(function(option) {
            option.addEventListener('click', function(e) {
                var option_active = document.querySelector('.left-contents > ul > li > .item-btn-option.active');
                if(option_active && option_active != e.target) {
                    option_active.classList.remove('active');
                }
                option.classList.toggle('active');
            })
        }) 

    </script>
</body>
</html>