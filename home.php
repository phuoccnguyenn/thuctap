<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/logo.png">
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <title>Trang chủ</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>


   
<?php @include 'header.php'; ?>

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block" style="display:none;z-index:5" id="mySidebar">
  <button class="w3-bar-item w3-button w3-xxlarge" onclick="w3_close()">Trang chủ </button>
      <a href="#" class="w3-bar-item w3-button">Thời khóa biểu sinh viên</a> 
      <a href="#" class="w3-bar-item w3-button">Học phí trong học kỳ </a>
      <a href="#" class="w3-bar-item w3-button">Học phí học ngoại ngữ</a>
</div>

<!-- Đen phía dưới -->
<div class="w3-overlay" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

<!-- 
<div class="home"> -->

<button class="w3-button w3-white w3-xxlarge" onclick="w3_open()">&#9776;</button>    
<div style="padding-top: 500px;"></div>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
 
</body>

</html>