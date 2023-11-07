<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>shoppingmall</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Document</title>
    <link rel="stylesheet" href="main.css" />
    <style>
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
    <!-- ------------------------------------------------------------------------------------------- -->
    <br><br>
    <h1>🧺장바구니 목록</h1>
    <form action="removecart.php" method="post">
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
                $no = 0;
                ?>
                <tr>
                    <th></th>
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
                        <td><input type="checkbox" name="chk[]" value="<?= $row['items'] ?>@<?= $row['size'] ?>"></td>
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
                    <th></th>
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
                        <td><input type="checkbox" name="chk[]" value="<?= $row['items'] ?>@<?= $row['size'] ?>"></td>
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
                    <th></th>
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
                        <td><input type="checkbox" name="chk[]" value="<?= $row['items'] ?>@<?= $row['size'] ?>"></td>
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
        <button type="submit" class="btn">장바구니삭제</button>
    </form>
    <button class="btn" onclick="location.href='ordernew.php'">상품주문</button>
</body>

</html>