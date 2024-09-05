

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">
         <img src="images/logo.png" alt="logo lỗi" width="100" height="100">   
      </a>
      <nav class="navbar">
         <a href="admin_page.php">Trang chủ</a>
         <a href="admin_users.php">Tổng tài khoản</a>
         <a href="admin_sumadmin.php">Tổng admin</a>
         <a href="admin_sumusers.php">Tổng user</a>
         <a href="admin_contacts.php">Phản hồi</a>
         <a href="register.php">ĐK admin</a>
         <a href="register_sv.php">ĐK user</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['tensv']; ?></p>
         <a href="admin_update_profile.php" class="btn">Cập nhật thông tin</a>
         <a href="logout.php" class="delete-btn">Đăng xuất</a>

      </div>

   </div>

</header>