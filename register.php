<?php

include 'config.php';

if(isset($_POST['submit'])){

   $tensv = $_POST['tensv'];
   $tensv = filter_var($tensv, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = $_POST['cpass'];
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   // $row = 'admin';

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'Email này đã được sử dụng !';
   }else{
      if($pass != $cpass){
         $message[] = 'Xác nhận mật khẩu không khớp!';
      }else{
         $insert = $conn->prepare("INSERT INTO `users`(tensv, email, password, user_type , image) VALUES(?,?,?,?,?)");
         $user_type = 'admin';
         $insert->execute([$tensv, $email, $pass, $user_type, $image]);


         if($insert){
            if($image_size > 2000000){
               $message[] = 'Ảnh đại diện quá lớn!';
            }else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'Đăng ký thành công!';
               header('location:login.php');
            }
         }

      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng ký  admin</title>

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
<form action="" enctype="multipart/form-data" method="POST">
      <h3>Đăng ký Admin</h3>
      <input type="text" name="name" class="box" placeholder="Nhập tên của bạn" required>
      <input type="email" name="email" class="box" placeholder="Nhập email của bạn" required>
      <div class="hidden-show">
            <input type="password" name="pass"  id="pass" class="box" placeholder="Nhập mật khẩu của bạn" required>
            <span><img src="images/eye.png" alt="" width="30" onclick="showHidden()"/></span>       
      </div>        
      <div class="hidden-show">
            <input type="password" name="cpass"  id="cpass"  class="box" placeholder="Nhập lại mật khẩu" required>
            <span><img src="images/eye.png" alt="" width="30" onclick="showHidden2()"/></span>
      </div> 
      <input type="file" name="image"  class="box" required accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="Đăng ký " class="btn" name="submit">
      <p>Tạo tài khoản mới? <a href="login.php">Đăng nhập </a></p>
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
   <script >
      isBool =true;
      function showHidden2(){
            if(isBool){
               document.getElementById("cpass").setAttribute("type","text");
               isBool = false;
            }else{
               document.getElementById("cpass").setAttribute("type","password");
               isBool = true;

            }
      }
   </script>



            
</body>
</html>