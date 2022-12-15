// 予約内容のリアルタイム表示確認
new Vue({
    el: '#reserve_form',
  data: {

      time: '時間を選択してください',
      number:'人数を選択してください',
      date:'日付を選択してください',
  },
  methods: {
        onSubmit: function() {

        if(!confirm('送信します。よろしいですか？')) {

            return;

        }

        var params = {
            user_id:$user['id'],
            shop_id:$shop['id'],
            date: this.date,
            time: this.time,
            number: this.number
        };
        axios.post('/reserve', params)
            .then(function(response){

                // 成功した時

            })
            .catch(function(error){

                // 失敗したとき

            });

    }
  }
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
