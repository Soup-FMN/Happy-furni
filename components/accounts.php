<?php
include "class/order_class.php";
?>

<?php
if (!isset($_SESSION['email'])) {
  $user_id = $_SESSION['id'];
}
?>

<?php
$order = new order;
$user_id = $_SESSION['id'];

$show_order = $order->show_order($user_id);
?>

<!--=============== MAIN ===============-->
<main class="main">
  <!--=============== BREADCRUMB ===============-->
  <section class="breadcrumb">
    <ul class="breadcrumb__list flex container">
      <li><a href="index.php" class="breadcrumb__link">Home</a></li>
      <li><span class="breadcrumb__link">></span></li>
      <li><span class="breadcrumb__link">My Account</span></li>
    </ul>
  </section>

  <!--=============== ACCOUNTS ===============-->
  <section class="accounts section--lg">
    <div class="accounts__container container grid">
      <div class="account__tabs">
        <p class="account__tab active-tab" data-target="#dashboard">
          <i class="fi fi-rs-settings-sliders"></i> Dashboard
        </p>

        <p class="account__tab" data-target="#orders">
          <i class="fi fi-rs-shopping-bag"></i> Orders
        </p>

        <p class="account__tab" data-target="#update-profile">
          <i class="fi fi-rs-user"></i> Update Profile
        </p>

        <p class="account__tab" data-target="#address">
          <i class="fi fi-rs-marker"></i> My Address
        </p>

        <p class="account__tab" data-target="#change-password">
          <i class="fi fi-rs-user"></i> Change Password
        </p>

        <a href="components/logout.php">
          <p class="account__tab logout">
            <i class="fi fi-rs-exit">
            </i> Logout
          </p>
        </a>
      </div>

      <div class="tabs__content">
        <div class="tab__content active-tab" content id="dashboard">
            <h3 class="tab__header">Welcome <?php echo $name ?>!</h3>

          <div class="tab__body">
            <p class="tab__description">
              Form your account dashboard!
            </p>
          </div>
        </div>

        <div class="tab__content" content id="orders">
          <h3 class="tab__header">Your Orders</h3>

          <div class="tab__body">
            <table class="placed__order-table">
              <tr>
                <th>Orders</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total</th>
                <!-- <th>Actions</th> -->
              </tr>
              <?php
          if ($show_order) {
            $i = 0;
            while ($result = $show_order->fetch_assoc()) {
              $i++;
          ?>
              <tr>
                <td>#<?php echo $result['id'] ?></td>
                <td><?php echo $result['date_order'] ?></td>
                <td><?php echo $result['status'] ?></td>
                <td class="view__order">$<?php echo $result['total'] ?></td>
                <!-- <td><a href="#" class="view__order">View</a></td> -->
              </tr>
              <?php } }?>

              <!-- <tr>
                <td>#12468</td>
                <td>June 12,2024</td>
                <td>Completed</td>
                <td>$364.00</td>
                <td><a href="#" class="view__order">View</a></td>
              </tr>

              <tr>
                <td>#666</td>
                <td>July 20,2024</td>
                <td>Completed</td>
                <td>$280.00</td>
                <td><a href="#" class="view__order">View</a></td>
              </tr> -->
            </table>
          </div>
        </div>

        <div class="tab__content" content id="update-profile">
          <h3 class="tab__header">Update Profile</h3>

          <div class="tab__body">
            <form action="components/user/user_update_by_name.php" class="form grid" method="POST">
              <input name="name" type="text" placeholder="Username" class="form__input">

              <div class="form__btn">
                <button class="btn btn--md">Save</button>
              </div>
            </form>
          </div>
        </div>

        <div class="tab__content" content id="address">
          <h3 class="tab__header">Shipping Address</h3>

          <div class="tab__body">
            <address class="address">
              Address: 777 strest
            </address>
            <p class="city">City: Ha Noi</p>
            <p class="city">Country: Viet Nam</p>
            <a href="" class="edit">Edit</a>
          </div>
        </div>

        <div class="tab__content" content id="change-password">
          <h3 class="tab__header">Change Password</h3>

          <div class="tab__body">
            <form action="components/user/user_update_by_password.php" class="form grid" method="POST">
              <input name="password" type="password" placeholder="Current Password" class="form__input">

              <input name="new_password" type="password" placeholder="New Password" class="form__input">

              <input name="confirm_password" type="password" placeholder="Confirm Password" class="form__input">

              <div class="form__btn">
                <button class="btn btn--md">Save</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!--=============== NEWSLETTER ===============-->
  <section class="newsletter section">
    <div class="newsletter__container container grid">
      <h3 class="newsletter__title flex">
        <img src="assets/img/icon-email.svg" alt="" class="newsletter__icon">
        Sign up to Newsletter
      </h3>

      <p class="newsletter__description">...and receive $25 coupon for first shopping.</p>

      <form action="" class="newsletter__form">
        <input type="text" placeholder="Enter your email" class="newsletter__input">
        <button type="submit" class="newsletter__btn">Subscribe</button>
      </form>
    </div>
  </section>
</main>