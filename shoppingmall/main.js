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
