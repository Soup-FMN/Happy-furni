<?php
include "admin/class/category_class.php";
include "admin/class/product_class.php";
include "admin/class/brand_class.php";
?>

<?php
$product = new product;
$category = new category;
$brand = new brand;
$category_id = $_GET['category_id']??NULL;

$limit_number_products_show = 20;

$show_product_by_category = NULL;
if($category_id) {
  $show_product_by_category = $product->show_product_by_category($category_id);
}
// $get_product_by_category = $product->get_product_by_category();
$show_product = $product->show_product();
$show_category = $category->show_category();
$show_brand = $brand->show_brand();

$show_product_shop = $product->show_product_shop($limit_number_products_show);
?>

<style>
  .ct__list {
    display: flex;
    align-items: center;
    column-gap: 2rem;
    margin-right: auto;
    margin-bottom: 30px;
    margin-top: -20px;
  }
  
  a>h3:hover {
    color: var(--blue-color);
    text-decoration-line: underline;
    margin-left: 2px;
  }

  .total__products {
    margin-top: -30px;
  }

  .all_link:hover {
    color: var(--blue-color);
    text-decoration-line: underline;
    cursor: pointer;
  }
</style>

<!--=============== MAIN ===============-->
<main class="main">
  <!--=============== BREADCRUMB ===============-->
  <section class="breadcrumb">
    <ul class="breadcrumb__list flex container">
      <li><a href="index.php" class="breadcrumb__link">Home</a></li>
      <li><span class="breadcrumb__link">></span></li>
      <li><span class="breadcrumb__link">Shop</span></li>
    </ul>
  </section>

  <!--=============== PRODUCTS ===============-->
  <section class="products section--lg container">
    <p class="total__products">We found a lot of <span>suitable products</span> for you!</p>
    <ul class="ct__list">
      <li class="ct__item active-tab" data-target="#all">
        <span class="all_link">
          <h3 style="color: var(--blue-color);">All</h3>
        </span>
      </li>
      <?php
      if ($show_category) {
        $i = 0;
        while ($result = $show_category->fetch_assoc()) {
          $i++;
      ?>
          <li class="ct__item" data-target="#category">
            <a href="index.php?page=shop&category_id=<?php echo $result['category_id'] ?>" class="ct_link">
              <h3 class=""><?php echo $result['category_name'] ?></h3>
            </a>
          </li>
      <?php
        }
      }
      ?>
    </ul>
    <!-- Testing -->
    <div class="tab__items">
      <div class="tab__item" content id="all">
        <div class="products__container grid">
          <?php
          if ($show_product_shop) {
            $i = 0;
            while ($result = $show_product_shop->fetch_assoc()) {
              $i++;
          ?>
              <div class="product__item">
                <div class="product__banner">
                  <a href="index.php?page=details&product_id=<?php echo $result['product_id'] ?>" class="product__images">
                    <img src="<?php echo "admin/uploads/" . $result['product_img'] ?>" alt="" class="product__img default">
                    <!-- <img src="assets/img/product-img/product-1-1.jpg" alt="" class="product__img default"> -->

                    <img src="<?php echo "admin/uploads/" . $result['product_img_desc'] ?>" alt="" class="product__img hover">
                  </a>

                  <div class="product__actions">
                    <!-- <a href="#" class="action__btn" aria-label="Quick View">
              <i class="fi fi-rs-eye"></i>
            </a> -->

                    <a href="components/wishlist/wishlist_insert.php?product_id=<?php echo $result['product_id'] ?>" class="action__btn" aria-label="Wishlist">
                      <i class="fi fi-rs-heart"></i>
                    </a>

                    <!-- <a href="#" class="action__btn" aria-label="Compare">
              <i class="fi fi-rs-shuffle"></i>
            </a> -->
                  </div>

                  <div class="product__badge light-pink">Hot</div>
                </div>

                <div class="product__content">
                  <span class="product__category"><?php echo $result['category_name'] ?></span>
                  <a href="index.php?page=details&product_id=<?php echo $result['product_id'] ?>">
                    <h3 class="product__title"><?php echo $result['product_name'] ?></h3>
                  </a>
                  <div class="product__rating">
                    <i class="fi fi-rs-star"></i>
                    <i class="fi fi-rs-star"></i>
                    <i class="fi fi-rs-star"></i>
                    <i class="fi fi-rs-star"></i>
                    <i class="fi fi-rs-star"></i>
                  </div>
                  <div class="product__price flex">
                    <span class="new__price">$<?php echo $result['product_price_new'] ?></span>
                    <span class="old__price">$<?php echo $result['product_price'] ?></span>
                  </div>

                  <a href="components/cart/cart_insert.php?product_id=<?php echo $result['product_id'] ?>" class="action__btn cart__btn" aria-label="Add To Card">
                    <i class="fi fi-rs-shopping-bag-add"></i>
                  </a>
                </div>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
      <div class="tab__item active-tab" content id="category">
        <div class="products__container grid">
          <?php
          if ($show_product_by_category) {
            $i = 0;
            while ($result = $show_product_by_category->fetch_assoc()) {
              $i++;
          ?>
              <div class="product__item">
                <div class="product__banner">
                  <a href="index.php?page=details&product_id=<?php echo $result['product_id'] ?>" class="product__images">
                    <img src="<?php echo "admin/uploads/" . $result['product_img'] ?>" alt="" class="product__img default">

                    <img src="<?php echo "admin/uploads/" . $result['product_img_desc'] ?>" alt="" class="product__img hover">
                  </a>

                  <div class="product__actions">
                    <!-- <a href="#" class="action__btn" aria-label="Quick View">
                        <i class="fi fi-rs-eye"></i>
                      </a> -->

                    <a href="components/wishlist/wishlist_insert.php?product_id=<?php echo $result['product_id'] ?>" class="action__btn" aria-label="Wishlist">
                      <i class="fi fi-rs-heart"></i>
                    </a>

                    <!-- <a href="#" class="action__btn" aria-label="Compare">
                        <i class="fi fi-rs-shuffle"></i>
                      </a> -->
                  </div>

                  <div class="product__badge light-pink">Hot</div>
                </div>

                <div class="product__content">
                  <span class="product__category"><?php echo $result['category_name'] ?></span>
                  <a href="index.php?page=details&product_id=<?php echo $result['product_id'] ?>">
                    <h3 class="product__title"><?php echo $result['product_name'] ?></h3>
                  </a>
                  <div class="product__rating">
                    <i class="fi fi-rs-star"></i>
                    <i class="fi fi-rs-star"></i>
                    <i class="fi fi-rs-star"></i>
                    <i class="fi fi-rs-star"></i>
                    <i class="fi fi-rs-star"></i>
                  </div>
                  <div class="product__price flex">
                    <span class="new__price">$<?php echo $result['product_price_new'] ?></span>
                    <span class="old__price">$<?php echo $result['product_price'] ?></span>
                  </div>

                  <a href="components/cart/cart_insert.php?product_id=<?php echo $result['product_id'] ?>" class="action__btn cart__btn" aria-label="Add To Card">
                    <i class="fi fi-rs-shopping-bag-add"></i>
                  </a>
                </div>
              </div>
          <?php }
          } ?>
        </div>
      </div>
    </div>
    <!-- End testing -->


    <ul class="pagination">
      <li><a href="#" class="pagination__link active">01</a></li>
      <li><a href="#" class="pagination__link">02</a></li>
      <li><a href="#" class="pagination__link">03</a></li>
      <li><a href="#" class="pagination__link">...</a></li>
      <li><a href="#" class="pagination__link">16</a></li>
      <li>
        <a href="#" class="pagination__link icon">
          <i class="fi-rs-angle-double-small-right"></i>
        </a>
      </li>
    </ul>
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