// ログインメニューのドロワー表示
const target = document.getElementById("drawer_on");
const closeBtn = document.getElementById("closeBtn");
const nav = document.getElementById("header__nav_menu");

target.addEventListener("click", () => {
  nav.classList.toggle("in");
});
closeBtn.addEventListener("click", () => {
  nav.classList.toggle("in");
});
