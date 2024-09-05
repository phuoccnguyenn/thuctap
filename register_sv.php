<?php

include 'config.php';

if(isset($_POST['submit'])){

   $tensv = $_POST['tensv'];
   $tensv = filter_var($tensv, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   $mssv = $_POST['mssv'];
   $mssv = filter_var($mssv, FILTER_SANITIZE_STRING);
   $cccd = $_POST['cccd'];
   $cccd = filter_var($cccd, FILTER_SANITIZE_STRING);
   $lop = $_POST['lop'];
   $lop = filter_var($lop, FILTER_SANITIZE_STRING);
   $khoa = $_POST['khoa'];
   $khoa = filter_var($khoa, FILTER_SANITIZE_STRING);
   $namhoc = $_POST['namhoc'];
   $namhoc = filter_var($namhoc, FILTER_SANITIZE_STRING);

   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = $_POST['cpass'];
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

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
         $insert = $conn->prepare("INSERT INTO `users`(tensv, mssv,cccd,lop,khoa,namhoc, email, password, image,user_type) VALUES(?,?,?,?,?,?,?,?,?,?)");
         $user_type = 'user';
         $insert->execute([$tensv,$mssv,$cccd, $lop,$khoa, $namhoc, $email, $pass, $image,$user_type]);

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
   <title>Đăng ký sinh viên</title>

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
      <h3>Đăng ký Sinh viên</h3> 
      <input type="text" name="tensv" class="box" placeholder="Nhập tên của bạn" required>
      <input type="email" name="email" class="box" placeholder="Nhập email của bạn" required>
      <input type="text" name="mssv" class="box" placeholder="Nhập mã sinh viên của bạn" required>
      <input type="text" name="cccd" class="box" placeholder="Nhập căn cước công dân của bạn" required>
      <input type="text" name="lop" class="box" placeholder="Nhập lớp của bạn" required>
      <input type="text" name="khoa" class="box" placeholder="Nhập khóa của bạn" required>
      <input type="text" name="namhoc" class="box" placeholder="Nhập năm học của bạn" required>

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