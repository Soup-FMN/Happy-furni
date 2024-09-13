<?php
include "../layouts/header.php";
include "../layouts/slider.php";
include "../database.php";
include "../class/product_class.php";
?>
<?php
$product = new product;
$show_product = $product->show_product();
?>

<div class="right-contents">
    <div class="right-contents-item right-contents-category_show">
        <h1>Danh sách Sản phẩm</h1>

        <table>
            <tr>
                <th width="3% ">STT</th>
                <th width="3% ">ID</th>
                <th width="5%">Danh mục</th>
                <th width="5%">Loại sản phẩm</th>
                <th width="10%">Tên</th>
                <th width="5%">Giá Cũ</th>
                <th width="5%">Giá Mới</th>
                <th width="15%">Mô tả</th>
                <th width="30%">Image</th>
                <th width="8%">Tùy biến</th>
            </tr>
            <?php
            if ($show_product) {
                $i = 0;
                while ($result = $show_product->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['product_id'] ?></td>
                        <td><?php echo $result['category_name'] ?></td>
                        <td><?php echo $result['brand_name'] ?></td>
                        <td><?php echo $result['product_name'] ?></td>
                        <td><?php echo $result['product_price'] ?></td>
                        <td><?php echo $result['product_price_new'] ?></td>
                        <td><?php echo $result['product_desc'] ?></td>
                        <td>
                            <img src="<?php echo "../uploads/" . $result['product_img'] ?>" width="50%" style="height: 220px;" alt="">
                        </td>
                        <td><a href="product_update.php?product_id=<?php echo $result['product_id'] ?>">Cập nhật</a> | <a href="product_delete.php?product_id=<?php echo $result['product_id'] ?>">Xóa</a></td>
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
</body>

</html>