<?php
@include 'config.php';
session_start();

if(isset($_POST['submit_rating'])){
   $rating = $_POST['rating'];
   $order_id = $_POST['order_id'];

   
   if($rating >= 1 && $rating <= 5){
      
      $update_rating = $conn->prepare("UPDATE `orders` SET `rating` = ? WHERE `id` = ?");
      $update_rating->execute([$rating, $order_id]);

      
      header('location:orders.php');
   } else {
      echo "Invalid rating!";
   }
}
?>
