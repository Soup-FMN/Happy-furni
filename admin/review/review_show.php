<?php
include "../layouts/header.php";
include "../layouts/slider.php";
include "../database.php";
include "../class/review_class.php";
?>

<?php
$review = new review;
$show_review = $review->show_review();
?>
<style>
    table>tr>td {
        text-transform: none;
    }
</style>

<div class="right-contents">
    <div class="right-contents-item right-contents-category_show">
        <h1>Danh sách Đánh giá</h1>

        <table>
            <tr>
                <th width="3% ">STT</th>
                <th width="3% ">Tên người dùng</th>
                <th width="5%">Tên sản phẩm</th>
                <th width="10%">Nội dung</th>
                <th width="5%">Tùy biến</th>
            </tr>
            <?php
            if ($show_review) {
                $i = 0;
                while ($result = $show_review->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['name'] ?></td>
                        <td><?php echo $result['product_name'] ?></td>
                        <td><?php echo $result['review_data'] ?></td>
                        <td>
                            <a href="review_delete.php?product_id=<?php echo $result['product_id']?>&user_id=<?php echo $result['user_id'] ?>">Xóa</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
        </form>

    </div>
</div>
</body>

</html>