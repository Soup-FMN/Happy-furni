<?php
session_start();
// include "../admin/database.php";
include "admin/class/user_class.php";
include "count_class.php";
?>

<?php
if (!isset($_SESSION["email"]) || $_SESSION["email"] == NULL) {
  $checkLog = false;
} else {
  $checkLog = true;
  $id = $_SESSION["id"];
  $email = $_SESSION["email"];
  $name = $_SESSION["name"];
  $role = $_SESSION["role"];
  $user = new user;
  $count = new count;

  // $get_user_by_email = $user->get_user_by_email($email);
  // $row = mysqli_fetch_assoc($get_user_by_email);

  //Count
  $cart_status = mysqli_fetch_assoc($count->count_cart($id));
  $wishlist_status = mysqli_fetch_assoc($count->count_wishlist($id));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!--=============== FLATICON ===============-->
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-regular-straight/css/uicons-regular-straight.css'>

  <!--=============== SWIPER CSS ===============-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!--=============== CSS ===============-->
  <link rel="stylesheet" href="assets/css/styles.css" />

  <title>🛋 Happy Furni 🛋</title>
</head>

<body>
  <!--=============== HEADER ===============-->
  <header class="header">
    <div class="header__top">
      <div class="header__container container">
        <div class="header__contact">
          <span>20201094</span>

          <span>Le Trung Dat</span>
        </div>
        <p class="header__alert-news">
          Super Value Deals - Save more with coupons
        </p>

        <a href="/PHP/happy-furni-php/layouts/checkrole.php" class="header__top-action">
          Admin Page
        </a>
      </div>
    </div>

    <nav class="nav container">
      <a href="index.php?brand_id=37" class="nav__logo">
        <img src="assets/img/logo.png" alt="" class="nav__logo-img">
      </a>

      <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
          <li class="nav__item">
            <a href="index.php?brand_id=37" class="nav__link active-link">Home</a>
          </li>

          <li class="nav__item">
            <a href="index.php?page=shop&category_id=93" class="nav__link">Shop</a>
          </li>

          <!-- <li class="nav__item">
            <a href="index.php?page=compare" class="nav__link">Compare</a>
          </li> -->
          <div>
            <?php
            if ($checkLog == false) { ?>
              <li class="nav__item">
                <a href="index.php?page=login-register" class="nav__link">Login</a>
              </li>

            <?php } else { ?>
              <li class="nav__item">
                <a href="index.php?page=accounts" class="nav__link">My Account</a>
              </li>
            <?php } ?>
          </div>


        </ul>
        <div class="header__search">
          <input type="text" placeholder="Search for item..." class="form__input">

          <button class="search__btn">
            <img src="assets/img/search.png" alt="">
          </button>
        </div>
      </div>

      <div class="header__user-actions">
        <a href="index.php?page=wishlist" class="header__action-btn">
          <img src="assets/img/icon-heart.svg" alt="">
          <span class="count">
          <?php if ($checkLog) {
              echo $wishlist_status['number'];
            } else {
              echo "0";
            } ?>
          </span>
        </a>

        <a href="index.php?page=cart" class="header__action-btn">
          <img src="assets/img/icon-cart.svg" alt="">
          <span class="count">
          <?php if ($checkLog) {
              echo $cart_status['number'];
            } else {
              echo "0";
            } ?>
          </span>
        </a>
      </div>
    </nav>
  </header>