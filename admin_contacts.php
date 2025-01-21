<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:admin_contacts.php');
}

if(isset($_POST['respond'])){
   $message_id = $_POST['message_id'];
   $response = filter_var($_POST['response'], FILTER_SANITIZE_STRING);

   $update_response = $conn->prepare("UPDATE `message` SET `response` = ? WHERE id = ?");
   $update_response->execute([$response, $message_id]);

   header('location:admin_contacts.php');  // إعادة التوجيه بعد الرد
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/admin/admin_contacts.css">
   <link rel="stylesheet" href="./css/admin/admin_header.css">

   <style>
        body {
            background-image: url('css/3.jpg');
            background-size: cover;
        }
    </style>

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">messages</h1>

   <div class="box-container">

   <?php
      $select_message = $conn->prepare("SELECT * FROM `message`");
      $select_message->execute();
      if($select_message->rowCount() > 0){
         while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> user id : <span><?= $fetch_message['user_id']; ?></span> </p>
      <p> name : <span><?= $fetch_message['name']; ?></span> </p>
      <p> number : <span><?= $fetch_message['number']; ?></span> </p>
      <p> email : <span><?= $fetch_message['email']; ?></span> </p>
      <p> message : <span><?= $fetch_message['message']; ?></span> </p>

      <!-- الرد على الرسالة -->
      <?php if(empty($fetch_message['response'])): ?>
         <form action="" method="POST">
            <textarea name="response" placeholder="Write your response here" required></textarea>
            <input type="hidden" name="message_id" value="<?= $fetch_message['id']; ?>">
            <button type="submit" name="respond" class="btn">Respond</button>
         </form>
      <?php else: ?>
         <p>Response: <span><?= $fetch_message['response']; ?></span></p>
      <?php endif; ?>

      <a href="admin_contacts.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">you have no messages!</p>';
      }
   ?>

   </div>

</section>
<script src="js/script.js"></script>
<script src="./js/header.js" ></script>

</body>
</html>
