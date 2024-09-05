<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['send'])){

   $tensv = $_POST['tensv'];
   $tensv = filter_var($tensv, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `message` WHERE tensv = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$tensv, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'Đã gửi tin nhắn!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `message`(user_id, tensv, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $tensv, $email, $number, $msg]);

      $message[] = 'Gửi đánh giá thành công!';

   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Liên hệ</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>




   <div class="login" >
   <form action="" method="POST"  >
   <h1 class="title">Thông tin liên hệ</h1>
      <input type="text" value="<?= $fetch_profile['tensv']; ?>" name="tensv" class="box" required placeholder="Nhập tên của bạn">
      <input type="email"  value="<?= $fetch_profile['email']; ?>" name="email" class="box" required placeholder="Nhập email của bạn">
      <input type="text" name="number" min="0" class="box" required placeholder="Nhập số điện thoại của bạn">
      <textarea type="text" name="msg" class="box" required placeholder="Nhập nội dung" cols="30" rows="10"></textarea>
      <input type="submit" value="Gửi" class="btn" name="send">
   </form>


</div>
<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>