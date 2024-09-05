
<header class="header">

   <div class="flex">

      <a href="home.php" class="logo">
      <img src="images/logo.png" alt="logo lỗi" width="100" height="100">   
      </a>

      <nav class="navbar">
         <a href="home.php">Trang chủ</a>
         <a href="about.php">Giới thiệu</a>
         <a href="contact.php">Liên hệ</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php" class="fas fa-search"></a>
         <div id="user-btn" class="fas fa-user"></div>
         
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
         ?>

      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['tensv']; ?></p>
         <a href="user_profile_update.php" class="btn">Cập nhật hồ sơ</a>
         <a href="logout.php" class="delete-btn">Đăng xuất</a>

      </div>

   </div>

</header>