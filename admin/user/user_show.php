<?php
include "../layouts/header.php";
include "../layouts/slider.php";
include "../database.php";
include "../class/user_manager_class.php";
?>

<?php
$user = new user;
$show_user = $user->show_user();
?>
<style>
    table>tr>td {
        text-transform: none;
    }
</style>

<div class="right-contents">
    <div class="right-contents-item right-contents-category_show">
        <h1>Danh sách người dùng</h1>

        <table>
            <tr>
                <th width="3% ">STT</th>
                <th width="3% ">ID</th>
                <th width="5%">Email</th>
                <th width="5%">Mật khẩu</th>
                <th width="10%">Tên</th>
                <th width="5%">Vai trò</th>
                <th width="8%">Tùy biến</th>
            </tr>
            <?php
            if ($show_user) {
                $i = 0;
                while ($result = $show_user->fetch_assoc()) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['id'] ?></td>
                        <td><?php echo $result['email'] ?></td>
                        <td><?php echo $result['password'] ?></td>
                        <td><?php echo $result['name'] ?></td>
                        <td><?php echo $result['role'] ?></td>
                        <td><a href="user_update.php?id=<?php echo $result['id'] ?>">Cập nhật</a> | <a href="user_delete.php?id=<?php echo $result['id'] ?>">Xóa</a></td>
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