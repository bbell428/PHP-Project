// 초기값 설정
const menuBtn = document.querySelector(".Menu");
const menuContent = document.querySelector(".menu-content");
const tabs = document.querySelectorAll(".tab");

let isMenuOpen = false;

menuBtn.addEventListener("click", function () {
  if (isMenuOpen) {
    menuContent.style.display = "none";
    isMenuOpen = false;
    for (let i = 0; i < tabs.length; i++) {
      tabs[i].style.display = "none"; // 각 탭을 보이도록 설정
    }
  } else {
    menuContent.style.display = "block";
    isMenuOpen = true;
    for (let i = 0; i < tabs.length; i++) {
      tabs[i].style.display = "block"; // 각 탭을 숨기도록 설정
    }
  }
});

function changeImage(imageSrc) {
  var image = document.getElementById("image");
  image.src = imageSrc;
}

window.addEventListener("resize", toggleInputVisibility);

// 창 너비에 따라 input 가시성 토글
function toggleInputVisibility() {
  var input = document.getElementById("search");
  if (window.innerWidth >= 700) {
    input.style.display = "none"; // 입력란 숨김
  } else {
    input.style.display = "block"; // 입력란 표시
  }
}

// 초기 로드 시에도 가시성 확인
toggleInputVisibility();

/// 버튼과 카운트 요소 가져오기
function count(type) {
  // 결과를 표시할 element
  const resultElement = document.getElementById("result");

  // 현재 화면에 표시된 값
  let number = parseInt(resultElement.innerText);

  // 더하기/빼기
  if (type === "plus") {
    number = Math.min(number + 1, 5);
  } else if (type === "minus") {
    number = Math.max(number - 1, 0);
  }

  // 결과 출력
  resultElement.innerText = number;
}
