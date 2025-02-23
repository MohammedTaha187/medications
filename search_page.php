<?php
include 'check_login.php'; 
@include 'config.php';

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search Page</title>

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="./css/style2.css">
   <link rel="stylesheet" href="./css/search_page.css">

</head>
<body>

<?php include 'header.php'; ?>



<section class="products" style="padding-top: 0; min-height:100vh;">
   <div class="box-container">
   <?php
      if(isset($_GET['search_box'])){
         $search_box = $_GET['search_box'];
         $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
         
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE ? OR category LIKE ?");
         $select_products->execute(["%$search_box%", "%$search_box%"]);

         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="cart.php" class="box" method="POST">
      <div class="price">$<span><?= htmlspecialchars($fetch_products['price']); ?></span>/-</div>
      <a href="view_page.php?pid=<?= htmlspecialchars($fetch_products['id']); ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= htmlspecialchars($fetch_products['image']); ?>" alt="">
      <div class="name"> <?= htmlspecialchars($fetch_products['name']); ?> </div>
      <input type="hidden" name="pid" value="<?= htmlspecialchars($fetch_products['id']); ?>">
      <input type="hidden" name="p_name" value="<?= htmlspecialchars($fetch_products['name']); ?>">
      <input type="hidden" name="p_price" value="<?= htmlspecialchars($fetch_products['price']); ?>">
      <input type="hidden" name="p_image" value="<?= htmlspecialchars($fetch_products['image']); ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="Add to Cart" class="btn" name="add_to_cart">
   </form>
   <?php
            }
         }else{
            echo '<p class="empty">No results found!</p>';
         }
      }
   ?>
   </div>
</section>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>
<script src="./js/header.js" ></script>
</body>
</html>