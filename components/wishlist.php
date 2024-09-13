<?php
include "class/wishlist_class.php";
?>
<?php
$wishlist = new wishlist;

$check_data = false;
if (isset($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
  $show_wishlist_detail = $wishlist->show_wishlist_detail($user_id);
  if ($show_wishlist_detail && mysqli_num_rows($show_wishlist_detail) > 0) {
    $check_data = true;
  }
}
?>


<!--=============== MAIN ===============-->
<main class="main">
  <!--=============== BREADCRUMB ===============-->
  <section class="breadcrumb">
    <ul class="breadcrumb__list flex container">
      <li><a href="index.php" class="breadcrumb__link">Home</a></li>
      <li><span class="breadcrumb__link">></span></li>
      <li><a href="index.php?page=shop" class="breadcrumb__link">Shop</a></li>
      <li><span class="breadcrumb__link">></span></li>
      <li><span class="breadcrumb__link">Wishlist</span></li>
    </ul>
  </section>

  <!--=============== WISHLIST ===============-->
  <section class="wishlist section--lg container">
    <div class="table__container">
      <?php if ($check_data) { ?>
        <table class="table">
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock Status</th>
            <th>Action</th>
            <th>Remove</th>
          </tr>
          <?php if (mysqli_num_rows($show_wishlist_detail) > 0) {
            while ($result = mysqli_fetch_assoc($show_wishlist_detail)) { ?>
              <tr>
                <td><img src="<?php echo "admin/uploads/" . $result['product_img'] ?>" alt="" class="table__img"></td>

                <td>
                  <h3 class="table__title"><?php echo $result['product_name'] ?></h3>

                  <p class="table__description"><?php echo $result['product_desc'] ?></p>
                </td>

                <td><span class="table__price">$<?php echo $result['product_price_new'] ?></span></td>

                <td><span class="table__stock">In Stock</span></td>

                <td><a href="components/cart/cart_insert.php?product_id=<?php echo $result['product_id'] ?>" class="btn btn btn--sm">Add to Cart</a></td>

                <td>
                  <a href="components/wishlist/wishlist_delete.php?product_id=<?php echo $result['product_id'] ?>">
                    <i class="fi fi-rs-trash table__trash"></i>
                  </a>
                </td>
              </tr>
          <?php }
          } ?>
          <!-- <tr>
            <td><img src="assets/img/product-img/product-7-2.jpg" alt="" class="table__img"></td>

            <td>
              <h3 class="table__title">Floral Print Casual Cotton Dress</h3>

              <p class="table__description">In a world of worriers, be the warrior, In a world of worriers, be the warrior</p>
            </td>

            <td><span class="table__price">$110</span></td>

            <td><span class="table__stock">In Stock</span></td>

            <td><a href="" class="btn btn btn--sm">Add to Cart</a></td>

            <td><i class="fi fi-rs-trash table__trash"></i></td>
          </tr>

          <tr>
            <td><img src="assets/img/product-img/product-2-1.jpg" alt="" class="table__img"></td>

            <td>
              <h3 class="table__title">Floral Print Casual Cotton Dress</h3>

              <p class="table__description">In a world of worriers, be the warrior, In a world of worriers, be the warrior</p>
            </td>

            <td><span class="table__price">$110</span></td>

            <td><span class="table__stock">In Stock</span></td>

            <td><a href="" class="btn btn btn--sm">Add to Cart</a></td>

            <td><i class="fi fi-rs-trash table__trash"></i></td>
          </tr> -->
        </table>
    </div>
  </section>
<?php } else { ?>
  <a href="index.php?page=home" class="btn flex btn--md" style="width: 30%; display: flex; justify-content: center; margin: 0 auto">
    <i class="fi fi-rs-shopping-bag"></i>Shopping Now
  </a>
  <div class="wishlist__empty" style="display: flex; justify-content: center;">
    <img src="assets/img/empty-wishlist.jpg" alt="" style="max-width: 45%; margin: 45px 0; border-radius: 15px;">
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