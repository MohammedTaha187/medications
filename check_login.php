<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

@include 'config.php'; // تأكد من أن الاتصال بقاعدة البيانات موجود

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('يجب تسجيل الدخول أولاً'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// تحقق مما إذا كان user_id موجودًا في جدول users
$check_user = $conn->prepare("SELECT id FROM users WHERE id = ?");
$check_user->execute([$user_id]);

if ($check_user->rowCount() == 0) {
    session_destroy();
    echo "<script>alert('المستخدم غير موجود في قاعدة البيانات. يُرجى تسجيل الدخول مجددًا.'); window.location.href='login.php';</script>";
    exit();
}
?>
