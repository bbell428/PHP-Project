<!-- 특가 상품 수정 페이지 -->
<!DOCTYPE html>
<html>

<head>
    <title>특가 상품 수정</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <?php
    include_once('dbconn.php');
    $no = $_GET['no'];
    $sql = "select * from special where no = '$no'";
    $result = $conn->query($sql); # 검색된 레코드들이 $result에 저장됨  
    $row = $result->fetch_row(); # 레코드를 색인배열로 가져옴
    ?>
    <li>
        특가 상품 수정하는 화면
        <form action="special_editproc.php" method="post" enctype="multipart.form-data">
            <input type="hidden" name="no" value="<?= $row[0] ?>">
            <table width-100% border="1">
                <tr>
                    <td>상품명</td>
                    <td><input type="text" name="item" size="30" value="<?= $row[1] ?>" /></td>
                </tr>

                <tr>
                    <td>짧은 설명</td>
                    <td><input type="text" name="comment" size="50" value="<?= $row[2] ?>" /></td>
                </tr>

                <tr>
                    <td>금액</td>
                    <td><input type="text" name="price" size="20" value="<?= $row[4] ?>" /></td>
                </tr>
                <tr>
                    <td>종류</td>
                    <td>
                        <input type="radio" name="kind" value="모자" checked /> 모자
                        <input type="radio" name="kind" value="상의" /> 상의
                        <input type="radio" name="kind" value="하의" /> 하의
                        <input type="radio" name="kind" value="신발" /> 신발
                    </td>
                </tr>

                <tr>
                    <td>설명</td>
                    <td><textarea name="memo" cols="50" rows="10"></textarea></td>
                </tr>

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