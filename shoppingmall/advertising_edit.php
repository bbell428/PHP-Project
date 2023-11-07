<!-- 광고 수정 페이지 -->
<!DOCTYPE html>
<html>

<head>
    <title>광고 수정</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <?php
    include_once('dbconn.php');
    $no = $_GET['no'];
    $sql = "select * from advertising where no = '$no'";
    $result = $conn->query($sql); # 검색된 레코드들이 $result에 저장됨  
    $row = $result->fetch_row(); # 레코드를 색인배열로 가져옴
    ?>
    <li>
        상품 수정하는 화면
        <form action="advertising_editproc.php" method="post" enctype="multipart.form-data">
            <input type="hidden" name="no" value="<?= $row[0] ?>">
            <table width-100% border="1">
                <tr>
                    <td>사진</td>
                    <td><input type="file" name="img" size="10" /></td>
                </tr>

                <td colspan="2">
                    <input type="submit" value="수정하기" />
                </td>
            </table>
        </form>
    </li>
</body>

</html>