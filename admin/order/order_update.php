<?php
include "../layouts/header.php";
include "../layouts/slider.php";
include "../database.php";
include "../class/order_class.php";
?>
<?php
$order = new order;

if($_GET['id'] == NULL || !isset($_GET['id'])) {
    echo "<script> window.location = 'order_show.php' </script>";
} else {
    $id = $_GET['id'];
}

$get_order_by_id = $order->get_order_by_id($id);
$row = mysqli_fetch_assoc($get_order_by_id);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order->update_order($id, $_POST);
}
?>
<style>
    h1 {
        margin: 20px;
    }

    select {
        display: block;
        font-size: 20px;
        padding: 4px 10px;
        outline: none;
        border: 3px solid var(--light-btn);
        margin-bottom: 10px;
        margin-left: 10px;
        min-width: 210px;
    }
</style>
<div class="right_contents">
    <div class="right-contents-item right-contents-product_insert">
        <h1>Cập nhật trạng thái đơn hàng</h1>
        <form action="" method="POST">       
            <label for="" style="margin-left: 20px; font-size: 20px">Mã đơn hàng<span style="color: red; font-weight: 900;"> #<?php echo $row['id']?></span></label>
            <select name="status" id="" required>
            <option value="#">------Trạng thái------</option>
                <option value="Waiting For Delevery">Chờ lấy hàng</option>
                <option value="Being Transported">Đang được vận chuyển</option>
                <option value="Received Successfully">Đã nhận hàng</option>
                <option value="Canceled">Đã hủy đơn hàng</option>
            </select>
            <button style="margin: 20px;" class="btn" type="submit">Ghi lại</button>
        </form>
    </div>
</div>
</body>
</html>