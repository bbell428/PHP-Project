<!-- 회원가입 -->
<?php
#1) DB 접속하기
#2) 회원가입 데이터 읽어오기
#3) INSERT SQL 구문 작성하기
#4) SQL 구문 실행하고 결과 확인하기
include_once('dbconn.php'); # dbconn.php 파일의 내용을 그대로 복사해옴 
$email = $_POST['email'];
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
$telno = $_POST['telno'];
$address = '';
$regdate = date('Y/m/d'); // date() 함수를 사용하여 현재 날짜를 가져옵니다.
$point = 5000;
$role = 'user'; // 회원가입시 기본 값을 user(고객)로 설정
$sql = "insert into member values('$email','$uname','$pwd','$telno','$address','$regdate',$point, '$role')";
#echo $sql;
if ($conn->query($sql)) {
    #echo "회원가입 성공";
    echo "<script>alert('회원가입이 성공하였습니다.');</script>";
    echo "<script>location.replace('main.php')</script>";
} else {
    echo "<script>alert('회원가입이 실패하였습니다.');</script>";
    echo "<script>location.replace('signup.html')</script>";
}
?>