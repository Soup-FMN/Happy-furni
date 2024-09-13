<?php
include "../layouts/header.php";
include "../layouts/slider.php";
include "../database.php";
include "../class/user_manager_class.php";
?>
<?php
$user = new user;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user->insert_user($_POST);
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

    form>input {
        text-transform: none;
        display: block;
        margin-bottom: 10px;
        margin: 20px;
    }
</style>

<div class="right_contents">
    <div class="right-contents-item right-contents-product_insert">
        <h1>Thêm người dùng</h1>
        <form action="" method="POST">
            <input name="name" required type="text" placeholder="Nhập tên người dùng">

            <input name="email" required type="email" placeholder="Nhập email">

            <input name="password" required type="password" placeholder="Nhập mật khẩu">
            
            <label for="" style="margin-left: 20px; font-size: 20px">Chỉ định vai trò <span style="color: red;">*</span></label>
            <select name="role" id="" required>
            <option value="#">---Vai trò---</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button style="margin: 20px;" class="btn" type="submit">Thêm</button>
        </form>
    </div>
</div>
</body>
</html>