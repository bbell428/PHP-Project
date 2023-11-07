<!DOCTYPE html>
<!-- 상품 수정 -->
<html>

<head>
    <title>관리자</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        .ali a {
            font-size: 30px;
            text-decoration: none;
            color: royalblue;
        }

        li {
            font-size: 30px;
            margin-right: 100px;
        }

        .ali {
            margin-top: 2%;
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
    <div class="ali">
        <?php
        # 세션 데이터 확인하고 로그인 상태 여부 체크하기
        if (isset($_SESSION['pz_uid'])) { // 로그인 된  상태라면 참이므로 실행
            $email = $_SESSION['pz_uid']; // 현재 로그인 된 이메일을 $email에 저장
            $role = $_SESSION['pz_admin'];
            $sql = "select * from member where email = '$email'";
            $result = $conn->query($sql); // 개수를 가지는 레코드 1개 있음 
            $row = $result->fetch_assoc();
        }
        ?>
        <?php if ($role == 'leader') { ?>
            <h1>대표자 전용 페이지</h1>
            <table border="1" width="50%">
                <tr>
                    <td><a href="shop_add.html">상품추가</a> </td>
                    <td><a href="shop_list.php">상품 목록</a></td>
                </tr>
                <tr>
                    <td><a href="advertising_add.html">광고 추가</a></td>
                    <td><a href="advertising_list.php">광고 목록</a></td>
                </tr>
                <tr>
                    <td><a href="recommended_add.html">추천 추가</a></td>
                    <td><a href="recommended_list.php">추천 목록</a></td>
                </tr>
                <tr>
                    <td><a href="special_add.html">특가 추가</a></td>
                    <td><a href="special_list.php">특가 목록</a></td>
                </tr>
                <a href="user_list_leader.php">회원자 목록<br></a>
                <a href="porder.php">주문 목록<br></a>
            </table>
        <?php } else { ?>
            <h1>관리자 전용 페이지</h1>
            <table border="1" width="50%">
                <tr>
                    <td><a href="shop_add.html">상품추가</a> </td>
                    <td><a href="shop_list.php">상품 목록</a></td>
                </tr>
                <tr>
                    <td><a href="advertising_add.html">광고 추가</a></td>
                    <td><a href="advertising_list.php">광고 목록</a></td>
                </tr>
                <tr>
                    <td><a href="recommended_add.html">추천 추가</a></td>
                    <td><a href="recommended_list.php">추천 목록</a></td>
                </tr>
                <tr>
                    <td><a href="special_add.html">특가 추가</a></td>
                    <td><a href="special_list.php">특가 목록</a></td>
                </tr>
                <a href="user_list.php">회원자 목록<br><br></a>
                <a href="porder.php">주문 목록<br></a>
            </table>
        <?php } ?>
    </div>
</body>

</html>