<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($rowCount > 0){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }else{
         $message[] = 'Không tìm thấy người dùng!';
      }

   }else{
      $message[] = 'Email hoặc mật khẩu không chính xác!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng nhập</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/components.css">

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>
   

   <div class="login">
      <form action="" method="POST">
      <h3>ĐĂNG NHẬP</h3>
      <input type="email" name="email" class="box" placeholder="Nhập email của bạn" required>
      <div class="hidden-show">
         <input type="password" name="pass" id="pass" class="box" placeholder="Nhập mật khẩu của bạn" required>
         <span><img src="images/eye.png" alt="" width="30" onclick="showHidden()"/></span>
      </div>
      <input type="submit" value="Đăng nhập " class="btn" name="submit">
      <!-- <p>Bạn chưa có tài khoản? <a href="register.php">Đăng ký </a></p> -->
      </form>
   </div>
   <style>
      
      span{
        display:block;
        position: absolute;
        right: 10px;
         top: 17px;
      }
      span img {
         cursor:pointer;
      }
      .hidden-show{
         position: relative;
      }
   </style>
   <script >
      isBool =true;
      function showHidden(){
            if(isBool){
               document.getElementById("pass").setAttribute("type","text");
               isBool = false;
            }else{
               document.getElementById("pass").setAttribute("type","password");
               isBool = true;

            }
      }
   </script>




</body>
</html>