<?php
function uploadImage($file, $category) {
    $target_dir = "uploaded_img/" . $category . "/";

    // إنشاء المجلد إذا لم يكن موجودًا
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($file["name"]);
    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file; // ترجع مسار الصورة لحفظه في قاعدة البيانات
    } else {
        return false; // فشل في رفع الصورة
    }
}
?>
