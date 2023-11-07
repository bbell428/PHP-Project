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
        .bodys {
            text-align: center;
        }

        #order {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        #order td,
        #order th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #order tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #order tr:hover {
            background-color: #ddd;
        }

        #order th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #454545;
            color: white;
        }

        #order img {
            width: 120px;
            height: 80px;
        }

        .btn {
            background-color: #454545;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 70%;
            opacity: 0.9;
            margin-top: 10px;
        }

        .btn:hover {
            opacity: 1;
        }

        .area {
            border-top: 0;
            padding: 0 20px;
            line-height: 18px;
            color: #555;
        }

        .box {
            margin: 5px 0;
            padding-top: 5px;
            font-weight: bold;
            color: #8c9eb0;
            line-height: 20px;
        }

        dd {
            margin: 12px 0;
            padding-bottom: 10px;
            border-bottom: 1px dashed #e5e5e5;
        }

        h3 {
            margin-bottom: 15 px;
            font-size: 13px;
            color: #000;
            line-height: 1.6em;
            font-weight: 400;
        }

        .hh3 {
            font-size: 1em;
            border-top: 1px solid #e8e8e8;
        }
    </style>
</head>

<body>
    <link rel="stylesheet" href="mypage.css" />
    <?php
    session_start();
    if (!isset($_SESSION['pz_uid'])) { // 로그인한 상태가 아니면 
        echo "<script>alert('로그인을 하지 않았습니다.')</script>";
        echo "<script>location.href='signin.html'</script>";
    }
    # 세션 데이터 확인하고 로그인 상태 여부 체크하기
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

    <article>
        <?php
        $email = $_SESSION['pz_uid']; # 세션데이터에서 로그인한 회원의 아이디 읽음
        $sql = "select * from member where email = '$email'";
        $result = $conn->query($sql); # 검색된 레코드들이 $result에 저장됨 
        if ($result->num_rows > 0) { # 검색된 레코드 개수가 0개 초과이면 
            $row = $result->fetch_row(); # 레코드를 색인배열로 가져옴
            #var_dump($row);
        }
        ?>
        <div class="mypage-title">
            <h2>마이페이지</h2>
        </div>
        <div class="mypage-box">
            <div class="mypagebox-top">반갑습니다!
                <strong>
                    <?= $uname ?>
                </strong>님
            </div>
            <dl class="area">
                <h3 class="hh3">내 정보</h3>
                <dt>
                    <p class="box">이메일</p>
                </dt>
                <dd>
                    <?= $row[0] ?>
                </dd>
                <dt>
                    <p class="box">연락처</p>
                </dt>
                <dd>
                    <?= $row[3] ?>
                </dd>
                <dt>
                    <p class="box">주소</p>
                </dt>
                <dd>
                    <?= $row[4] ?>
                </dd>
                <dt>
                    <p class="box">가입날짜</p>
                </dt>
                <dd>
                    <?= $row[5] ?>
                </dd>
            </dl>
        </div>
        <div class="mypage-information">
            <!-- <p class="mypage-top">주문 내역 조회</p> -->
            <p class="mypage-bottom">주문 내역 조회</p>
            <!-- <p class="mypage-bottom">상품명</p> -->
            <div class="bodys">
                <?php
                $email = $_SESSION['pz_uid'];
                # 주문날짜의 내림차순으로 정렬해서 검색
                $sql = "select * from porder where email = '$email' order by orddate desc";
                $result = $conn->query($sql);
                if (!$result)
                    die('주문정보 테이블 검색 오류 : ' . $conn->error);
                if ($result->num_rows > 0) {
                    $no = 1;
                    ?>
                    <table id="order">
                        <tr>
                            <th>주문번호</th>
                            <th>주문일자</th>
                            <th>주소</th>
                            <th>주문금액</th>
                            <th>배달료</th>
                            <th>결제금액</th>
                        </tr>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><a href="showorddet.php?ordno=<?= $row['ordno'] ?>"><?= $row['ordno'] ?></a></td>
                                <td>
                                    <?= $row['orddate'] ?>
                                </td>
                                <td>
                                    <?= $row['address'] ?>
                                </td>
                                <td>
                                    <?= $row['amount'] ?>
                                </td>
                                <td>
                                    <?= $row['delamt'] ?>
                                </td>
                                <td>
                                    <?= $row['total'] ?>
                                </td>
                            </tr>
                        <?php } // while() ?>
                    </table>
                <?php } // if() ?>
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
    <script src="home.js"></script>
</body>

</html>