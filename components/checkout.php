<?php
include "class/cart_class.php";

?>
<?php
if (!isset($_SESSION['email'])) {
} else {
  $user_id = $_SESSION['id'];
  $arr_total = [];
  $cost_ship = 0;
  $cart = new cart;
  $show_cart_detail = $cart->show_cart_detail($id);
}
?>




<!--=============== MAIN ===============-->
<main class="main">
  <!--=============== BREADCRUMB ===============-->
  <section class="breadcrumb">
    <ul class="breadcrumb__list flex container">
      <li><a href="index.html" class="breadcrumb__link">Home</a></li>
      <li><span class="breadcrumb__link">></span></li>
      <li><a href="shop.html" class="breadcrumb__link">Shop</a></li>
      <li><span class="breadcrumb__link">></span></li>
      <li><span class="breadcrumb__link">Checkout</span></li>
    </ul>
  </section>

  <!--=============== CHECKOUT ===============-->
  <section class="checkout section--lg">
    <form action="components/order/order_insert.php" method="POST">
    <div class="checkout__container container grid">
      <div class="checkout__group">
        <h3 class="section__title">Billing Details</h3>
        <div class="form grid">

          <label for="phone">Name: <span style="color: red;">*</span></label>
          <p>Your name: <span><?php echo $name ?></span></p>
          <!-- <input type="text" placeholder="Name" class="form__input"> -->
          <label for="phone">Address: <span style="color: red;">*</span></label>
          <input type="text" name="address" required placeholder="Address" class="form__input">
          <label for="phone">City: <span style="color: red;">*</span></label>
          <input type="text" name="city" required placeholder="City" class="form__input">
          <label for="phone">Country: <span style="color: red;">*</span></label>
          <input type="text" name="country" required placeholder="Country" class="form__input">

          <!-- <input type="text" placeholder="Postcode" class="form__input"> -->
          <label for="phone">Phone: <span style="color: red;">*</span></label>
          <input type="text" name="phone_number" required placeholder="Phone" class="form__input">

          <!-- <input type="email" placeholder="Email" class="form__input"> -->

          <h3 class="checkout__title">Additional Information</h3>

          <textarea name="note" required placeholder="Order note" id="" cols="30" rows="10" class="form__input textarea"></textarea>
        </div>
      </div>

      <div class="checkout__group">
        <h3 class="section__title">Cart Totals</h3>

        <table class="order__table">
          <tr>
            <th colspan="2">Products</th>
            <th>Total</th>
          </tr>

          <tr>
            <?php
            if (mysqli_num_rows($show_cart_detail) > 0) {
              while ($result = mysqli_fetch_assoc($show_cart_detail)) {
                $tmp_total = $result['product_price_new'] * $result['quantity'];
                $total = $tmp_total - (int)$tmp_total != 0 ? $tmp_total : $tmp_total . ".00";
                array_push($arr_total, $tmp_total);
            ?>
                <td><img src="<?php echo "admin/uploads/" . $result['product_img'] ?>" alt="" class="order__img"></td>

                <td>
                  <h3 class="table__title"><?php echo $result['product_name'] ?></h3>
                  <p class="table__quantity">x <?php echo $result['quantity'] ?></p>
                </td>

                <td><span class="table__price">$<?php echo $total ?></span></td>
          </tr>
      <?php
              }
            } ?>
      <!-- <tr>
            <td><img src="assets/img/product-img/product-2-1.jpg" alt="" class="order__img"></td>

            <td>
              <h3 class="table__title">Floral Print Casual Cotton Dress</h3>
              <p class="table__quantity">x 1</p>
            </td>

            <td><span class="table__price">$65.00</span></td>
          </tr>

          <tr>
            <td><img src="assets/img/product-img/product-7-1.jpg" alt="" class="order__img"></td>

            <td>
              <h3 class="table__title">Floral Print Casual Cotton Dress</h3>
              <p class="table__quantity">x 2</p>
            </td>

            <td><span class="table__price">$35.00</span></td>
          </tr> -->
      <?php
      $tmp_sum_total = 0;
      for ($i = 0; $i < count($arr_total); $i++) {
        $tmp_sum_total += $arr_total[$i];
      }
      $sum_total = $tmp_sum_total - (int)$tmp_sum_total != 0 ? $tmp_sum_total : $tmp_sum_total . ".00" ?>
      <tr>
        <td><span class="order__subtitle">SubTotal</span></td>
        <td colspan="2"><span class="table__price">$<?php echo $sum_total ?></span></td>
      </tr>

      <tr>
        <td><span class="order__subtitle">Shipping</span></td>
        <td colspan="2"><span class="table__price">Freeship</span></td>
      </tr>

      <tr>
        <td><span class="order__subtitle">Total</span></td>
        <td colspan="2"><span class="order__grand-total">
          $<?php $tmp_total_final = $sum_total + $cost_ship;
            $total_final = $tmp_total_final - (int)$tmp_total_final != 0 ?
              $tmp_total_final : $tmp_total_final . ".00";
            echo $total_final; ?>
          </span></td>
      </tr>
        </table>

        <div class="payment__methods">
          <h3 class="checkout__title payment__title">Payment</h3>

          <div class="payment__option flex">
            <input type="radio" name="payment" checked class="payment__input" value="Direct Bank Transfer">
            <label for="" class="payment__label">Direct Bank Transfer</label>
          </div>

          <div class="payment__option flex">
            <input type="radio" name="payment" checked class="payment__input" value="Payment on Delivery">
            <label for="" class="payment__label">Payment on Delivery</label>
          </div>

          <div class="payment__option flex">
            <input type="radio" name="payment" checked class="payment__input" value="Paypal">
            <label for="" class="payment__label">Paypal</label>
          </div>
        </div>

        <button type="submit" class="btn btn--md">Place Order</button>
      </div>
    </div>
    </form>
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