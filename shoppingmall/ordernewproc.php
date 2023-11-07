<?php
# porder 테이블에 신규주문내역 저장한 다음 orditem 테이블에 주문하는 피자들 저장하기
# 마스터 테이블에 먼저 레코드 추가하고 디테일 테이블에 레코드 추가하기
include_once('dbconn.php');
# ordernew.php 에서 전달되는 데이터 가져오기
$email = $_POST['email'];
$ordno = $_POST['ordno'];
$orddate = date('Y/m/d'); # 2023/05/30 
$address = $_POST['address'];
$amount = $_POST['amount'];
$delamt = $_POST['delamt'];
$total = $amount + $delamt;
# 트랜잭션 처리를 위해서 autocommit을 해제하기. autocommit은 하나의 operation 마다 자동 확정.
$conn->autocommit(false);
# 1. porder 테이블에 주문 생성하기
$sql = "insert into porder values('$ordno','$email','$orddate','$address',
        $amount,$delamt,$total)";
if (!$conn->query($sql)) { # insert 실행 중에 오류가 발생했다면 
    # 트랜잭션 처리 과정 중에 오류가 발생하면 롤백을 처리
    $conn->rollback(); # 실행을 취소하기. 실행하기 전 상태로 되돌리기 
    die('주문내역 생성 중에 오류가 발생했습니다.' . $conn->error);
}
# echo "신규 주문이 생성되었습니다.";
# 2. orditem 테이블에 장바구니 물품을 저장하기
$sql = "select * from cart where email = '$email'";
$result = $conn->query($sql);
if (!$result) { # select 오류가 발생해서 $result가 생성되지 못한 것
    $conn->rollback();
    die('장바구니 검색 중에 오류 발생' . $conn->error);
}
if ($result->num_rows > 0) {
    $seq = 0;
    # PreparedStatement 객체 생성
    $pstmt = $conn->prepare("insert into orditem values(?,?,?,?,?,?)");
    # s : string, i : int, d : double, b : blob
    $pstmt->bind_param("sissii", $ordno, $seq, $items, $size, $qty, $price);
    while ($row = $result->fetch_assoc()) {
        $seq++;
        $items = $row['items'];
        $size = $row['size'];
        $qty = $row['qty'];
        $price = $row['price'];
        # PreparedStatement 실행하기
        $result2 = $pstmt->execute();
        if (!$result2) {
            $conn->rollback();
            die('주문 상세내역 저장 중에 오류가 발생했습니다. ' . $conn->error);
        }
    }
}
# 3. cart 테이블에서 장바구니 데이터 삭제하기
$sql = "delete from cart where email = '$email'";
if (!$conn->query($sql)) {
    $conn->rollback();
    die('장바구니 데이터 삭제 중에 오류가 발생했습니다. ' . $conn->error);
}
# 모든 연산이 수행되었으므로 최종 확정하기
$conn->commit();
$conn->autocommit(true); # 반드시 autocommit을 설정하여야 함
echo "<script>alert('주문이 정상적으로 생성되었습니다.');";
echo "location.href='main.php'</script>";
?>