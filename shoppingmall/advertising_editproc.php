<?php
session_start();
include_once('dbconn.php'); # dbconn.php 파일의 내용을 그대로 복사해옴 

$no = $_POST['no'];
$img = $_POST['img'];

$sql = "update advertising set img = '$img'
        where no = '$no'";

if ($conn->query($sql)) {
    echo "<script>alert('광고 수정이 완료하였습니다..');</script>";
    echo "<script>location.replace('advertising_list.php')</script>";
} else { // 그외 수정 실패시
    echo "<script>alert('광고 수정이 실패하였습니다.');</script>";
    echo "<script>location.replace('advertising_list.php')</script>";
}

?>