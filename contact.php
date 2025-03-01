<?php
include 'check_login.php'; 
@include 'config.php';

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

if(isset($_POST['send'])){
   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
   $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
   $msg = filter_var($_POST['msg'], FILTER_SANITIZE_STRING);

   $select_messages = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_messages->execute([$name, $email, $number, $msg]);

   if($select_messages->rowCount() > 0){
      $message[] = 'تم إرسال الرسالة مسبقًا!';
   }else{
      $insert_messages = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_messages->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'تم إرسال الرسالة بنجاح!';
   }
}

// استرجاع الرسائل والردود
$select_messages_response = $conn->prepare("SELECT * FROM `messages` WHERE user_id = ? ORDER BY id DESC LIMIT 1");
$select_messages_response->execute([$user_id]);
$fetch_messages = $select_messages_response->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>

   <link rel="stylesheet" href="css/style2.css">
   <link rel="stylesheet" href="css/contact.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="contact">
   <h1 class="title">Get in Touch</h1>

   <?php
   if(isset($message) && is_array($message)){
      foreach($message as $msg){
         echo '<div class="message">'.$msg.'</div>';
      }
   }
   ?>

   <form action="" method="POST">
      <input type="text" name="name" class="box" required placeholder="Enter your name">
      <input type="email" name="email" class="box" required placeholder="Enter your email">
      <input type="number" name="number" min="0" class="box" required placeholder="Enter your number">
      <textarea name="msg" class="box" required placeholder="Enter your message" cols="30" rows="10"></textarea>
      <input type="submit" value="Send Message" class="btn" name="send">
   </form>

   <!-- عرض الرد في حال وجوده -->
   <?php if(isset($fetch_messages['response']) && !empty($fetch_messages['response'])): ?>
      <div class="response">
         <h2>Admin's Response:</h2>
         <p><?= htmlspecialchars($fetch_messages['response']); ?></p>
      </div>
   <?php endif; ?>

</section>
<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
<script src="./js/header.js"></script>

</body>
</html>
