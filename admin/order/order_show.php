<?php
include "../layouts/header.php";
include "../layouts/slider.php";
include "../database.php";
include "../class/order_class.php";
?>

<?php
$order = new order;
$show_order = $order->show_order();
?>

<div class="right-contents">
    <div class="right-contents-item right-contents-category_show">
        <h1>Danh Sách Đơn Hàng</h1>

        <table>
            <tr>
                <th width="3% ">STT</th>
                <th width="3% ">ID Đơn hàng</th>
                <th width="3% ">Tên</th>
                <th width="5%">SĐT</th>
                <th width="13%">Địa chỉ</th>
                <th width="5%">Ngày đặt hàng</th>
                <th width="3%">Tổng tiền</th>
                <th width="10%">Ghi chú</th>
                <th width="5%">Hình thức thanh toán</th>
                <th width="8%">Trạng thái</th>
                <th width="8%">Tùy biến</th>
            </tr>
            <?php
            if ($show_order) {
                $i = 0;
                while ($result = $show_order->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td>#<?php echo $result['id'] ?></td>
                        <td><?php echo $result['user_name'] ?></td>
                        <td><?php echo $result['phone_number'] ?></td>
                        <td><?php echo $result['address'] ?> + <?php echo $result['city'] ?> + <?php echo $result['country'] ?></td>
                        <td><?php echo $result['date_order'] ?></td>
                        <td>$<?php echo $result['total'] ?></td>
                        <td><?php echo $result['note'] ?></td>
                        <td><?php echo $result['payment'] ?></td>
                        <td><?php echo $result['status'] ?></td>
                        <td><a href="order_update.php?id=<?php echo $result['id'] ?>">Cập nhật</a> | <a href="order_delete.php?id=<?php echo $result['id'] ?>">Xóa</a></td>
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
            if (option_active && option_active != e.target) {
                option_active.classList.remove('active');
            }
            option.classList.toggle('active');
        })
    })
</script>
<!-- script end -->
</body>

</html>