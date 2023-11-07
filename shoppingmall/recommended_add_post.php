<?php
# 상품 추가 
include_once('dbconn.php');

$no = 0; // 0 으로 초기화 시켜주면 sql문에서 auto_increment가 적용되어 1부터 하나씩 증가되어 저장
$item = $_POST['item'];
$comment = $_POST['comment'];
$memo = $_POST['memo'];
$price = $_POST['price'];
$kind = $_POST['kind'];
$img = $_POST['img'];

// move_uploaded_file($img, "./shop/$img");

$sql = "insert into recommended values($no,'$item','$comment', '$memo','$price','$kind', '$img')";


if ($conn->query($sql)) {
    echo "<script>alert('상품이 추가되었습니다.');</script>";
    echo "<script>location.replace('shop.php')</script>";
} else {
    echo "<script>alert('상품 추가가 실패되었습니다.');</script>";
    echo "<script>location.replace('shop_add.html')</script>";
}

?>