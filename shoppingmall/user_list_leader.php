<!-- 대표한테 보이는 회원목록, 멤버등급 가능 -->
<!DOCTYPE html>
<!-- 회원 리스트 -->
<html>

<head>
    <title>상품 리스트</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <style>
        td {
            width: 10%;
            height: 10%;
        }

        h1 {
            margin-top: 50px;
            margin-bottom: -10px;
            text-align: center;
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
    ?>
    <h1>대표 계정</h1>
    <?php
    # shop_data 테이블의 레코드 검색해서 출력하기 
    include_once('dbconn.php');
    $sql = "SELECT * FROM member WHERE role = 'leader'";
    $result = $conn->query($sql); // select 실행으로 검색된 레코드 집합을 반환
    if ($result->num_rows > 0) { // 검색된 레코드가 있으면 
        while ($row = $result->fetch_assoc()) { // 레코드 한 개를 연관배열 형태로 가져옴 
            ?>
            <table border="1" width=100%>
                <tr>
                    <td>email</td>
                    <td>name</td>
                    <td>pw</td>
                    <td>telno</td>
                    <td>address</td>
                    <td>regdata</td>
                    <td>role</td>
                </tr>
                <tr>
                    <td>
                        <?= $row['email'] ?>

                    </td>
                    <td>
                        <?= $row['name'] ?>

                    </td>
                    <td>
                        <?= $row['pwd'] ?>

                    </td>
                    <td>
                        <?= $row['telno'] ?>

                    </td>
                    <td>
                        <?= $row['address'] ?>

                    </td>
                    <td>
                        <?= $row['regdate'] ?>

                    </td>
                    <td>
                        <?= $row['role'] ?>

                    </td>
                    <br>
                </tr>
            </table>
            </form>
        <?php }
    } else
        echo "등록된 상품이 없습니다.";
    ?>

    <?php
    include_once('dbconn.php');
    ?>
    <h1>관리자 계정</h1>
    <?php
    # shop_data 테이블의 레코드 검색해서 출력하기 
    include_once('dbconn.php');
    $sql = "SELECT * FROM member WHERE role = 'admin'";
    $result = $conn->query($sql); // select 실행으로 검색된 레코드 집합을 반환
    if ($result->num_rows > 0) { // 검색된 레코드가 있으면 
        while ($row = $result->fetch_assoc()) { // 레코드 한 개를 연관배열 형태로 가져옴 
            ?>
            <form action="user_edit.php" method="post">
                <table border="1" width=100%>
                    <tr>
                        <td>email</td>
                        <td>name</td>
                        <td>pw</td>
                        <td>telno</td>
                        <td>address</td>
                        <td>regdata</td>
                        <td>role</td>
                    </tr>
                    <tr>
                        <td>
                            <?= $row['email'] ?>
                            <input type="hidden" name="email" value="<?= $row['email'] ?>">
                        </td>
                        <td>
                            <?= $row['name'] ?>
                            <input type="hidden" name="name" value="<?= $row['name'] ?>">
                        </td>
                        <td>
                            <?= $row['pwd'] ?>
                            <input type="hidden" name="pwd" value="<?= $row['pwd'] ?>">
                        </td>
                        <td>
                            <?= $row['telno'] ?>
                            <input type="hidden" name="telno" value="<?= $row['telno'] ?>">
                        </td>
                        <td>
                            <?= $row['address'] ?>
                            <input type="hidden" name="address" value="<?= $row['address'] ?>">
                        </td>
                        <td>
                            <?= $row['regdate'] ?>
                            <input type="hidden" name="regdate" value="<?= $row['regdate'] ?>">
                        </td>
                        <td>
                            <select name="role">
                                <option value="admin">
                                    admin
                                </option>
                                <option value="user">
                                    user
                                </option>
                            </select>
                            <input type="submit" value="수정하기" />
                        </td>
                        <br>
                    </tr>
                </table>
            </form>
        <?php }
    } else
        echo "등록된 상품이 없습니다.";
    ?>

    <h1>고객 계정</h1>
    <?php
    include_once('dbconn.php');
    $sql = "SELECT * FROM member WHERE role = 'user'";
    $result = $conn->query($sql); // select 실행으로 검색된 레코드 집합을 반환
    if ($result->num_rows > 0) { // 검색된 레코드가 있으면 
        while ($row = $result->fetch_assoc()) { // 레코드 한 개를 연관배열 형태로 가져옴 
            ?>
            <form action="user_edit.php" method="post">
                <table border="1" width=100%>
                    <tr>
                        <td>email</td>
                        <td>name</td>
                        <td>pw</td>
                        <td>telno</td>
                        <td>address</td>
                        <td>regdata</td>
                        <td>role</td>
                    </tr>

                    </a>
                    <tr>
                        <td>
                            <?= $row['email'] ?>
                            <input type="hidden" name="email" value="<?= $row['email'] ?>">
                        </td>
                        <td>
                            <?= $row['name'] ?>
                            <input type="hidden" name="name" value="<?= $row['name'] ?>">
                        </td>
                        <td>
                            <?= $row['pwd'] ?>
                            <input type="hidden" name="pwd" value="<?= $row['pwd'] ?>">
                        </td>
                        <td>
                            <?= $row['telno'] ?>
                            <input type="hidden" name="telno" value="<?= $row['telno'] ?>">
                        </td>
                        <td>
                            <?= $row['address'] ?>
                            <input type="hidden" name="address" value="<?= $row['address'] ?>">
                        </td>
                        <td>
                            <?= $row['regdate'] ?>
                            <input type="hidden" name="regdate" value="<?= $row['regdate'] ?>">
                        </td>
                        <td>
                            <select name="role">
                                <option value="user">
                                    user
                                </option>
                                <option value="admin">
                                    admin
                                </option>
                            </select>
                            <input type="submit" value="수정하기" />
                        </td>
                        <br>
                    </tr>
                </table>
            </form>
        <?php }
    } else
        echo "등록된 상품이 없습니다.";
    ?>
</body>

</html>