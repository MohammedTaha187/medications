<?php

@include 'config.php'; 

session_start(); 

$user_id = $_SESSION['user_id']; 

if(!isset($user_id)){ 
   header('location:login.php'); 
};

if(isset($_POST['update_profile'])){ 

   $name = $_POST['name']; 
   $name = filter_var($name, FILTER_SANITIZE_STRING); 
   $email = $_POST['email']; 
   $email = filter_var($email, FILTER_SANITIZE_STRING); 

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
   $update_profile->execute([$name, $email, $user_id]);

   $image = $_FILES['image']['name']; 
   $image = filter_var($image, FILTER_SANITIZE_STRING); 
   $image_size = $_FILES['image']['size']; 
   $image_tmp_name = $_FILES['image']['tmp_name']; 
   $image_folder = 'uploaded_img/'.$image; 
   $old_image = $_POST['old_image']; 

   if(!empty($image)){ 
      if($image_size > 2000000){ 
         $message[] = 'حجم الصورة كبير جداً!'; 
      }else{ 
         $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?"); 
         $update_image->execute([$image, $user_id]); 
         if($update_image){ 
            move_uploaded_file($image_tmp_name, $image_folder); 
            unlink('uploaded_img/'.$old_image); 
            $message[] = 'تم تحديث الصورة بنجاح!'; 
         }; 
      }; 
   };

   $old_pass = $_POST['old_pass']; 
   $update_pass = md5($_POST['update_pass']); 
   $update_pass = filter_var($update_pass, FILTER_SANITIZE_STRING); 
   $new_pass = md5($_POST['new_pass']); 
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING); 
   $confirm_pass = md5($_POST['confirm_pass']); 
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING); 

   if(!empty($update_pass) AND !empty($new_pass) AND !empty($confirm_pass)){ 
      if($update_pass != $old_pass){ 
         $message[] = 'كلمة المرور القديمة غير متطابقة!'; 
      }elseif($new_pass != $confirm_pass){ 
         $message[] = 'تأكيد كلمة المرور غير متطابق!'; 
      }else{ 
         $update_pass_query = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?"); 
         $update_pass_query->execute([$confirm_pass, $user_id]); 
         $message[] = 'تم تحديث كلمة المرور بنجاح!'; 
      } 
   }
}

// جلب بيانات المستخدم من قاعدة البيانات
$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>تحديث ملف المستخدم</title>

 <link rel="stylesheet" href="css/style2.css">
 <link rel="stylesheet" href="css/user_profile_updates.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="update-profile">

   <h1 class="title">تحديث الملف الشخصي</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <?php if ($fetch_profile): ?>
         <div class="image-box">
   <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="" class="profile-image">   
</div>
      <?php else: ?>
         <p>لا يوجد صورة حالياً</p>
      <?php endif; ?>
      <div class="flex">
         <div class="inputBox">
            <span>اسم المستخدم :</span>
            <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" placeholder="تحديث اسم المستخدم" required class="box">
            <span>البريد الإلكتروني :</span>
            <input type="email" name="email" value="<?= $fetch_profile['email']; ?>" placeholder="تحديث البريد الإلكتروني" required class="box">
            <span>تحديث الصورة :</span>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
            <input type="hidden" name="old_image" value="<?= $fetch_profile['image']; ?>">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
            <span>كلمة المرور القديمة :</span>
            <input type="password" name="update_pass" placeholder="أدخل كلمة المرور السابقة" class="box">
            <span>كلمة المرور الجديدة :</span>
            <input type="password" name="new_pass" placeholder="أدخل كلمة المرور الجديدة" class="box">
            <span>تأكيد كلمة المرور :</span>
            <input type="password" name="confirm_pass" placeholder="تأكيد كلمة المرور الجديدة" class="box">
         </div>
      </div>
      <div class="flex-btn">
         <input type="submit" class="btn" value="تحديث الملف" name="update_profile">
         <a href="home.php" class="option-btn">العودة</a>
      </div>
   </form>

</section>
<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
