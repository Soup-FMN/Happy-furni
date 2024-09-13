<?php
include "../layouts/header.php";
include "../layouts/slider.php";
include "../database.php";
include "../class/brand_class.php";
?>

<?php
$brand = new brand;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // sau khi có biến category name -> dùng hàm insert_category để sử lí -> sau khi sử lí sẽ insert vào bảng dữ liệu
    $category_id = $_POST['category_id'];
    $brand_name = $_POST['brand_name'];
    $insert_brand = $brand -> insert_brand($category_id,$brand_name);
}
?>
<style>
    select {
        height: 40px;
        width: 270px;
        margin-bottom: 10px;
        border: 3px solid #5e473e;
        font-size: 20px;
    }
</style>

<div class="right-contents">
            <div class="right-contents-item right-contents-category_insert">
                <h1>Thêm Loại Sản Phẩm</h1>
                <form action="" method="POST">
                <input required name="brand_name"
                type="text" placeholder="Nhập tên loại sản phẩm">
                    <!-- Nhập liệu vào -->
                    <select style="visibility: hidden;" name="category_id" id="">
                        <option value="#">--Chọn danh mục</option>
                        <?php
                        $show_category = $brand ->show_category();
                        if($show_category){while($result = $show_category -> fetch_assoc()){
                        ?>
                        <option value="<?php echo $result['category_id'] ?>"><?php echo $result['category_name'] ?></option>
                        <?php
                         }}
                        ?>
                    </select>
                    
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