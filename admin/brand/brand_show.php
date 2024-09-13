<?php
include "../layouts/header.php";
include "../layouts/slider.php";
include "../database.php";
include "../class/brand_class.php";
?>

<?php
$brand = new brand;
$show_brand = $brand->show_brand();
?>

    <div class="right-contents">
        <div class="right-contents-item right-contents-category_show">
                <h1>Danh sách loại sản phẩm</h1>
                    <table>
                        <tr>
                            <th>STT</th>
                            <th>ID</th>
                            <th>Tên loại sản phẩm</th>
                            <th>Tùy Biến</th>
                        </tr>
                        <?php
                        if ($show_brand){$i=0;
                            while($result = $show_brand->fetch_assoc()){$i++;
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $result['brand_id'] ?></td>
                            <td><?php echo $result['brand_name'] ?></td>
                            <td><a href="brand_update.php?brand_id=<?php echo $result['brand_id'] ?>">Cập nhật</a> | <a href="brand_delete.php?brand_id=<?php echo $result['brand_id'] ?>">Xóa</a></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
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