<?php
// include 'admin/database.php';
include "class/cart_class.php";
?>

<?php
$cart = new cart;

$check_data = false;
if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
  $show_cart_detail = $cart->show_cart_detail($user_id);
  $arr_total = [];
  $cost_ship = 0;
  if ($show_cart_detail && mysqli_num_rows($show_cart_detail) > 0) {
    $check_data = true;
  }
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
      <li><span class="breadcrumb__link">Cart</span></li>
    </ul>
  </section>

  <!--=============== CART ===============-->
  <section class="cart section--lg container">
    <div class="table__container">
      <?php if ($check_data) { ?>
        <table class="table">
          <form action="components/cart/cart_update.php">
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Subtotal</th>
              <th>Remove</th>
            </tr>
            <?php if (mysqli_num_rows($show_cart_detail) > 0) {
              while ($result = mysqli_fetch_assoc($show_cart_detail)) {
                $tmp_total = $result['product_price_new'] * $result['quantity'];
                $total = $tmp_total - (int)$tmp_total != 0 ? $tmp_total : $tmp_total . "";
                array_push($arr_total, $tmp_total); ?>

                <tr>
                  <td><img src="<?php echo "admin/uploads/" . $result['product_img'] ?>" alt="" class="table__img"></td>

                  <td>
                    <h3 class="table__title"><?php echo $result['product_name'] ?></h3>

                    <p class="table__description"><?php echo $result['product_desc'] ?></p>
                  </td>

                  <td><span class="table__price">$<?php echo $result['product_price_new'] ?></span></td>

                  <td><input type="number" name="<?php echo $result['product_id'] ?>" value="<?php echo $result['quantity'] ?>" class="quantity"></td>

                  <td><span class="table__subtotal">$<?php echo $total ?></span></td>

                  <td>
                    <a href="components/cart/cart_delete.php?product_id=<?php echo $result['product_id'] ?>">
                      <i class="fi fi-rs-trash table__trash"></i>
                    </a>
                  </td>
                </tr>

                <!-- <tr>
                  <td><img src="assets/img/product-img/product-7-2.jpg" alt="" class="table__img"></td>

                  <td>
                    <h3 class="table__title">Floral Print Casual Cotton Dress</h3>

                    <p class="table__description">In a world of worriers, be the warrior, In a world of worriers, be the warrior</p>
                  </td>

                  <td><span class="table__price">$110</span></td>

                  <td><input type="number" value="3" class="quantity"></td>

                  <td><span class="table__subtotal">$220</span></td>

                  <td><i class="fi fi-rs-trash table__trash"></i></td>
                </tr>

                <tr>
                  <td><img src="assets/img/product-img/product-2-1.jpg" alt="" class="table__img"></td>

                  <td>
                    <h3 class="table__title">Floral Print Casual Cotton Dress</h3>

                    <p class="table__description">In a world of worriers, be the warrior, In a world of worriers, be the warrior</p>
                  </td>

                  <td><span class="table__price">$110</span></td>

                  <td><input type="number" value="3" class="quantity"></td>

                  <td><span class="table__subtotal">$220</span></td>

                  <td><i class="fi fi-rs-trash table__trash"></i></td>
                </tr> -->

            <?php }
            } ?>
        </table>
    </div>

    <div class="cart__actions">
      <button type="submit" class="btn flex btn--md">
        <i class="fi fi-rs-shuffle"></i> Update Cart
      </button>
      </form>
      <a href="index.php?page=home" class="btn flex btn--md">
        <i class="fi fi-rs-shopping-bag"></i> Continues Shopping
      </a>
    </div>

    <div class="divider">
      <i class="fi fi-rs-fingerprint"></i>
    </div>

    <div class="cart__group grid">
      <div>
        <!-- <div class="cart__shipping">
          <h3 class="section__title">Calculate Shipping</h3>

          <form action="" class="form grid">
            <input type="text" placeholder="State / Country" class="form__input">

            <div class="form__group grid">
              <input type="text" placeholder="City" class="form__input">

              <input type="text" placeholder="PostCode / ZIP" class="form__input">
            </div>

            <div class="form__btn">
              <button class="btn flex btn--sm">
                <i class="fi-rs-shuffle"></i> Update
              </button>
            </div>
          </form>
        </div> -->

        <div class="cart__coupon">
          <h3 class="section__title">Apply Coupon</h3>

          <form action="" class="coupon__form form grid">
            <div class="form__group grid">
              <input type="text" class="form__input" placeholder="Enter Your Coupon">

              <div class="form__btn">
                <button class="btn flex btn--sm">
                  <i class="fi-rs-label"></i> Apply
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="cart__total">
        <h3 class="section__title">Cart Totals</h3>
        <?php
        $tmp_sum_total = 0;
        for ($i = 0; $i < count($arr_total); $i++) {
          $tmp_sum_total += $arr_total[$i];
        }
        $sum_total = $tmp_sum_total - (int)$tmp_sum_total != 0 ? $tmp_sum_total : $tmp_sum_total . ".00" ?>
        <table class="cart__total-table">
          <tr>
            <td><span class="cart__total-title">Cart Subtotal</span></td>
            <td><span class="cart__total-price">$<?php echo $sum_total ?></span></td>
          </tr>

          <tr>
            <td><span class="cart__total-title">Shipping</span></td>
            <td><span class="cart__total-price">Freeship</span></td>
          </tr>

          <tr>
            <td><span class="cart__total-title">Total</span></td>
            <td><span class="cart__total-price">
                $<?php $tmp_total_final = $sum_total + $cost_ship;
                $total_final = $tmp_total_final - (int)$tmp_total_final != 0 ?
                  $tmp_total_final : $tmp_total_final . ".00";
                echo $total_final; ?>
              </span></td>
          </tr>
        </table>

        <a href="index.php?page=checkout" class="btn flex btn--md">
          <i class="fi fi-rs-box-alt"></i> Proceed To Checkout
        </a>
      </div>
    </div>
  </section>
<?php } else { ?>
  <a href="index.php?page=home" class="btn flex btn--md" style="width: 30%; display: flex; justify-content: center; margin: 0 auto">
    <i class="fi fi-rs-shopping-bag"></i>Shopping Now
  </a>
  <div class="cart__empty" style="display: flex; justify-content: center">
    <img src="assets/img/empty-cart.png" alt="">
  </div>
<?php } ?>
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