<!DOCTYPE html>
<!-- 상품 리스트 -->
<html>

<head>
    <title>상품 리스트</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <style>
        td {
            width: 50px;
            height: 50px;
        }

        img {
            width: 90px;
            height: 90px;
        }

        .edit {
            width: 5%;
            height: 5%;
        }

        .number {
            width: 2%;
            height: 1%;
        }

        .item {
            width: 10%;
            height: 10%;
        }

        .comment {
            width: 10%;
        }

        .memo {
            width: 30%;
        }

        .img {
            width: 10%;
            height: 30%;
        }

        .price {
            width: 10%;
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

    <h1>상품 리스트</h1>

    <?php
    # shop_data 테이블의 레코드 검색해서 출력하기 
    include_once('dbconn.php');
    $sql = "select * from shop_data";
    $result = $conn->query($sql); // select 실행으로 검색된 레코드 집합을 반환
    if ($result->num_rows > 0) { // 검색된 레코드가 있으면 
        while ($row = $result->fetch_assoc()) { // 레코드 한 개를 연관배열 형태로 가져옴 
            ?>

            <table border="1" width=100%>
                <tr>
                    <td>No</td>
                    <td>상품명</td>
                    <td>짧은 설명</td>
                    <td>설명</td>
                    <td>이미지</td>
                    <td>금액</td>
                    <td>종류</td>
                    <td>기타</td>
                </tr>

                <a
                    href="shop_add_post.php?item=<?= $row['item'] ?>
                                    &commend=<?= $row['comment'] ?>&memo=<?= $row['memo'] ?> &price=<?= $row['price'] ?>">
                </a>
                <tr>
                    <td class="number">
                        <?= $row['no'] ?>
                    </td>
                    <td class="item">
                        <?= $row['item'] ?>
                    </td>

                    <td class="comment">
                        <?= $row['comment'] ?>
                    </td>
                    <td class="memo">
                        <?= $row['memo'] ?>
                    </td>

                    <td class="img"><img src="images/<?= $row['img'] ?>"></td>
                    <td class="price">
                        <?= $row['price'] ?>원
                    </td>
                    <td>
                        <?= $row['kind'] ?>
                    </td>

                    <td class="edit">
                        <a href="shop_edit.php?no=<?= $row['no'] ?>"> 수정 </a>
                    </td>
                    <br>
                </tr>
            </table>
        <?php }
    } else
        echo "등록된 상품이 없습니다.";
    ?>
</body>

</html>