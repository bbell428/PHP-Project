<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="main.css" />
    <title>상품 주문</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        input[type=text],
        input[type=password],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        input[type=submit] {
            background-color: #454545;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            float: right;
        }

        input[type=submit]:hover {
            background-color: #ccc;
        }

        input[readonly] {
            background-color: #ccc;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .col-25 {
            float: left;
            width: 25%;
            margin-top: 6px;
        }

        .col-75 {
            float: left;
            width: 75%;
            margin-top: 6px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .fonts {
            text-align: center;
        }

        body {
            text-align: center;
        }

        #item {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }

        #item td,
        #item th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #item tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #item tr:hover {
            background-color: #ddd;
        }

        #item th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #454545;
            color: white;
        }

        #item img {
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
    <?php
    include_once('dbconn.php');
    $uname = $_SESSION['pz_uname'];
    $email = $_SESSION['pz_uid'];
    # 새로운 주문번호를 생성. 현재 마지막 주문번호를 가져와서 순번을 하나 증가시켜야 함
    $sql = "select max(ordno) maxordno from porder";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    # 주문번호 형태는 년월일-순번 으로 정함
    $today = date('Y') . date('m') . date('d'); // 20230530 결과가 나옴
    # porder 테이블에서 검색한 가장 큰 주문번호의 년월일 부분을 떼어내기 
    $prefix = substr($row['maxordno'], 0, strpos($row['maxordno'], '-'));
    if ($today == $prefix) { # 오늘날짜로 이미 주문한 내역이 존재하는 경우 
        $no = substr($row['maxordno'], strpos($row['maxordno'], '-') + 1, 2);
        $no++;
        $ordno = $prefix . "-" . $no;
    } else # 오늘 첫번째 주문
        $ordno = $today . "-01"; # 20230530-01 형식으로 생성
    
    $sql = "select sum(price) amount from cart where email = '$email'";
    $result = $conn->query($sql); // select 실행 결과는 1건 나옴
    $row = $result->fetch_assoc();
    $amount = $row['amount']; // sum(price) 결과 값을 가져옴
    $no = 0;
    ?>
    <div class="fonts">
        <br><br>
        <h2>상품 주문</h2>
        <p>장바구니에 담긴 상품을 주문합니다.</p>
    </div>
    <hr>

    <table id="item">
        <?php
        # 세션 시작하기, DB 연결하기
        # SELECT SQL 구문 작성하고 실행하기
        $email = $_SESSION['pz_uid'];
        $sql = "select cart.*, img from cart, shop_data
            where email = '$email' and items = item";
        $result = $conn->query($sql);
        if (!$result) { // SQL 실행 오류 상태. $result에 false 값이 들어감. 
            die('장바구니 검색 오류 발생');
        }
        if ($result->num_rows > 0) {
            ?>
            <tr>
                <th>No</th>
                <th colspan="2">상품</th>
                <th>사이즈</th>
                <th>수량</th>
                <th>가격</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                $no++;
                ?>
                <tr>
                    <td>
                        <?= $no ?>
                    </td>
                    <td><img src="images/<?= $row['img'] ?>"></td>
                    <td>
                        <?= $row['items'] ?>
                    </td>
                    <td>
                        <?= $row['size'] ?>
                    </td>
                    <td>
                        <?= $row['qty'] ?>
                    </td>
                    <td>
                        <?= $row['price'] ?>
                    </td>
                </tr>

            <?php } ?>
        <?php } ?>

        <?php
        # 세션 시작하기, DB 연결하기
        # SELECT SQL 구문 작성하고 실행하기
        $email = $_SESSION['pz_uid'];
        $sql = "select cart.*, img from cart, recommended
            where email = '$email' and items = item";
        $result = $conn->query($sql);
        if (!$result) { // SQL 실행 오류 상태. $result에 false 값이 들어감. 
            die('장바구니 검색 오류 발생');
        }
        if ($result->num_rows > 0) {
            ?>
            <tr>
                <th>No</th>
                <th colspan="2">추천 상품</th>
                <th>사이즈</th>
                <th>수량</th>
                <th>가격</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                $no++;
                ?>
                <tr>
                    <td>
                        <?= $no ?>
                    </td>
                    <td><img src="images/<?= $row['img'] ?>"></td>
                    <td>
                        <?= $row['items'] ?>
                    </td>
                    <td>
                        <?= $row['size'] ?>
                    </td>
                    <td>
                        <?= $row['qty'] ?>
                    </td>
                    <td>
                        <?= $row['price'] ?>
                    </td>
                </tr>

            <?php } ?>
        <?php } ?>

        <?php
        # 세션 시작하기, DB 연결하기
        # SELECT SQL 구문 작성하고 실행하기
        $email = $_SESSION['pz_uid'];
        $sql = "select cart.*, img from cart, special
            where email = '$email' and items = item";
        $result = $conn->query($sql);
        if (!$result) { // SQL 실행 오류 상태. $result에 false 값이 들어감. 
            die('장바구니 검색 오류 발생');
        }
        if ($result->num_rows > 0) {
            ?>
            <tr>
                <th>No</th>
                <th colspan="2">특가 상품</th>
                <th>사이즈</th>
                <th>수량</th>
                <th>가격</th>
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                $no++;
                ?>
                <tr>
                    <td>
                        <?= $no ?>
                    </td>
                    <td><img src="images/<?= $row['img'] ?>"></td>
                    <td>
                        <?= $row['items'] ?>
                    </td>
                    <td>
                        <?= $row['size'] ?>
                    </td>
                    <td>
                        <?= $row['qty'] ?>
                    </td>
                    <td>
                        <?= $row['price'] ?>
                    </td>
                </tr>

            <?php } ?>
        <?php } ?>
    </table>


    <br><br>
    <?php $email = $_SESSION['pz_uid']; # 세션데이터에서 로그인한 회원의 아이디 읽음
    $sql = "select * from member where email = '$email'";
    $result = $conn->query($sql); # 검색된 레코드들이 $result에 저장됨 
    if ($result->num_rows > 0) { # 검색된 레코드 개수가 0개 초과이면 
        $row = $result->fetch_row(); # 레코드를 색인배열로 가져옴
        #var_dump($row);
    } ?>
    <div class="container">
        <form action="ordernewproc.php" method="post">
            <div class="row">
                <div class="col-25">
                    <label for="fname">주문자</label>
                </div>
                <div class="col-75">
                    <input type="text" name="uname" value="<?= $uname ?>" readonly>
                    <input type="text" name="email" value="<?= $email ?>" hidden>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">주문번호</label>
                </div>
                <div class="col-75">
                    <input type="text" name="ordno" value="<?= $ordno ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">배달주소</label>
                </div>
                <div class="col-75">
                    <input type="text" name="address" placeholder="Address.." value="<?= $row[4] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">주문금액</label>
                </div>
                <div class="col-75">
                    <input type="text" name="amount" value="<?= $amount ?>" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="fname">배달료</label>
                </div>
                <div class="col-75">
                    <input type="text" name="delamt" value="2000">
                </div>
            </div>
            <div class="row">
                <input type="submit" value="주문하기">
            </div>
        </form>
    </div>
</body>

</html>