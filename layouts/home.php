<?php
// include "admin/database.php";
include "admin/class/category_class.php";
include "admin/class/product_class.php";
include "admin/class/brand_class.php";
?>

<?php
$category = new category;
$product = new product;
$brand = new brand;
$limit_number_products_show = 8;
$brand_id = $_GET['brand_id']??NULL;

$show_product_by_brand= NULL;
if($brand_id) {
  $show_product_by_brand= $product->show_product_by_brand($brand_id);
}

$show_brand = $brand->show_brand();
$show_category = $category->show_category();
$show_product_litmit = $product->show_product_litmit($limit_number_products_show);
?>

<style>
  .ct__list {
    display: flex;
    align-items: center;
    column-gap: 2rem;
  }


  .ct__item {
    display: inline-block;
    background-color: var(--brown-color);
    border: 2px solid var(--brown-color);
    color: var(--body-color);
    padding-inline: 1.75rem;
    height: 49px;
    line-height: 49px;
    border-radius: .25rem;
    font-family: var(--second-font);
    font-size: var(--small-font-size);
    font-weight: var(--weight-700);
    transition: all 0.4s var(--transition);
  }

  .total__products {
    margin-top: -30px;
  }

  .ct__item:hover {
    background-color: var(--body-color);
    color: var(--brown-color);
    cursor: pointer;
  }

  a.ct_link>h3 {
    color: var(--body-color);
  }
  a.ct_link>h3:hover {
    color: var(--brown-color);
  }
</style>


