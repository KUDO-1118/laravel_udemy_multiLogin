<p>決済ページへリダイレクトします。</p>
<script src="https://js.stripe.com/v3/"></script>
<script>
  const publicKey = '{{ $publicKey }}'//CartControllerから渡ってくる変数
  const stripe = Stripe(publicKey);

  window.onload = function() {//画面を読み込んだ時の処理
    stripe.redirectToCheckout({
      sessionId: '{{ $session->id }}'//CartControllerの$session情報が入ってくる
    }).then(function(result) {//NGだった場合の処理
      window.location.href = '{{  route('user.cart.index')}}';
    });
  }
</script>
