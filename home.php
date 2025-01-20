<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Pharmacy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <?php include('header.php') ?>

   <div class="background-section">
    <div class="title">Online Pharmacy</div>

    <div class="search-bar">
        <input type="text" placeholder="Search for products...">
        <button>Search</button>
    </div>

    <div class="discover">
        <p>Discover a wide range of medicines and health products.</p>
        <a href="#" class="btn">Shop New</a>
    </div>
</div>
<div class="bubble bubble1"></div>
    <div class="bubble bubble2"></div>
    <div class="bubble bubble3"></div>


    <div class="categories">
        <div class="category">
        <img src="./img/New folder/1.png" alt="" class="fade-effect">
         <h3>Supplements</h3>
         <p>Boost your immune system and well-being with our range of supplements.</p>
         <a href="category.php?category=supplements" class="btn">View Supplements</a>
        </div>
        <div class="category">
        <img src="./img/New folder/2.png" alt="" class="fade-effect">
         <h3>Skincare</h3>
         <p>Take care of your skin with our dermatologist-approved skincare products.</p>
         <a href="category.php?category=skincare" class="btn">View Skincare</a>
        </div>
        <div class="category">
        <img src="./img/New folder/3.png" alt="" class="fade-effect">
         <h3>Medical Equipment</h3>
         <p>Top-notch medical equipment for home care and professional use.</p>
         <a href="category.php?category=Medical Equipment" class="btn">View Medical Equipment</a>
        </div>
        <div class="category">
        <img src="./img/New folder/4.png" alt="" class="fade-effect">
         <h3>Vitamins</h3>
         <p>Vitamins are essential for maintaining our health and boosting our immunity.</p>
         <a href="category.php?category=Vitamins" class="btn">View Vitamins</a>
        </div> 
        <div class="category">
        <img src="./img/New folder/5.png" alt="" class="fade-effect">
         <h3>personal care</h3>
         <p>Personal care is important for maintaining hygiene and overall well-being.</p>
         <a href="category.php?category=personal care" class="btn">View personal care</a>
        </div>
        <div class="category">
        <img src="./img/New folder/6.png" alt="" class="fade-effect">
         <h3>Health medicine</h3>
         <p>Health medicine focuses on promoting well-being and preventing illness through effective treatments and lifestyle choices.</p>
         <a href="category.php?category=Health medicine" class="btn">View Health medicine</a>
        </div>
        <div class="category">
        <img src="./img/New folder/7.png" alt="" class="fade-effect">
         <h3>baby care</h3>
         <p>Baby care involves nurturing and protecting your little ones health, comfort, and development.</p>
         <a href="category.php?category=baby care" class="btn">View baby care</a>
        </div>
        <div class="category">
        <img src="./img/New folder/9.png" alt="" class="fade-effect">
         <h3>Medications</h3>
         <p>High-quality medications for various conditions to support your health.</p>
         <a href="category.php?category=medications" class="btn">View Medications</a>
        </div>
    </div>
    <?php include('footer.php') ?>
 <script src="./js/home.js" ></script>
 <script src="./js/header.js" ></script>

</body>
</html>
