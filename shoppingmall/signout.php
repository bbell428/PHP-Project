<?php
// 로그아웃
session_start(); // 세션을 시작합니다. 이전 세션 데이터에 접근하고 수정할 수 있도록 합니다.
session_destroy(); # 세션데이터 모두 삭제
header('location: main.php'); // 웹 브라우저가 현재 위치를 다른 URL로 변경하도록 지시하는 기능
?>