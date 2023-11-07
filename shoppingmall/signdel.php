<?php
# 회원 탈퇴 
# 세션데이터 읽어오기(아이디)
# DB 연결하기
# DELETE SQL 구문 작성하고 실행하기
session_start();
$email = $_SESSION['pz_uid'];
include_once('dbconn.php'); # DB connection creation 
$sql = "delete from member where email = '$email'";
if ($conn->query($sql)) {
    session_destroy();
    echo "<script>alert('회원탈퇴가 성공하였습니다.');</script>";
    echo "<script>location.replace('main.php')</script>";
} else {
    echo "<script>alert('회원탈퇴가 실패하였습니다.');</script>";
    echo "<script>location.replace('main.php')</script>";
}
$conn->close(); # DB disconnection 연결해제 
?>