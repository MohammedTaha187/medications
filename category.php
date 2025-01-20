<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid = filter_var($_POST['pid'], FILTER_SANITIZE_STRING);
    $p_name = filter_var($_POST['p_name'], FILTER_SANITIZE_STRING);
    $p_price = filter_var($_POST['p_price'], FILTER_SANITIZE_STRING);
    $p_image = filter_var($_POST['p_image'], FILTER_SANITIZE_STRING);

    if (isset($_POST['add_to_cart'])) {
        $p_qty = filter_var($_POST['p_qty'], FILTER_SANITIZE_STRING);
        handleCart($conn, $user_id, $pid, $p_name, $p_price, $p_image, $p_qty);
    }
}
function handleCart($conn, $user_id, $pid, $p_name, $p_price, $p_image, $p_qty)
{
    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
    $check_cart->execute([$p_name, $user_id]);

    if ($check_cart->rowCount() > 0) {
        $GLOBALS['message'][] = 'Already added to cart!';
    } else {
        $check_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
        $check_wishlist->execute([$p_name, $user_id]);

        if ($check_wishlist->rowCount() > 0) {
            $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
            $delete_wishlist->execute([$p_name, $user_id]);
        }

        $add_to_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
        $add_to_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
        $GLOBALS['message'][] = 'Added to cart!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/category.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <section class="products">
        <h1 class="title">Products Categories</h1>
        <div class="box-container">
            <?php
            $category_name = filter_var($_GET['category'], FILTER_SANITIZE_STRING);
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
            $select_products->execute([$category_name]);

            if ($select_products->rowCount() > 0) {
                while ($product = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <form action="" class="box" method="POST">
                        <div class="price">$<span><?= $product['price']; ?></span></div>
                        <a href="view_page.php?pid=<?= $product['id']; ?>" class="fas fa-eye"></a>
                        <img src="uploaded_img/<?= $product['image']; ?>" alt="Product Image">
                        <div class="name"><?= $product['name']; ?></div>
                        <input type="hidden" name="pid" value="<?= $product['id']; ?>">
                        <input type="hidden" name="p_name" value="<?= $product['name']; ?>">
                        <input type="hidden" name="p_price" value="<?= $product['price']; ?>">
                        <input type="hidden" name="p_image" value="<?= $product['image']; ?>">
                        <input type="number" name="p_qty" class="qty" min="1" max="100" value="1">
                        <input type="submit" value="Add to Wishlist" class="option-btn" name="add_to_wishlist">
                        <input type="submit" value="Add to Cart" class="btn" name="add_to_cart">
                    </form>
            <?php
                }
            } else {
                echo '<p class="empty">No products available!</p>';
            }
            ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <script src="js/script.js"></script>
    <script src="./js/header.js" ></script>


</body>

</html>
