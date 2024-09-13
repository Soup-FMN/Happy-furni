<?php
include "../layouts/header.php";
include "../layouts/slider.php";
include "../database.php";
include "../class/category_class.php";
?>

<?php
$category = new category;
$show_category = $category ->show_category();
?>

    <div class="right-contents">
        <div class="right-contents-item right-contents-category_show">
                <h1>Danh sách danh mục</h1>
                    <table>
                        <tr>
                            <th>STT</th>
                            <th>ID</th>
                            <th>Tên Danh Mục</th>
                            <th>Tùy Biến</th>
                        </tr>
                        <?php
                        if ($show_category){$i=0;
                            while($result = $show_category->fetch_assoc()){$i++;
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $result['category_id'] ?></td>
                            <td><?php echo $result['category_name'] ?></td>
                            <td><a href="category_update.php?category_id=<?php echo $result['category_id'] ?>">Cập nhật</a> | <a href="category_delete.php?category_id=<?php echo $result['category_id'] ?>">Xóa</a></td>
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