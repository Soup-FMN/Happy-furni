<?php
include "../layouts/header.php";
include "../layouts/slider.php";
include "../database.php";
include "../class/category_class.php";
?>
<?php
$category = new category;
if (!isset($_GET['category_id']) || $_GET['category_id']==NULL) {
    echo "<script>window.location = 'category_show.php'</script>";
}
else {
    $category_id = $_GET['category_id'];
}
    $get_category = $category -> get_category($category_id);
    if ($get_category) {
        $result = $get_category -> fetch_assoc();
    }
?>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // sau khi có biến category name -> dùng hàm insert_category để sử lí -> sau khi sử lí sẽ insert vào bảng dữ liệu
    $category_name = $_POST['category_name'];
    $update_category = $category ->update_category($category_name,$category_id);
}
?>
<div class="right-contents">
            <div class="right-contents-item right-contents-category_insert">
                <h1>Sửa danh mục</h1>
                <form action="" method="POST">
                    <!-- Nhập liệu vào input -->
                    <input required name="category_name" required
                    type="text" placeholder="Nhập tên danh mục" 
                    value="<?php echo $result['category_name'] ?>">
                    <!-- Sau khi nhấn cái nút submit thì sẽ có cái biến chứa dữ liệu là $category_name-->
                    <button class="btn" type="submit">Ghi lại</button>
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

        // const delete_btns = document.querySelectorAll('.btn.delete')
        // delete_btns.forEach(function(btn) {
        //     btn.addEventListener('click', function(e) {
        //         var result = confirm('Are you sure about that (⌐■_■)????????');
        //         if(!result) {
        //             e.preventDefault();
        //         }
        //     })
        // })
    </script>
    <!-- script end -->
</body>
</html>