<!--=============== MAIN ===============-->
<main class="main">
  <!--=============== HOME ===============-->
  <section class="home section--lg">
    <div class="home__container container grid">
      <div class="home__content">
        <span class="home__subtitle">Hot promotions</span>
        <h1 class="home__title">
          Furniture Trending <span>Great Collections</span>
        </h1>
        <p class="home__description">
          Save more with coupons & up to 20% off
        </p>
        <a href="index.php?page=shop" class="btn">Shop Now</a>
      </div>

      <img src="assets/img//home-img/home-sofa-2.png" alt="" class="home__img">
    </div>
  </section>

  <!--=============== CATEGORIES ===============-->
  <section class="categories container section">
    <h3 class="section__title"><span>Popular</span> Categories</h3>

    <div class="categories__container swiper">
      <div class="swiper-wrapper">
        <?php
        if ($show_category) {
          $i = 0;
          while ($result = $show_category->fetch_assoc()) {
            $i++;
        ?>
            <a href="index.php?page=shop&category_id=<?php echo $result['category_id'] ?>" class="category__item swiper-slide">
              <img src="<?php echo "admin/uploads/" . $result['category_img'] ?>" alt="" class="category__img">
              <h3 class="category__title"><?php echo $result['category_name'] ?></h3>
            </a>
        <?php
          }
        }
        ?>
      </div>

      <div class="swiper-button-next">
        <i class="fi fi-sr-angle-right"></i>
      </div>
      <div class="swiper-button-prev">
        <i class="fi fi-sr-angle-left"></i>
      </div>
    </div>
  </section>

  <!--=============== PRODUCTS ===============-->
  <section class="products section container">
    <div class="tab__btns">
      <ul class="ct__list">
        <?php
        if ($show_brand) {
          $i = 0;
          while ($result = $show_brand->fetch_assoc()) {
            $i++;
        ?>
            <!-- <span class="tab__btn active-tab" data-target="#featured" value=" echo $result['brand_id'] ?>"> echo $result['brand_name'] ?></span> -->
            <li class="ct__item" data-target="#brand">
              <a href="index.php?brand_id=<?php echo $result['brand_id'] ?>" class="ct_link">
                <h3 class=""><?php echo $result['brand_name'] ?></h3>
              </a>
            </li>
        <?php
          }
        }
        ?>
      </ul>
      <!-- <span class="tab__btn" data-target="#popular">Popular</span>
      <span class="tab__btn" data-target="#new-added">New added</span> -->
    </div>

    <div class="tab__items">
      <div class="tab__item active-tab" content id="brand">
        <div class="products__container grid">
          <?php
          if ($show_product_by_brand) {
            $i = 0;
            while ($result = $show_product_by_brand->fetch_assoc()) {
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

      <div class="tab__item" content id="popular">
        <div class="products__container grid">
          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-9-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-9-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>

              <div class="product__badge light-pink">Hot</div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>

          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-2-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-2-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>

              <div class="product__badge light-green">Hot</div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>

          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-10-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-10-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>

              <div class="product__badge light-orange">Hot</div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>

          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-4-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-4-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>

              <div class="product__badge light-blue">Hot</div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>

          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-5-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-5-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>

              <div class="product__badge light-pink">-30%</div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>

          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-11-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-11-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>

              <div class="product__badge light-pink">-22%</div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>

          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-7-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-7-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>

              <div class="product__badge light-green">Hot</div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>

          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-8-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-8-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="tab__item" content id="new-added">
        <div class="products__container grid">
          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-1-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-1-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>

              <div class="product__badge light-pink">Hot</div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>

          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-12-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-12-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>

              <div class="product__badge light-green">Hot</div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>

          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-3-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-3-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>

              <div class="product__badge light-orange">Hot</div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>

          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-13-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-13-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>

              <div class="product__badge light-blue">Hot</div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>

          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-10-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-10-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>

              <div class="product__badge light-pink">-30%</div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>

          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-6-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-6-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>

              <div class="product__badge light-pink">-22%</div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>

          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-9-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-9-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>

              <div class="product__badge light-green">Hot</div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>

          <div class="product__item">
            <div class="product__banner">
              <a href="index.php?page=details" class="product__images">
                <img src="assets/img/product-img/product-8-1.jpg" alt="" class="product__img default">

                <img src="assets/img/product-img/product-8-2.jpg" alt="" class="product__img hover">
              </a>

              <div class="product__actions">
                <a href="#" class="action__btn" aria-label="Quick View">
                  <i class="fi fi-rs-eye"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Wishlist">
                  <i class="fi fi-rs-heart"></i>
                </a>

                <a href="#" class="action__btn" aria-label="Compare">
                  <i class="fi fi-rs-shuffle"></i>
                </a>
              </div>
            </div>

            <div class="product__content">
              <span class="product__category">Chair</span>
              <a href="index.php?page=details">
                <h3 class="product__title">Single Sofa</h3>
              </a>
              <div class="product__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>
              <div class="product__price flex">
                <span class="new__price">$238.85</span>
                <span class="old__price">$245.8</span>
              </div>

              <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
                <i class="fi fi-rs-shopping-bag-add"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--=============== DEALS ===============-->
  <section class="deals section">
    <div class="deals__container container grid">
      <div class="deals__item">
        <div class="deals__group">
          <h3 class="deals__brand">Deal of the Day</h3>
          <span class="deals__category">Limited quantities.</span>
        </div>

        <h4 class="deals__title">Summer Collection New Morden Design</h4>

        <div class="deals__price flex">
          <span class="new__price">$139.00</span>
          <span class="old__price">$160.99</span>
        </div>

        <div class="deals__group">
          <p class="deals__countdown-text">Hurry Up! Offer End In:</p>

          <div class="countdown">
            <div class="countdown__amount">
              <p class="countdown__period">02</p>
              <span class="unit">Days</span>
            </div>
            <div class="countdown__amount">
              <p class="countdown__period">22</p>
              <span class="unit">Hours</span>
            </div>
            <div class="countdown__amount">
              <p class="countdown__period">57</p>
              <span class="unit">Mins</span>
            </div>
            <div class="countdown__amount">
              <p class="countdown__period">24</p>
              <span class="unit">Sec</span>
            </div>
          </div>
        </div>

        <div class="deals__btn">
          <a href="#" class="btn btn--md">Shop Now</a>
        </div>
      </div>

      <div class="deals__item">
        <div class="deals__group">
          <h3 class="deals__brand">Sofa Collection</h3>
          <span class="deals__category">Sofa & Chair.</span>
        </div>

        <h4 class="deals__title">Try something new on vacation</h4>

        <div class="deals__price flex">
          <span class="new__price">$178.00</span>
          <span class="old__price">$256.99</span>
        </div>

        <div class="deals__group">
          <p class="deals__countdown-text">Hurry Up! Offer End In:</p>

          <div class="countdown">
            <div class="countdown__amount">
              <p class="countdown__period">02</p>
              <span class="unit">Days</span>
            </div>
            <div class="countdown__amount">
              <p class="countdown__period">22</p>
              <span class="unit">Hours</span>
            </div>
            <div class="countdown__amount">
              <p class="countdown__period">57</p>
              <span class="unit">Mins</span>
            </div>
            <div class="countdown__amount">
              <p class="countdown__period">24</p>
              <span class="unit">Sec</span>
            </div>
          </div>
        </div>

        <div class="deals__btn">
          <a href="#" class="btn btn--md">Shop Now</a>
        </div>
      </div>
    </div>
  </section>

  <!--=============== NEW ARRIVALS ===============-->
  <section class="new__arrivals container section">
    <h3 class="section__title"><span>New</span> Arrivals</h3>

    <div class="new__container swiper">
      <div class="swiper-wrapper">
        <div class="product__item swiper-slide">
          <div class="product__banner">
            <a href="#" class="product__images">
              <img src="assets/img/product-img/product-1-1.jpg" alt="" class="product__img default">

              <img src="assets/img/product-img/product-1-2.jpg" alt="" class="product__img hover">
            </a>

            <div class="product__actions">
              <!-- <a href="#" class="action__btn" aria-label="Quick View">
                <i class="fi fi-rs-eye"></i>
              </a> -->

              <a href="#" class="action__btn" aria-label="Wishlist">
                <i class="fi fi-rs-heart"></i>
              </a>

              <!-- <a href="#" class="action__btn" aria-label="Compare">
                <i class="fi fi-rs-shuffle"></i>
              </a> -->
            </div>

            <div class="product__badge light-pink">Hot</div>
          </div>

          <div class="product__content">
            <span class="product__category">Chair</span>
            <a href="#">
              <h3 class="product__title">Single Sofa</h3>
            </a>
            <div class="product__rating">
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
            </div>
            <div class="product__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>

            <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
              <i class="fi fi-rs-shopping-bag-add"></i>
            </a>
          </div>
        </div>

        <div class="product__item swiper-slide">
          <div class="product__banner">
            <a href="#" class="product__images">
              <img src="assets/img/product-img/product-2-1.jpg" alt="" class="product__img default">

              <img src="assets/img/product-img/product-2-2.jpg" alt="" class="product__img hover">
            </a>

            <div class="product__actions">
              <!-- <a href="#" class="action__btn" aria-label="Quick View">
                <i class="fi fi-rs-eye"></i>
              </a> -->

              <a href="#" class="action__btn" aria-label="Wishlist">
                <i class="fi fi-rs-heart"></i>
              </a>

              <!-- <a href="#" class="action__btn" aria-label="Compare">
                <i class="fi fi-rs-shuffle"></i>
              </a> -->
            </div>

            <div class="product__badge light-green">Hot</div>
          </div>

          <div class="product__content">
            <span class="product__category">Chair</span>
            <a href="#">
              <h3 class="product__title">Single Sofa</h3>
            </a>
            <div class="product__rating">
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
            </div>
            <div class="product__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>

            <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
              <i class="fi fi-rs-shopping-bag-add"></i>
            </a>
          </div>
        </div>

        <div class="product__item swiper-slide">
          <div class="product__banner">
            <a href="#" class="product__images">
              <img src="assets/img/product-img/product-3-1.jpg" alt="" class="product__img default">

              <img src="assets/img/product-img/product-3-2.jpg" alt="" class="product__img hover">
            </a>

            <div class="product__actions">
              <!-- <a href="#" class="action__btn" aria-label="Quick View">
                <i class="fi fi-rs-eye"></i>
              </a> -->

              <a href="#" class="action__btn" aria-label="Wishlist">
                <i class="fi fi-rs-heart"></i>
              </a>

              <!-- <a href="#" class="action__btn" aria-label="Compare">
                <i class="fi fi-rs-shuffle"></i>
              </a> -->
            </div>

            <div class="product__badge light-orange">Hot</div>
          </div>

          <div class="product__content">
            <span class="product__category">Chair</span>
            <a href="#">
              <h3 class="product__title">Single Sofa</h3>
            </a>
            <div class="product__rating">
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
            </div>
            <div class="product__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>

            <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
              <i class="fi fi-rs-shopping-bag-add"></i>
            </a>
          </div>
        </div>

        <div class="product__item swiper-slide">
          <div class="product__banner">
            <a href="#" class="product__images">
              <img src="assets/img/product-img/product-4-1.jpg" alt="" class="product__img default">

              <img src="assets/img/product-img/product-4-2.jpg" alt="" class="product__img hover">
            </a>

            <div class="product__actions">
              <!-- <a href="#" class="action__btn" aria-label="Quick View">
                <i class="fi fi-rs-eye"></i>
              </a> -->

              <a href="#" class="action__btn" aria-label="Wishlist">
                <i class="fi fi-rs-heart"></i>
              </a>

              <!-- <a href="#" class="action__btn" aria-label="Compare">
                <i class="fi fi-rs-shuffle"></i>
              </a> -->
            </div>

            <div class="product__badge light-blue">Hot</div>
          </div>

          <div class="product__content">
            <span class="product__category">Chair</span>
            <a href="#">
              <h3 class="product__title">Single Sofa</h3>
            </a>
            <div class="product__rating">
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
            </div>
            <div class="product__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>

            <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
              <i class="fi fi-rs-shopping-bag-add"></i>
            </a>
          </div>
        </div>

        <div class="product__item swiper-slide">
          <div class="product__banner">
            <a href="#" class="product__images">
              <img src="assets/img/product-img/product-5-1.jpg" alt="" class="product__img default">

              <img src="assets/img/product-img/product-5-2.jpg" alt="" class="product__img hover">
            </a>

            <div class="product__actions">
              <!-- <a href="#" class="action__btn" aria-label="Quick View">
                <i class="fi fi-rs-eye"></i>
              </a> -->

              <a href="#" class="action__btn" aria-label="Wishlist">
                <i class="fi fi-rs-heart"></i>
              </a>

              <!-- <a href="#" class="action__btn" aria-label="Compare">
                <i class="fi fi-rs-shuffle"></i>
              </a> -->
            </div>

            <div class="product__badge light-pink">-30%</div>
          </div>

          <div class="product__content">
            <span class="product__category">Chair</span>
            <a href="#">
              <h3 class="product__title">Single Sofa</h3>
            </a>
            <div class="product__rating">
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
            </div>
            <div class="product__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>

            <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
              <i class="fi fi-rs-shopping-bag-add"></i>
            </a>
          </div>
        </div>

        <div class="product__item swiper-slide">
          <div class="product__banner">
            <a href="#" class="product__images">
              <img src="assets/img/product-img/product-6-1.jpg" alt="" class="product__img default">

              <img src="assets/img/product-img/product-6-2.jpg" alt="" class="product__img hover">
            </a>

            <div class="product__actions">
              <!-- <a href="#" class="action__btn" aria-label="Quick View">
                <i class="fi fi-rs-eye"></i>
              </a> -->

              <a href="#" class="action__btn" aria-label="Wishlist">
                <i class="fi fi-rs-heart"></i>
              </a>

              <!-- <a href="#" class="action__btn" aria-label="Compare">
                <i class="fi fi-rs-shuffle"></i>
              </a> -->
            </div>

            <div class="product__badge light-pink">-22%</div>
          </div>

          <div class="product__content">
            <span class="product__category">Chair</span>
            <a href="#">
              <h3 class="product__title">Single Sofa</h3>
            </a>
            <div class="product__rating">
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
            </div>
            <div class="product__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>

            <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
              <i class="fi fi-rs-shopping-bag-add"></i>
            </a>
          </div>
        </div>

        <div class="product__item swiper-slide">
          <div class="product__banner">
            <a href="#" class="product__images">
              <img src="assets/img/product-img/product-7-1.jpg" alt="" class="product__img default">

              <img src="assets/img/product-img/product-7-2.jpg" alt="" class="product__img hover">
            </a>

            <div class="product__actions">
              <!-- <a href="#" class="action__btn" aria-label="Quick View">
                <i class="fi fi-rs-eye"></i>
              </a> -->

              <a href="#" class="action__btn" aria-label="Wishlist">
                <i class="fi fi-rs-heart"></i>
              </a>

              <!-- <a href="#" class="action__btn" aria-label="Compare">
                <i class="fi fi-rs-shuffle"></i>
              </a> -->
            </div>

            <div class="product__badge light-green">Hot</div>
          </div>

          <div class="product__content">
            <span class="product__category">Chair</span>
            <a href="#">
              <h3 class="product__title">Single Sofa</h3>
            </a>
            <div class="product__rating">
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
              <i class="fi fi-rs-star"></i>
            </div>
            <div class="product__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>

            <a href="#" class="action__btn cart__btn" aria-label="Add To Card">
              <i class="fi fi-rs-shopping-bag-add"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="swiper-button-next">
        <i class="fi fi-sr-angle-right"></i>
      </div>
      <div class="swiper-button-prev">
        <i class="fi fi-sr-angle-left"></i>
      </div>
    </div>
  </section>

  <!--=============== SHOWCASE ===============-->
  <section class="showcase section">
    <div class="showcase__container container grid">
      <div class="showcase__wrapper">
        <h3 class="section__title">Hot Releases</h3>

        <div class="showcase__item">
          <a href="#" class="showcase__img-box">
            <img src="assets/img/showcase-img/showcase-img-1.jpg" alt="" class="showcase__img">
          </a>

          <div class="showcase__content">
            <a href="#">
              <h4 class="showcase__title">Multi-color Print</h4>
            </a>

            <div class="showcase__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>
          </div>
        </div>

        <div class="showcase__item">
          <a href="#" class="showcase__img-box">
            <img src="assets/img/showcase-img/showcase-img-2.jpg" alt="" class="showcase__img">
          </a>

          <div class="showcase__content">
            <a href="#">
              <h4 class="showcase__title">Multi-color Print</h4>
            </a>

            <div class="showcase__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>
          </div>
        </div>

        <div class="showcase__item">
          <a href="#" class="showcase__img-box">
            <img src="assets/img/showcase-img/showcase-img-3.jpg" alt="" class="showcase__img">
          </a>

          <div class="showcase__content">
            <a href="#">
              <h4 class="showcase__title">Multi-color Print</h4>
            </a>

            <div class="showcase__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>
          </div>
        </div>
      </div>

      <div class="showcase__wrapper">
        <h3 class="section__title">Deals $ Outlet</h3>

        <div class="showcase__item">
          <a href="#" class="showcase__img-box">
            <img src="assets/img/showcase-img/showcase-img-4.jpg" alt="" class="showcase__img">
          </a>

          <div class="showcase__content">
            <a href="#">
              <h4 class="showcase__title">Multi-color Print</h4>
            </a>

            <div class="showcase__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>
          </div>
        </div>

        <div class="showcase__item">
          <a href="#" class="showcase__img-box">
            <img src="assets/img/showcase-img/showcase-img-5.jpg" alt="" class="showcase__img">
          </a>

          <div class="showcase__content">
            <a href="#">
              <h4 class="showcase__title">Multi-color Print</h4>
            </a>

            <div class="showcase__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>
          </div>
        </div>

        <div class="showcase__item">
          <a href="#" class="showcase__img-box">
            <img src="assets/img/showcase-img/showcase-img-6.jpg" alt="" class="showcase__img">
          </a>

          <div class="showcase__content">
            <a href="#">
              <h4 class="showcase__title">Multi-color Print</h4>
            </a>

            <div class="showcase__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>
          </div>
        </div>
      </div>

      <div class="showcase__wrapper">
        <h3 class="section__title">Top Selling</h3>

        <div class="showcase__item">
          <a href="#" class="showcase__img-box">
            <img src="assets/img/showcase-img/showcase-img-7.jpg" alt="" class="showcase__img">
          </a>

          <div class="showcase__content">
            <a href="#">
              <h4 class="showcase__title">Multi-color Print</h4>
            </a>

            <div class="showcase__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>
          </div>
        </div>

        <div class="showcase__item">
          <a href="#" class="showcase__img-box">
            <img src="assets/img/showcase-img/showcase-img-8.jpg" alt="" class="showcase__img">
          </a>

          <div class="showcase__content">
            <a href="#">
              <h4 class="showcase__title">Multi-color Print</h4>
            </a>

            <div class="showcase__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>
          </div>
        </div>

        <div class="showcase__item">
          <a href="#" class="showcase__img-box">
            <img src="assets/img/showcase-img/showcase-img-9.jpg" alt="" class="showcase__img">
          </a>

          <div class="showcase__content">
            <a href="#">
              <h4 class="showcase__title">Multi-color Print</h4>
            </a>

            <div class="showcase__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>
          </div>
        </div>
      </div>

      <div class="showcase__wrapper">
        <h3 class="section__title">Trendy</h3>

        <div class="showcase__item">
          <a href="#" class="showcase__img-box">
            <img src="assets/img/showcase-img/showcase-img-1.jpg" alt="" class="showcase__img">
          </a>

          <div class="showcase__content">
            <a href="#">
              <h4 class="showcase__title">Multi-color Print</h4>
            </a>

            <div class="showcase__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>
          </div>
        </div>

        <div class="showcase__item">
          <a href="#" class="showcase__img-box">
            <img src="assets/img/showcase-img/showcase-img-2.jpg" alt="" class="showcase__img">
          </a>

          <div class="showcase__content">
            <a href="#">
              <h4 class="showcase__title">Multi-color Print</h4>
            </a>

            <div class="showcase__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>
          </div>
        </div>

        <div class="showcase__item">
          <a href="#" class="showcase__img-box">
            <img src="assets/img/showcase-img/showcase-img-3.jpg" alt="" class="showcase__img">
          </a>

          <div class="showcase__content">
            <a href="#">
              <h4 class="showcase__title">Multi-color Print</h4>
            </a>

            <div class="showcase__price flex">
              <span class="new__price">$238.85</span>
              <span class="old__price">$245.8</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--=============== NEWSLETTER ===============-->
  <section class="newsletter section home__newsletter">
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