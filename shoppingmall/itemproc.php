<?php
# 세션 시작하기, DB 연결하기, 데이터 가져오기 
# INSERT SQL 구문 작성하고 실행하기
session_start();
include_once('dbconn.php');
$email = $_SESSION['pz_uid']; // 로그인한 사용자의 이메일 
$items = $_POST['item'];
$size = $_POST['size'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$price *= $qty;

$sql = "insert into cart values('$email','$items','$size',$qty,$price)";
#echo $sql;
if ($conn->query($sql)) {
    echo "<script> let yesno;
          yesno = confirm('장바구니로 이동하시겠습니까?');
          if(yesno) location.href = 'showcart.php';
          else location.href = 'main.php';
          </script>";
} else
    echo "장바구니 등록 실패" . $conn->error;
?>