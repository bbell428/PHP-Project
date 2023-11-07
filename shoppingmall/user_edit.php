<!-- role (멤버 등급 전환) 대표자 -->
<?php
session_start();
include_once('dbconn.php'); # dbconn.php 파일의 내용을 그대로 복사해옴 

$email = $_POST['email'];
$name = $_POST['name'];
$pwd = $_POST['pwd'];
$telno = $_POST['telno'];
$address = $_POST['address'];
$regdate = $_POST['regdate'];
$role = $_POST['role'];

$sql = "update member set name = '$name', pwd = '$pwd', telno = '$telno', address = '$address', 
        regdate = '$regdate',role = '$role'
        where email = '$email'";

if ($conn->query($sql)) {
    echo "<script>alert('멤버등급 전환이 성공하였습니다..');</script>";
    echo "<script>location.replace('user_list_leader.php')</script>";
} else { // 그외 수정 실패시
    echo "<script>alert('멤버등급 전환이 실패하였습니다.');</script>";
    echo "<script>location.replace('user_list_leader.php')</script>";
}
?>