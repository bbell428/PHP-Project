<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Document</title>
    <link rel="stylesheet" href="main.css" />
    <style>
        .Imgbtns {
            height: 10px;
            opacity: 0.7;
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
        <?php
        include_once('dbconn.php');
        $sql = "select * from advertising";
        $result = $conn->query($sql); // select 실행으로 검색된 레코드 집합을 반환
        if ($result->num_rows > 0) { // 검색된 레코드가 있으면 
            while ($row = $result->fetch_assoc()) {
                if ($row['no'] == 1) {
                    ?>
                    <div class="ImgWrapper">
                        <img id="image" src="images/<?= $row['img'] ?>" alt="이미지" width="100%" height="500px" />
                    <?php } ?>
                    <div class="ImgBtn">
                        <button class="Imgbtns" onclick="changeImage(src='images/<?= $row['img'] ?>')"></button>
                    </div>
                </div>
            <?php }
        } ?>
    </section>
    <!-- ------------------------------------------------------------------------------------------- -->
    <article>
        <div class="Articletitle">
            <a href="#" class="items">추천상품🫥</a>
        </div>
        <div class="Cardsection">
            <?php
            include_once('dbconn.php');
            $sql = "select * from recommended";
            $result = $conn->query($sql); // select 실행으로 검색된 레코드 집합을 반환
            if ($result->num_rows > 0) { // 검색된 레코드가 있으면 
                while ($row = $result->fetch_assoc()) { // 레코드 한 개를 연관배열 형태로 가져옴 
                    ?>

                    <div class="card">
                        <a href="item_recommended.php?no=<?= $row['no'] ?>
                                &price=<?= $row['price'] ?>  &img=<?= $row['img'] ?>">
                            <img src="images/<?= $row['img'] ?>" class="card-imgcontainer">
                            <!-- <div class="card-img"></div> -->
                        </a>
                        </a>
                        <div class="card-main">
                            <span class="card-title">
                                <?= $row['item'] ?>
                            </span>
                            <div class="card-content">
                                <p>평점 5.0 리뷰 1</p>
                            </div>
                            <div class="card-cost">
                                <span>
                                    <?= $row['price'] * 10 / 100 ?>
                                </span>
                                <strong>
                                    <?= $row['price'] ?>원
                                </strong>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="Icon">
                                <h6>
                                    <span class="badge bg-secondary">추천</span>
                                </h6>
                                <h6>
                                    <span class="badge bg-secondary">인기</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </article>
    <!-- ------------------------------------------------------------------------------------------- -->
    <div class="animated-title">
        <div class="track">
            <div class="content">&nbsp;moho design template glad&nbsp;moho design template glad&nbsp;moho design
                template glad&nbsp;moho design template glad&nbsp;moho design template glad&nbsp;moho design template
                glad</div>
        </div>
    </div>
    <!-- ------------------------------------------------------------------------------------------- -->
    <article>
        <div class="Articletitle">
            <a href="#" class="items">오늘의 특가💳</a>
        </div>
        <div class="Cardsection">
            <?php
            include_once('dbconn.php');
            $sql = "select * from special";
            $result = $conn->query($sql); // select 실행으로 검색된 레코드 집합을 반환
            if ($result->num_rows > 0) { // 검색된 레코드가 있으면 
                while ($row = $result->fetch_assoc()) { // 레코드 한 개를 연관배열 형태로 가져옴 
                    ?>

                    <div class="card">
                        <a href="item_special.php?no=<?= $row['no'] ?>
                                &price=<?= $row['price'] ?>  &img=<?= $row['img'] ?>">
                            <img src="images/<?= $row['img'] ?>" class="card-imgcontainer">
                            <!-- <div class="card-img"></div> -->
                        </a>
                        </a>
                        <div class="card-main">
                            <span class="card-title">
                                <?= $row['item'] ?>
                            </span>
                            <div class="card-content">
                                <p>평점 5.0 리뷰 1</p>
                            </div>
                            <div class="card-cost">
                                <span>
                                    <?= $row['price'] * 10 / 100 ?>
                                </span>
                                <strong>
                                    <?= $row['price'] ?>원
                                </strong>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="Icon">
                                <h6>
                                    <span class="badge bg-secondary">추천</span>
                                </h6>
                                <h6>
                                    <span class="badge bg-secondary">인기</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </article>
    <!-- ------------------------------------------------------------------------------------------- -->
    <footer>
        <div class="Footercontainer">
            <a href="main.php" class="footerTitle">홈으로</a>
            <a href="#" class="footerTitle">회사소개</a>
            <a href="#" class="footerTitle">이용약관</a>
        </div>
        <div class="footerCard">
            <div class="footerMain">
                <div class="footerMainTitle">고객센터</div>
                <div class="footerContent">031-111-2222</div>
            </div>
            <div class="footerMain">
                <div class="footerMainTitle">무통장입금</div>
                <div class="footerContent">
                    예금주: (주)에이투젯(ATOZ)<br />
                    농협은행 351-1037-2016-53
                </div>
            </div>
            <div class="footerMain">
                <div class="footerMainTitle">빠른서비스</div>
                <div class="footerContent">
                    <a href="#" class="event">이벤트</a>
                </div>
            </div>
            <div class="footerMain">
                <div class="footerMainTitle">반품주소안내</div>
                <div class="footerContent">
                    자세한 교환·반품절차 안내는<br />
                    상품하단을 참고해주세요.
                </div>
            </div>
        </div>
    </footer>

    <script src="main.js"></script>
</body>

</html>