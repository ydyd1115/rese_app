const shopOpenBtn = document.getElementById("shop_edit__openBtn");
const shopCloseBtn = document.getElementById("shop_edit__closeBtn");
const shopModal = document.getElementById("shop_edit__modal");
shopOpenBtn.addEventListener("click", () => {
  shopModal.style.display = "block";
});
shopCloseBtn.addEventListener("click", () => {
  shopModal.style.display = "none";
});


const mailOpenBtn = document.getElementById("send_mail__openBtn");
const mailCloseBtn = document.getElementById("send_mail__closeBtn");
const mailModal = document.getElementById("send_mail__modal");
mailOpenBtn.addEventListener("click", () => {
  mailModal.style.display = "block";
});
mailCloseBtn.addEventListener("click", () => {
  mailModal.style.display = "none";
});
