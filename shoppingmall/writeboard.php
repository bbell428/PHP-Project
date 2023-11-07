<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <title>게시글</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="board.css">
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
    if (!isset($_SESSION['pz_uid'])) { // 로그인하지 않고 글쓰기로 온 상태
      echo "<script>alert('글작성하기 위해서는 로그인을 해야합니다.');";
      echo "location.href = 'signin.html'</script>";
    }
    $email = $_SESSION['pz_uid'];
    $name = $_SESSION['pz_uname'];
    $wdate = date('Y/m/d');
    ?>
    <div class="tab">
      <button type="button" class="tablinks" onclick="location.href='writeboard.php'" id="defaultOpen">게시글작성</button>
      <button type="button" class="tablinks" onclick="location.href='writeboard2.php'" id="defaultOpen">게시글목록</button>
    </div>

    <div id="newboard" class="tabcontent">
      <h2>게시글 작성</h2>
      <p>게시판에 새글을 게시합니다.</p>
      <div class="divider"></div>
      <div class="container">
        <form action="writeboardproc.php" method="post" enctype="multipart.form-data">
          <div class="row">
            <div class="col-25">
              <label for="fname">작성자</label>
            </div>
            <div class="col-75">
              <input type="text" name="email" value="<?= $name ?>" readonly>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="lname">작성일</label>
            </div>
            <div class="col-75">
              <input type="text" name="wdate" value="<?= $wdate ?>" readonly>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="lname">제목</label>
            </div>
            <div class="col-75">
              <input type="text" name="title" placeholder="Title..">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="lname">게시글</label>
            </div>
            <div class="col-75">
              <textarea rows="10" name="note"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="lname">첨부파일</label>
            </div>
            <div class="col-75">
              <input type="file" name="att">
            </div>
          </div>
          <div class="row">
            <input type="submit" value="Submit">
          </div>
        </form>
      </div>
    </div>
</body>

</html>