<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Document</title>

    <style>
        .commentmemo {
            margin-top: -30px;
            color: violet;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php
    # 로그인 상태를 체크하고 아니라면 오류메세지 출력한 다음 index.php로 이동하기
    session_start();
    if (!isset($_SESSION['pz_uid'])) { // 로그인한 상태가 아니면 
        echo "<script>alert('로그인을 하지 않았습니다.')</script>";
        echo "<script>location.href='signin.html'</script>";
    }
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
    <link rel="stylesheet" href="item.css" />
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

    <article>
        <?php
        include_once('dbconn.php');
        $no = $_GET['no'];
        $sql = "select * from shop_data where no = '$no'";
        $result = $conn->query($sql);
        ($row = $result->fetch_assoc())
            ?>
        <div class="item-title">
            <a href="main.php" class="item-icon">
                <i class="fa fa-home" id="Home">홈으로</i>
            </a>
        </div>
        <div class="item-contentContainer">
            <div><img class="item-img" src="images/<?= $row['img'] ?>"></div>
            <div class="item-content">
                <div class=>
                    <form action="itemproc.php" method="post">
                        <h2 class="item-content-title">
                            <?= $row['item'] ?>
                            <input type="hidden" name="item" value="<?= $row['item'] ?>">
                        </h2>
                        <p>
                        <div class="commentmemo">
                            <?= $row['comment'] ?>
                        </div>
                        <?= $row['memo'] ?>
                        </p>
                        <p class="item-icons">⭐️⭐️⭐️⭐️⭐️ &nbsp사용후기 1 개</p>
                        <div class="item-cost">
                            <p>시중가격 &nbsp&nbsp&nbsp&nbsp&nbsp
                                <?= $row['price'] + 12000 ?>
                            </p>
                            <p>판매가격 &nbsp&nbsp&nbsp&nbsp&nbsp<strong>
                                    <?= $row['price'] ?>
                                    <input type="hidden" name="price" value="<?= $row['price'] ?>">
                                </strong></p>
                        </div>
                        <div class="item-exam">
                            <p>
                                ㅇ 상품 이미지는 해상도, 색상 설정에 따라 이미지가 왜곡되거나 실제 색상과 차이가 있을 수 있습니다.<br>
                                ㅇ 사이즈 실측은 상품의 특성 및 측정방식에 따라 오차가 발생할 수 있습니다.
                            </p>
                        </div>
                        <div class="item-select">
                            <h6>선택옵션</h6>
                            <p>선텍</p>
                            <select name="size">
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="X">X</option>
                                <option value="XL">XL</option>
                            </select>
                        </div>
                        <div class="item-count">
                            <input type="number" name="qty" min="1" max="10" value="1" class="number">
                            <input type="submit" value="주문하기" class="btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </article>

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
                    예금주 : (주)에이투젯(ATOZ)<br />
                    농협은행 351-1037-2016-53
                </div>
            </div>
            <div class="footerMain">
                <div class="footerMainTitle">빠른서 서비스</div>
                <div class="footerContent">
                    <a href="#">이벤트</a>
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

    <script src="item.js"></script>
</body>

</html>