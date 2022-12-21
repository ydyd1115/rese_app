// 予約内容のリアルタイム表示確認
new Vue({
    el: '#reserve_form',
  data: {

      time: '時間を選択してください',
      number:'人数を選択してください',
      date:'日付を選択してください',
  },
});


// レビュー書き込みのモーダル表示
const modalOpen = document.getElementById("modalOpen");
const modalClose = document.getElementById("modalClose");
const shop_review__modal = document.getElementById("shop_review__modal");
modalOpen.addEventListener("click", () => {
  shop_review__modal.style.display = "block";
});
modalClose.addEventListener("click", () => {
  shop_review__modal.style.display = "none";
});
window.addEventListener("click", (e) => {
  if (!e.target.closest(".shop_review__modal") && e.target.id !== "modalOpen") {
    shop_review__modal.style.display = "none";
  }
});
