<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM cart WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{
      $insert_cart = $conn->prepare("INSERT INTO cart(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'added to cart!';
   }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Medications</title>
   <link rel="stylesheet" href="css/style2.css">
   <link rel="stylesheet" href="css/product.css">


</head>
<body>
<?php include('header.php') ?>
<section class="medications-category">
      <h2 class="medications-category-title">Categories</h2>
      <div class="medications-category-links">
         <a href="category.php?category=Supplements" class="medications-category-link">Supplements</a>
         <a href="category.php?category=Skincare" class="medications-category-link">Skincare</a>
         <a href="category.php?category=Medical Equipment" class="medications-category-link">Medical Equipment</a>
         <a href="category.php?category=Vitamins" class="medications-category-link">Vitamins</a>
         <a href="category.php?category=personal care" class="medications-category-link">personal care</a>
         <a href="category.php?category=Health medicine" class="medications-category-link">Health medicine</a>
         <a href="category.php?category=baby care" class="medications-category-link">baby care</a>
         <a href="category.php?category=Medications" class="medications-category-link">Medications</a>
      </div>
   </section>

   <section class="medications-products">
      <h1 class="medications-products-title">Latest Medications</h1>
      <div class="medications-products-container">
         <?php
            $select_products = $conn->prepare("SELECT * FROM products");
            $select_products->execute();
            if($select_products->rowCount() > 0){
               while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
         ?>
         <form action="" class="medications-product-box" method="POST">
            <div class="medications-product-price">$<span><?= $fetch_products['price']; ?></span></div>
            <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="medications-product-view fas fa-eye"></a>
            <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="" class="medications-product-image">
            <div class="medications-product-name"><?= $fetch_products['name']; ?></div>
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
            <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
            <input type="number" min="1" value="1" name="p_qty" class="medications-product-qty">
            <input type="submit" value="Add to Wishlist" class="medications-option-btn" name="add_to_wishlist">
            <input type="submit" value="Add to Cart" class="medications-add-btn" name="add_to_cart">
         </form>
         <?php
            }
         }else{
            echo '<p class="medications-empty">No medications added yet!</p>';
         }
         ?>
      </div>
   </section>
   <?php include 'footer.php'; ?>

<script src="js/script.js"></script>
<script src="./js/header.js" ></script>

</body>
</html>








