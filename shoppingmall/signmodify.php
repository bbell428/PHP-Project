<!-- 회원정보 수정 -->
<!DOCTYPE html>
<html>

<head>
    <title>회원정보수정</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            float: right;
        }

        input[type=submit]:hover {
            background-color: #45a049;
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

        /* 회원탈퇴 css */
        .out {
            text-decoration: none;
            color: red;
        }

        .signmod {
            margin-top: 3%;
            margin-left: 25%;
            width: 50%;
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
    <div class="signmod">
        <h2>회원정보수정</h2>
        <p>회원 정보를 수정합니다.</p>
        <hr>
        <?php
        session_start();
        # 로그인한 회원의 정보를 member 테이블에 가져와서 화면에 표시
        include_once('dbconn.php');
        $email = $_SESSION['pz_uid']; # 세션데이터에서 로그인한 회원의 아이디 읽음
        $sql = "select * from member where email = '$email'";
        $result = $conn->query($sql); # 검색된 레코드들이 $result에 저장됨 
        if ($result->num_rows > 0) { # 검색된 레코드 개수가 0개 초과이면 
            $row = $result->fetch_row(); # 레코드를 색인배열로 가져옴
            #var_dump($row);
        }
        ?>
        <div class="container">
            <form action="signmodproc.php" method="post">
                <div class="row">
                    <div class="col-25">
                        <label for="fname">이메일</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="email" value="<?= $row[0] ?>" id="email" readonly>
                        <button type="button" id="chkbtn" onclick="checkEmail()">중복확인</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">이름</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="uname" value="<?= $row[1] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">비밀번호</label>
                    </div>
                    <div class="col-75">
                        <input type="password" name="pwd" value="<?= $row[2] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">전화번호</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="telno" value="<?= $row[3] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lname">주소</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="address" value="<?= $row[4] ?>">
                    </div>
                </div>

                <div class="row">
                    <input type="submit" value="Submit">
                    <br>
                    <a href="signdel.php" class="out">회원탈퇴</a>
                    <!-- class : out 회원탈퇴 -->
                </div>
            </form>
        </div>
        <?php
        $result->close();
        $conn->close();
        ?>
    </div>
    <script>
        function checkEmail() {
            const email = document.getElementById('email');
            const uid = email.value;
            if (email.value.length == 0) {
                alert("이메일을 입력하여야 합니다.");
            }
            else {
                const xhs = new XMLHttpRequest();
                xhs.onreadystatechange = function () {
                    if (xhs.readyState === xhs.DONE) {
                        if (xhs.status === 200) {
                            //alert(xhs.responseText);
                            const result = JSON.parse(xhs.responseText);
                            //alert(result.succ);
                            if (result.succ === true) alert('이미 등록된 이메일입니다.');
                            else alert('사용가능한 이메일입니다.');
                        }
                    }
                }
                xhs.open('GET', 'checkemail.php?uid=' + uid);
                xhs.send();
            }
        }
            /*
$("#chkbtn").click(function(e){
const email = $('#email').val();
if(email.length == 0) {
alert("이메일을 입력하여야 합니다.");
return;
}
//alert(email);
$.ajax({
url: 'checkemail.php',
data: {uid: email},
type: 'GET',
dataType: 'json',
success: function(data) {
alert(data.succ);
if(data.succ)
alert('이미 등록된 이메일입니다.');
else 
alert('사용가능한 이메일입니다.');
}
});
});*/
    </script>
</body>

</html>