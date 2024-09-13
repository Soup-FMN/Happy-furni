<?php
// include "admin/database.php";
include "admin/class/product_class.php";
include "class/review_class.php";
?>
<?php
$product = new product;
$product_id = $_GET['product_id'];
$review = new review;
$get_product_only = $product->get_product_only($product_id);
$anhgoc = $product->get_product_img($product_id);
$get_product_img = $product->get_product_img($product_id);
$get_product_img_desc = $product->get_product_img_desc($product_id);

$show_review = $review->show_review($product_id);
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
      <li><span class="breadcrumb__link">Details</span></li>
    </ul>
  </section>

  <!--=============== DETAILS ===============-->
  <section class="details section--lg">
    <div class="details__container container grid">
      <div class="details__group">
        <?php
        if ($get_product_img) {
          $i = 0;
          while ($result = $get_product_img->fetch_assoc()) {
            $i++;
        ?>
            <img src="<?php echo "admin/uploads/" . $result['product_img'] ?>" alt="" class="details__img">
        <?php
          }
        }
        ?>

        <div class="details__small-images grid">
          <?php
          if ($anhgoc) {
            $j = 0;
            while ($result = $anhgoc->fetch_assoc()) {
              $j++;
          ?>
              <img src="<?php echo "admin/uploads/" . $result['product_img'] ?>" alt="" class="details__small-img">
          <?php
            }
          }
          ?>
          <?php
          if ($get_product_img_desc) {
            $h = 0;
            while ($result = $get_product_img_desc->fetch_assoc()) {
              $h++;
          ?>
              <img src="<?php echo "admin/uploads/" . $result['product_img_desc'] ?>" alt="" class="details__small-img" />
          <?php
            }
          }
          ?>

        </div>
      </div>

      <div class="details__group">
        <?php
        if ($get_product_only) {
          $result = $get_product_only->fetch_assoc();
        ?>
          <h3 class="details__title"><?php echo $result['product_name'] ?></h3>
          <p class="details__brand">Brands: <span>Newyork</span></p>

          <div class="details__price flex">
            <span class="new__price">$<?php echo $result['product_price_new'] ?></span>
            <span class="old__price">$<?php echo $result['product_price'] ?></span>
            <span class="save__price">25% Off</span>
          </div>

          <p class="short__description">
            <?php echo $result['product_desc'] ?>
          </p>

          <ul class="product__list">
            <li class="list__item flex">
              <i class="fi-rs-crown"></i> 1 Year Al Jazeera Brand Warranty
            </li>

            <li class="list__item flex">
              <i class="fi-rs-refresh"></i> 30 Days Return Policy
            </li>

            <li class="list__item flex">
              <i class="fi-rs-credit-card"></i> Cash on Delivery available
            </li>
          </ul>

          <div class="details__color flex">
            <span class="details__color-title">Color</span>

            <ul class="color__list">
              <li>
                <a href="#" class="color__link" style="background-color: yellow;"></a>
              </li>

              <li>
                <a href="#" class="color__link" style="background-color: red;"></a>
              </li>

              <li>
                <a href="#" class="color__link" style="background-color: blue;"></a>
              </li>
            </ul>
          </div>

          <div class="details__size flex">
            <span class="details__size-title">Size</span>

            <ul class="size__list">
              <li>
                <a href="#" class="size__link size-active">83x83x82 Cm</a>
              </li>

              <!-- <li>
                  <a href="#" class="size__link size">85x85x87 Cm</a>
                </li> -->

              <!-- <li>
                  <a href="#" class="size__link size">XL</a>
                </li>

                <li>
                  <a href="#" class="size__link size">XXL</a>
                </li> -->
            </ul>
          </div>

          <div class="details__action">
            <!-- <input type="number" class="quantity" value="3"> -->

            <a href="components/cart/cart_insert.php?product_id=<?php echo $result['product_id'] ?>" class="btn btn--sm">Add to Cart</a>

            <a href="#" class="details__action-btn">
              <i class="fi fi-rs-heart"></i>
            </a>
          </div>
        <?php } ?>
        <ul class="details__meta">
          <li class="meta__list flex"><span>SKU:</span> FWM15VKT</li>
          <li class="meta__list flex"><span>Tags:</span> Decor</li>
          <li class="meta__list flex"><span>Availability:</span> 8 Items In Stock</li>
        </ul>
      </div>
    </div>
  </section>

  <!--=============== DETAILS TAB ===============-->
  <section class="details__tab container">
    <div class="detail__tabs">
      <span class="detail__tab active-tab" data-target="#info">
        Additional Info
      </span>
      <span class="detail__tab" data-target="#reviews">Reviews</span>
    </div>

    <div class="details__tabs-content">
      <div class="details__tab-content active-tab" content id="info">
        <table class="info__table">
          <tr>
            <th>Description</th>
            <td>
              <?php echo $result['product_desc'] ?>
            </td>
          </tr>

          <tr>
            <th>Heavy</th>
            <td>20 Kg</td>
          </tr>

          <tr>
            <th>Color</th>
            <td>Red, Blue, Yellow, Black</td>
          </tr>

          <tr>
            <th>Size</th>
            <td>83x83x82 Cm</td>
          </tr>
        </table>
      </div>

      <div class="details__tab-content" content id="reviews">
        <div class="reviews__container grid">
          <div class="review__single">
            <div>
              <img src="assets/img/avatar-2.jpg" alt="" class="review__img">
              <h4 class="review__title">Jocky Chan</h4>
            </div>

            <div class="review__data">
              <div class="review__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>

              <p class="review__description">Great low price and works well.</p>

              <span class="review__date">Saturday, May 4, 2024 at 3:33 pm</span>
            </div>
          </div>

          <div class="review__single">
            <div>
              <img src="assets/img/avatar-3.jpg" alt="" class="review__img">
              <h4 class="review__title">Jocky Chan</h4>
            </div>

            <div class="review__data">
              <div class="review__rating">
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
                <i class="fi fi-rs-star"></i>
              </div>

              <p class="review__description">Authentic and Beautiful. Love these way more than ever expected. They are Great earphones.</p>

              <span class="review__date">Saturday, May 4, 2024 at 3:33 pm</span>
            </div>
          </div>
          <?php
          if ($show_review) {
            $i = 0;
            while ($result = $show_review->fetch_assoc()) {
              $i++;
          ?>
              <div class="review__single">
                <div>
                  <img src="assets/img/avatar-1.jpg" alt="" class="review__img">
                  <h4 class="review__title" style=""><?php echo $result['name'] ?></h4>
                </div>

                <div class="review__data">
                  <div class="review__rating">
                    <i class="fi fi-rs-star"></i>
                    <i class="fi fi-rs-star"></i>
                    <i class="fi fi-rs-star"></i>
                    <i class="fi fi-rs-star"></i>
                    <i class="fi fi-rs-star"></i>
                  </div>

                  <p class="review__description"><?php echo $result['review_data'] ?></p>

                  <span class="review__date">Saturday, May 4, 2024 at 3:33 pm</span>
                </div>
              </div>
          <?php }
          } ?>

        </div>

        <div class="review__form">
          <h4 class="review__form-title">Add a review</h4>

          <div class="rate__product">
            <i class="fi fi-rs-star"></i>
            <i class="fi fi-rs-star"></i>
            <i class="fi fi-rs-star"></i>
            <i class="fi fi-rs-star"></i>
            <i class="fi fi-rs-star"></i>
          </div>

          <form method="POST" action="components/review/review_insert.php" class="form grid">
            <textarea name="review_data" class="form__input textarea" placeholder="Write Comment ..."></textarea>
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <!-- <div action="" class="form__group grid">
              <input type="text" placeholder="Name" class="form__input">

              <input type="email" placeholder="Email" class="form__input">
            </div> -->

            <div class="form__btn">
              <button class="btn">Submit Review</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!--=============== PRODUCTS ===============-->
  <section class="products container section--lg">
    <h3 class="section__title"><span>Related</span> Products</h3>

    <div class="products__container grid">
      <div class="product__item">
        <div class="product__banner">
          <a href="details.html" class="product__images">
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
          <a href="details.html">
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
          <a href="details.html" class="product__images">
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
          <a href="details.html">
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
          <a href="details.html" class="product__images">
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
          <a href="details.html">
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
          <a href="details.html" class="product__images">
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
          <a href="details.html">
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