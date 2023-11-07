<?php
session_start();
include_once('dbconn.php'); # dbconn.php 파일의 내용을 그대로 복사해옴 

$no = $_POST['no'];
$item = $_POST['item'];
$comment = $_POST['comment'];
$memo = $_POST['memo'];
$price = $_POST['price'];
$kind = $_POST['kind'];
$img = $_POST['img'];

$sql = "update shop_data set item = '$item', comment = '$comment', memo = '$memo',price = '$price',kind = '$kind', img = '$img'
        where no = '$no'";

if ($conn->query($sql)) {
    echo "<script>alert('상품 수정이 완료하였습니다..');</script>";
    echo "<script>location.replace('shop_list.php')</script>";
} else { // 그외 수정 실패시
    echo "<script>alert('상품 수정이 실패하였습니다.');</script>";
    echo "<script>location.replace('shop_list.php')</script>";
}

?>