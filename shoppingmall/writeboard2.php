<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>게시글</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="board.css">

    <style>
        img {
            width: 300px;
            height: 300px;
        }

        .writelist {
            padding-left: 20%;
        }


        .summ {
            color: rebeccapurple;
            font-size: large;
        }

        .img-box>img {
            width: 100%;
            display: block;
        }

        .row::after {
            content: "";
            display: block;
            clear: both;
        }

        .cell {
            float: left;
            box-sizing: border-box;
        }

        .cell-right {
            float: right;
            box-sizing: border-box;
        }

        .margin-0-auto {
            margin: 0 auto;
        }

        .block {
            display: block;
        }

        .inline-block {
            display: inline-block;
        }

        .text-align-center {
            text-align: center;
        }

        .line-height-0-ch-only {
            line-height: 0;
        }

        .line-height-0-ch-only>* {
            line-height: normal;
        }

        .relative {
            position: relative;
        }

        .absolute-left {
            position: absolute;
            left: 0;
        }

        .absolute-right {
            position: absolute;
            right: 0;
        }

        .absolute-middle {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .con {
            max-width: 950px;
        }

        .con-min-width {
            min-width: 320px;
        }

        .top-menu a {
            text-decoration: none;
            color: gray;
            font-weight: bold;
            font-size: 1.2rem;
        }

        html,
        body {
            overflow-x: hidden;
        }

        .table-common>table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-common .btn-box {
            text-align: center;
        }

        .table-common>table th,
        .table-common>table td {
            border: 1px solid black;
            padding: 10px;
        }

        .article-list table {
            border: none;
            border-top: 2px solid lightgray;
            border-bottom: 2px solid lightgray;
        }

        .article-list>table th,
        .article-list>table td {
            border: none;
        }

        .article-list>table td {
            border-bottom: 1px solid lightgray;
        }

        .article-list>table thead {
            border-bottom: 2px solid lightgray;
            background-color: #F5F5F5;
        }

        .article-detail {
            border: 2px solid lightgray;
        }

        .article-detail>table {
            border: none;
            width: calc(100% - 100px);
        }

        .article-detail>table th,
        .article-detail>table td {
            border: none;
        }

        .article-detail>table tr:not(:last-child) {
            border-bottom: 1px solid lightgray;
        }

        .article-detail>table tr:not(.article-body),
        .article-detail>table tr:not(.article-body)>td {
            height: 20px;
            font-size: 0.8rem;
        }

        .article-detail>table tr.article-title>td {
            height: 45px;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .article-detail>table td:last-child {
            padding-right: 100px;
        }

        .article-detail>.article-writer {
            width: 100px;
            height: 102px;
            background-color: lightgray;
            border-bottom: 1px solid lightgray;
            text-align: center;
        }

        .article-detail>.article-writer .writer-icon {
            margin: 0 auto;
            background-color: white;
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <?php
    # 세션 데이터 확인하고 로그인 상태 여부 체크하기
    session_start();
    $login = false; # 초기값으로 생성해 둠
    if (isset($_SESSION['pz_uid'])) { // 로그인 된  상태라면 참이므로 실행
        $email = $_SESSION['pz_uid']; // 현재 로그인 된 이메일을 $email에 저장
        $uname = $_SESSION['pz_uname']; // 현재 로그인 된 이름을 $uname에 저장
        $role = $_SESSION['pz_admin'];
        //echo "$uname 환영합니다.";
        $login = true;
        // 로그인한 사용자의 장바구니 담긴 물품 개수를 알아보자
        include_once('dbconn.php');
        $sql = "select count(*) pnum from cart where email = '$email'";
        // 이를 통해 어느 특정 이메일에 있는 장바구니에 담긴 내용을 확인할 수 있다.
        $result = $conn->query($sql); // 개수를 가지는 레코드 1개 있음 
        $row = $result->fetch_assoc();
    }
    ?>
    <link rel="stylesheet" href="main.css" />
    <header>
        <div class="navTop">
            <?php
            if ($login && $role == 'leader') { // 로그인 된 상태에서 admin 관리자일 때 
                ?>
                <a href="signout.php" class="navBtn">
                    대표자! 로그아웃
                </a>
                <a href="shop.php" class="navBtn" style="color:red">대표자 페이지</a>
                <a href="signmodify.php" class="navBtn">정보수정</a>
                <a href="mypage.php" class="navBtn">마이쇼핑</a>
                <a href="showcart.php" class="navBtn">🧺장바구니(
                    <?= $row['pnum'] ?>)
                </a>
            <?php } elseif ($login && $role == 'admin') { // 로그인 된 상태에서 admin 관리자일 때 
                ?>
                <a href="signout.php" class="navBtn">
                    관리자! 로그아웃
                </a>
                <a href="shop.php" class="navBtn" style="color:red">관리자 페이지</a>
                <a href="signmodify.php" class="navBtn">정보수정</a>
                <a href="mypage.php" class="navBtn">마이쇼핑</a>
                <a href="showcart.php" class="navBtn">🧺장바구니(
                    <?= $row['pnum'] ?>)
                </a>
            <?php } elseif ($login) { // user 고객일 때 화면 ?>
                <a href="signout.php" class="navBtn">
                    <?= $uname ?> !로그아웃
                </a>
                <a href="signmodify.php" class="navBtn">정보수정</a>
                <a href="mypage.php" class="navBtn">마이쇼핑</a>
                <a href="showcart.php" class="navBtn">🧺장바구니(
                    <?= $row['pnum'] ?>)
                </a>
                <!-- <a href="signdel.php" class="navBtn">회원탈퇴</a> -->
            <?php } else { // 로그인 전 ?>
                <a href="signin.html" class="navBtn">로그인</a>
                <a href="signup.html" class="navBtn">회원가입</a>
                <a href="mypage.php" class="navBtn">마이쇼핑</a>
                <a href="showcart.php" class="navBtn">🧺장바구니</a>
            <?php } ?>
        </div>

        <div class="navBottom">
            <a href="main.php">🐂우진사</a>
            <i class="fas fa-search">🔍</i>
            <input type="text" id="search" />
        </div>
    </header>

    <section>
        <div class="bodyTop">
            <div class="TopBodyBtn">
                <a href="list.php" class="Btn">전체상품</a>
                <a href="top.php" class="Btn">상의</a>
                <a href="bottom.php" class="Btn">하의</a>
                <a href="hat.php" class="Btn">모자</a>
                <a href="shoes.php" class="Btn">신발</a>
                <a href="writeboard.php" class="Btn">게시글</a>
            </div>
        </div>
    </section>
    <div class="tab">
        <button type="button" class="tablinks" onclick="location.href='writeboard.php'" id="defaultOpen">게시글작성</button>
        <button type="button" class="tablinks" onclick="location.href='writeboard2.php'" id="defaultOpen">게시글목록</button>
    </div>
    <div class="writelist">
        <?php
        if (!isset($_SESSION['pz_uid'])) { // 로그인하지 않고 글쓰기로 온 상태
            echo "<script>alert('글작성하기 위해서는 로그인을 해야합니다.');";
            echo "location.href = 'signin.html'</script>";
        }
        ?>
        <h2>게시글 목록</h2>

        <?php
        include_once('dbconn.php');
        $sql = "select * from board";
        $result = $conn->query($sql); // select 실행으로 검색된 레코드 집합을 반환
        if ($result->num_rows > 0) { // 검색된 레코드가 있으면 
            while ($row = $result->fetch_assoc()) { // 레코드 한 개를 연관배열 형태로 가져옴 
                ?>
                <div class="divider"></div>
                <details>
                    <summary class="summ">
                        No:
                        <?= $row['no'] ?>&nbsp,
                        작성자:
                        <?= $row['email'] ?>&nbsp
                        (상세보기)
                    </summary>
                    <br>

                    <section class="article-detail table-common con row">
                        <div class="article-writer cell">
                            <div class="writer-icon">
                                <?= $row['email'] ?>
                            </div>
                        </div>
                        <table class="cell" border="1">
                            <colgroup>
                                <col width="100px">
                            </colgroup>
                            <tbody>
                                <tr class="article-title">
                                    <th>[번호]제목</th>
                                    <td colspan="3">
                                        <?= $row['no'] ?>.
                                        <?= $row['title'] ?>
                                    </td>
                                </tr>
                                <tr class="article-info">
                                    <th>날짜</th>
                                    <td>
                                        <?= $row['wdate'] ?>
                                    </td>
                                    <br>
                                </tr>
                                <tr class="article-body">
                                    <td colspan="4">
                                        <p>
                                            <?= $row['content'] ?>
                                        </p>
                                    </td>
                                </tr>
                                <?php if ($row['attachment']) { ?>
                                    <tr>
                                        <td><img src="images/<?= $row['attachment'] ?>"></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </section>
                </details>
            <?php }
        } else
            echo "<h1>게시글이 없습니다.";
        ?>
    </div>
</body>

</html>