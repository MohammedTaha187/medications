<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_messages->execute([$delete_id]);
   header('location:admin_contacts.php');
}

if(isset($_POST['respond'])){
   $messages_id = $_POST['messages_id'];
   $response = filter_var($_POST['response'], FILTER_SANITIZE_STRING);

   $update_response = $conn->prepare("UPDATE `messages` SET `response` = ? WHERE id = ?");
   $update_response->execute([$response, $messages_id]);

   header('location:admin_contacts.php');  // إعادة التوجيه بعد الرد
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messagess</title>

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
      $select_messages = $conn->prepare("SELECT * FROM `messages`");
      $select_messages->execute();
      if($select_messages->rowCount() > 0){
         while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> user id : <span><?= $fetch_messages['user_id']; ?></span> </p>
      <p> name : <span><?= $fetch_messages['name']; ?></span> </p>
      <p> number : <span><?= $fetch_messages['number']; ?></span> </p>
      <p> email : <span><?= $fetch_messages['email']; ?></span> </p>
      <p> messages : <span><?= $fetch_messages['message']; ?></span> </p>

      <!-- الرد على الرسالة -->
      <?php if(empty($fetch_messages['response'])): ?>
         <form action="" method="POST">
            <textarea name="response" placeholder="Write your response here" required></textarea>
            <input type="hidden" name="messages_id" value="<?= $fetch_messages['id']; ?>">
            <button type="submit" name="respond" class="btn">Respond</button>
         </form>
      <?php else: ?>
         <p>Response: <span><?= $fetch_messages['response']; ?></span></p>
      <?php endif; ?>

      <a href="admin_contacts.php?delete=<?= $fetch_messages['id']; ?>" onclick="return confirm('delete this messages?');" class="delete-btn">delete</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">you have no messagess!</p>';
      }
   ?>

   </div>

</section>
<script src="js/script.js"></script>
<script src="./js/header.js" ></script>

</body>
</html>
