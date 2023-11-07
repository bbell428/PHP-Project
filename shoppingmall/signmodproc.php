<!-- 회원정보 수정 -->
<!-- user(고객), admin(관리자) -->
<?php
/*********************************
 * FILE: signmodproc.php
 * 회원정보를 member 테이블에서 수정함
 * 2023.05.16
 */
# DB 연결
# 데이터 읽어오기
# UPDATE SQL 구문 작성하고 실행하기
session_start();
include_once('dbconn.php'); # dbconn.php 파일의 내용을 그대로 복사해옴 
$email = $_POST['email'];
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
$telno = $_POST['telno'];
$address = $_POST['address'];

$sql = "update member set name = '$uname', pwd = '$pwd', telno = '$telno', address = '$address'
        where email = '$email'";

if ($conn->query($sql)) {
    $_SESSION['pz_uname'] = $uname; # 변경된 회원명을 세션데이터에 저장함 
    echo "<script>alert('회원정보수정이 성공하였습니다.');</script>";
    echo "<script>location.replace('main.php')</script>";
} else {
    echo "<script>alert('회원정보수정이 실패하였습니다.');</script>";
    echo "<script>location.replace('signmodify.php')</script>";
}
?>