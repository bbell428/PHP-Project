<?php

session_start();
include_once('dbconn.php');
$no = 0;
$email = $_POST['email'];
$wdate = $_POST['wdate'];
$title = $_POST['title'];
$note = $_POST['note'];
$att = $_POST['att'];

$sql = "insert into board values($no, '$email','$wdate','$title','$note','$att')";
if ($conn->query($sql)) {
	echo "<script>alert('게시글이 저장되었습니다.'); location.href='writeboard.php'</script>";
} else {
	echo "게시글 저장에 오류가 발생했습니다. <br>";
	echo $conn->error;
}
?>