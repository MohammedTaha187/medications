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

// حساب عدد المنتجات في السلة
$user_id = $_SESSION['user_id'];
$cart_count = $conn->prepare("SELECT COUNT(*) FROM `cart` WHERE user_id = ?");
$cart_count->execute([$user_id]);
$count = $cart_count->fetchColumn();

?>
<header class="header">
   <div class="flex">
      <nav class="navbar">
         <a href="home.php">Pharmacy</a>
         <a href="medications.php">Medications</a>
         <a href="orders.php">Orders</a>
         <a href="about.php">About</a>
         <a href="contact.php">Contact</a>
      </nav>

      <div class="icons">
         <div id="user-btn" class="fas fa-user"></div>
         <a href="cart.php">
            <i class="fas fa-shopping-cart"></i>
            <span><?php echo $count; ?></span> <!-- عرض عدد المنتجات هنا -->
         </a>
      </div>

      <div class="profile">
         <img src="uploaded_img/" alt="">
         <p>Welcome, User!</p>
         <a href="user_profile_update.php" class="btn">Update Profile</a>
         <a href="logout.php" class="delete-btn">Logout</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">Login</a>
            <a href="register.php" class="option-btn">Register</a>
         </div>
      </div>
   </div>
</header>
