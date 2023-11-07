-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 23-06-19 15:35
-- 서버 버전: 10.4.28-MariaDB
-- PHP 버전: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `shoppingmall`
--
CREATE DATABASE IF NOT EXISTS `shoppingmall` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shoppingmall`;

-- --------------------------------------------------------

--
-- 테이블 구조 `advertising`
--

CREATE TABLE `advertising` (
  `no` int(11) NOT NULL,
  `img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `advertising`
--

INSERT INTO `advertising` (`no`, `img`) VALUES
(1, 'advertising1.jpg'),
(2, 'advertising2.jpg'),
(3, 'advertising3.jpg');

-- --------------------------------------------------------

--
-- 테이블 구조 `board`
--

CREATE TABLE `board` (
  `no` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `wdate` date NOT NULL,
  `title` varchar(60) NOT NULL,
  `content` text NOT NULL,
  `attachment` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `board`
--

INSERT INTO `board` (`no`, `email`, `wdate`, `title`, `content`, `attachment`) VALUES
(1, '대표자', '2023-06-19', '게시글을 작성해보겠습니다.', '게시글을 작성하기 위해선 내용을 작성하고 submit 버튼을 눌러야 합니다.\r\n\r\n', ''),
(2, '대표자', '2023-06-19', '이번엔 이미지다!', '이미지를 한번 넣어보겠습니다.', 'big5.jpg'),
(3, '우진이', '2023-06-19', '회원자로 해보겠다. ', '새로 가입하여 회원자 등급으로 해보겠다.', 'advertising3.jpg'),
(4, '김종혁', '2023-06-19', '한 학기 동안 감사합니다!!', '많은 것을 배울 수 있었습니다.\r\n가장 보람있고 재밌는 강의를 제공해주셔서 진심으로 감사합니다.\r\n', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `cart`
--

CREATE TABLE `cart` (
  `email` varchar(10) NOT NULL,
  `items` varchar(30) NOT NULL,
  `size` char(2) NOT NULL,
  `qty` int(2) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `member`
--

CREATE TABLE `member` (
  `email` varchar(30) NOT NULL,
  `name` varchar(10) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  `telno` char(13) NOT NULL,
  `address` varchar(80) NOT NULL,
  `regdate` date NOT NULL,
  `point` int(11) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`email`, `name`, `pwd`, `telno`, `address`, `regdate`, `point`, `role`) VALUES
('ecsquall', '김종혁', '12345678', '010-1234-1234', '', '2023-06-19', 5000, 'admin'),
('leader', '대표자', '1234', '1234', '경기도 의정부시 의정로202번길', '2023-06-05', 5000, 'leader'),
('qcy088', '우진', '1234', '010-2222-1234', '대진대학교', '2023-06-19', 5000, 'user');

-- --------------------------------------------------------

--
-- 테이블 구조 `orditem`
--

CREATE TABLE `orditem` (
  `ordno` varchar(20) NOT NULL,
  `seq` int(30) NOT NULL,
  `itemname` varchar(30) NOT NULL,
  `size` char(2) NOT NULL,
  `qty` int(3) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `orditem`
--

INSERT INTO `orditem` (`ordno`, `seq`, `itemname`, `size`, `qty`, `price`) VALUES
('20230619-01', 1, 'Ribstop Collar T-shirt', 'M', 1, 110000),
('20230619-2', 1, 'BACK FLARE ONE-PIECE', 'XL', 2, 248000),
('20230619-2', 2, '운동 가자!', 'L', 1, 149000),
('20230619-2', 3, '테스트용 사진', 'M', 1, 12000),
('20230619-3', 1, 'BACK FLARE ONE-PIECE', 'M', 1, 124000),
('20230619-3', 2, 'KIDS TAG POCKET', 'M', 1, 27000),
('20230619-3', 3, 'Two Tuck Wide Black Jeans', 'M', 1, 42000);

-- --------------------------------------------------------

--
-- 테이블 구조 `porder`
--

CREATE TABLE `porder` (
  `ordno` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `orddate` date NOT NULL,
  `address` varchar(80) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `delamt` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `porder`
--

INSERT INTO `porder` (`ordno`, `email`, `orddate`, `address`, `amount`, `delamt`, `total`) VALUES
('20230619-01', 'leader', '2023-06-19', '경기도 의정부시 의정로202번길', 110000, 2000, 112000),
('20230619-2', 'qcy088', '2023-06-19', '경기도 의정부 의정로', 409000, 2000, 411000),
('20230619-3', 'qcy088', '2023-06-19', '대진대학교', 193000, 2000, 195000);

-- --------------------------------------------------------

--
-- 테이블 구조 `recommended`
--

CREATE TABLE `recommended` (
  `no` int(11) NOT NULL,
  `item` varchar(30) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `memo` text NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `kind` varchar(5) NOT NULL,
  `img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `recommended`
--

INSERT INTO `recommended` (`no`, `item`, `comment`, `memo`, `price`, `kind`, `img`) VALUES
(1, 'BACK FLARE ONE-PIECE', '여성을 위한 상품', '수수하지만 고급스러움을 잃지않는 원피스', 124000, '상의', 'onp1.jpg'),
(2, 'NET SUMMER CARDIGAN', '여성을 위한 상품', '고슬고슬한 린넨 원사를 엉기성기한 네트조직', 109000, '상의', 'onp2.jpeg'),
(3, 'MELLAN STRIPE SHIRT', '여성을 위한 상품', 'S/S 가볍게 함께할 수 있는 Mellan stripe shirt', 79000, '상의', 'onp3.jpg'),
(4, 'CRUZ STRIPE ONE-PIECE', '여성을 위한 상품', '잔잔하게 리플가공된 시어서커 스트라이프코튼 소재', 126000, '상의', 'onp4.jpg');

-- --------------------------------------------------------

--
-- 테이블 구조 `shop_data`
--

CREATE TABLE `shop_data` (
  `no` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `memo` text NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `kind` varchar(5) NOT NULL,
  `img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `shop_data`
--

INSERT INTO `shop_data` (`no`, `item`, `comment`, `memo`, `price`, `kind`, `img`) VALUES
(1, '언스트럭쳐 볼캡 LA (Blue)', '남성에게 인기 많은 상품', '파란색은 누구나 호감을 갖습니다.', 36000, '모자', 'cap1.jpg'),
(2, 'Rockstar cap (Black)', '여성에게 인기 많은 상품', '시그니처슬로건인 자수디테일', 54000, '모자', 'cap2.jpg'),
(3, 'Signature Logo ball cap', '여성에게 인기 많은 상품', 'Signature Logo', 32000, '모자', 'cap3.jpg'),
(4, 'SP-Logo Nylon Cap Black', '남성에게 인기 많은 상품', '슬립제 가루가 제품에 묻어 나올 수 있습니다.', 22000, '모자', 'cap4.jpg'),
(5, '홀리데이 시그니처 볼 캡 [그린]', '남성에게 인기 많은 상품', '가을에 어울리는 모자', 35000, '모자', 'cap5.jpg'),
(6, '히트기어 아머 컴프레션 반팔', '남성에게 인기 많은 상품', '운동은 언더아머', 40000, '상의', 'clothes1.jpg'),
(7, 'Ribstop Collar T-shirt', '남성에게 인기 많은 상품', '여름에 입기 좋은 티셔츠', 110000, '상의', 'clothes2.jpg'),
(8, 'KIDS TAG POCKET', '여성에게 인기 많은 상품', '캐쥬얼한 맞춤형 티셔츠', 27000, '상의', 'clothes3.jpg'),
(9, '기본 로고 티셔츠 - 화이트', '여성에게 인기 많은 상품', '심플한 로고 티셔츠', 14000, '상의', 'clothes4.jpg'),
(10, 'TAG KP TEE - WHITE', '남녀에게 인기 많은 상품', '많은 BJ가 입은 티셔츠', 44000, '상의', 'clothes5.jpg'),
(11, 'Two Tuck Wide Black Jeans', '남성에게 인기 많은 상품', '와이드한 바지', 42000, '하의', 'pants1.jpg'),
(12, '와이드 스트링 CN 팬츠 블랙', '남성에게 인기 많은 상품', '여름 경량소재 바지', 39800, '하의', 'pants2.jpg'),
(13, '쿨링 와이드 이지 팬츠 [블랙]', '여성에게 인기 많은 상품', '여름을 책임질 바지', 23300, '하의', 'pants3.jpg'),
(14, '원턱 와이드 스웨트팬츠 블랙', '여성에게 인기 많은 상품', '와이드로 잡는 패션 바지', 36400, '하의', 'pants4.jpg'),
(15, 'Deep One Tuck Sweat ', '남녀에게 인기 많은 상품', '여름대비 반바지', 24000, '하의', 'pants5.jpg'),
(16, '아딜렛 클로그 - 화이트', '남녀에게 인기 많은 상품', '여름 대비 신발', 32000, '신발', 'Shoes1.jpg'),
(17, 'NBPDDS424W ', '남성에게 인기 많은 상품', '신상 뉴발란스 신발', 119000, '신발', 'Shoes2.jpg'),
(18, 'HAYDEN BOOTS', '여성에게 인기 많은 상품', '색다른 디자인을 맛볼 수 있는 신발', 69000, '신발', 'Shoes3.jpg'),
(19, 'MMLG REEBOK CLUB', '남성에게 인기 많은 상품', '편안함을 느낄 수 있는 신발', 119000, '신발', 'Shoes4.jpg'),
(20, ' MAXIMIZER 23', '남녀에게 인기 많은 상품', '23년도 신상 신발', 129000, '신발', 'Shoes5.jpg');

-- --------------------------------------------------------

--
-- 테이블 구조 `special`
--

CREATE TABLE `special` (
  `no` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `memo` text NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `kind` varchar(5) NOT NULL,
  `img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `special`
--

INSERT INTO `special` (`no`, `item`, `comment`, `memo`, `price`, `kind`, `img`) VALUES
(1, '힘차게 출발!', '남녀에게 인기 많은 상품', '컬러 배색이 돋보이는 트랙 팬츠와 반소매 티셔츠를 매치하고 볼캡으로 완성한 스포츠 룩', 232000, '세트', 'special1.jpeg'),
(2, '운동 가자!', '남성에게 인기 많은 상품', '활동하기 좋은 아노락 재킷과 트레이닝 팬츠를 코디하고 롱 패딩으로 보온성을 더한 스포츠 룩', 149000, '세트', 'special2.jpg'),
(3, '넘치는 에너지', '남녀에게 인기 많은 상품', '활동하기 좋은 아노락 셋업과 나일론 재킷을 매치하고 웨이스트 백을 더해 연출한 스포츠 룩', 329000, '세트', 'special3.jpeg');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `advertising`
--
ALTER TABLE `advertising`
  ADD PRIMARY KEY (`no`);

--
-- 테이블의 인덱스 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`no`);

--
-- 테이블의 인덱스 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`email`,`items`,`size`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`email`);

--
-- 테이블의 인덱스 `orditem`
--
ALTER TABLE `orditem`
  ADD PRIMARY KEY (`ordno`,`seq`);

--
-- 테이블의 인덱스 `porder`
--
ALTER TABLE `porder`
  ADD PRIMARY KEY (`ordno`);

--
-- 테이블의 인덱스 `recommended`
--
ALTER TABLE `recommended`
  ADD PRIMARY KEY (`no`);

--
-- 테이블의 인덱스 `shop_data`
--
ALTER TABLE `shop_data`
  ADD PRIMARY KEY (`no`);

--
-- 테이블의 인덱스 `special`
--
ALTER TABLE `special`
  ADD PRIMARY KEY (`no`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `advertising`
--
ALTER TABLE `advertising`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 테이블의 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `recommended`
--
ALTER TABLE `recommended`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 테이블의 AUTO_INCREMENT `shop_data`
--
ALTER TABLE `shop_data`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 테이블의 AUTO_INCREMENT `special`
--
ALTER TABLE `special`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
