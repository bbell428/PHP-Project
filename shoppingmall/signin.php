<!-- 로그인 -->
<?php
session_start(); # 이 페이지에서 세션 데이터 처리를 할려고 한다. 첫번째에 실행하기. 
#1) DB 연결하기
#2) 로그인 데이터 읽어오기
#3) SELECT SQL 구문 작성하기
#4) SQL 구문 실행하고 결과 받기
#5) 검색결과 처리하기
include_once('dbconn.php'); # dbconn.php 파일의 내용을 그대로 복사해옴 
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$sql = "select * from member where email = '$email' and pwd = '$pwd'";
$set = $conn->query($sql); # select 구문 실행하고 레코드 집합을 받음
#var_dump($set);
if ($set->num_rows > 0) {
    # 검색된 레코드를 읽어오기
    $row = $set->fetch_assoc(); # 레코드 하나를 연관배열 형태로 반환해 줌
    #var_dump($row);
    $uname = $row['name']; # 회원이름 가져옴 
    # 세션 데이터 생성. 세션 데이터는 연관배열 형태를 가짐  
    $_SESSION['pz_uid'] = $email;
    // 현재 사용자의 이메일 주소를 $_SESSION['pz_uid']라는 세션 변수에 할당합니다. 이를 통해 세션을 통해 사용자를 식별할 수 있습니다.
    $_SESSION['pz_uname'] = $uname;

    $role = $row['role']; # 회원가입된 회원에 user 혹은 admin인지 가져옴
    $_SESSION['pz_admin'] = $role;
    //현재 사용자의 위치인 user(고객) 인지 admin(관리자) 인지 식별할 수 있게 도와줌

    echo "<script>alert('로그인 성공하였습니다.');</script>";
    echo "<script>location.replace('main.php')</script>";
} else {
    echo "<script>alert('로그인 실패하였습니다.');</script>";
    echo "<script>location.replace('signin.html')</script>";
}
?>