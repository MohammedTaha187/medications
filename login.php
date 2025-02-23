<?php
@include 'config.php';

if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   // Use password_verify for hashed passwords
   $sql = "SELECT * FROM `users` WHERE email = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email]);
   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($row && password_verify($pass, $row['password'])){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }else{
         $message[] = 'No user found!';
      }

   }else{
      $message[] = 'Incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pharmacy Login</title>

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="./css/style2.css">
   <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('./img/login.png'); 
            background-size: cover; 
            background-position: center; 
            height: 100vh;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px; 
            padding: 20px;
            max-width: 400px; 
            margin: auto; 
            position: relative;
            top: 50%; 
            transform: translateY(-50%); 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); 
        }
    </style>

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
<div class="login-container">
   <form action="" method="POST">
      <h3>Login to Pharmacy</h3>
      <input type="email" name="email" class="box" placeholder="Enter your email" required>
      <input type="password" name="pass" class="box" placeholder="Enter your password" required>
      <input type="submit" value="Login Now" class="btn" name="submit">
      <p>Don't have an account? <a href="register.php">Register now</a></p>
   </form>
</div>


</body>
</html>
