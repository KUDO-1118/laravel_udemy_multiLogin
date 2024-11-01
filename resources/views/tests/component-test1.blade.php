<x-tests.app>
    <x-slot name="header">ヘッダー１</x-slot>
  コンポーネントテスト１

  <x-tests.card title="タイトル1" content="本文" :message="$message" />
  <x-tests.card title="タイトル2" />
  {{--【コメント】 propsを活用した処理 --}}
  <x-tests.card title="CSSを変更したい" class="bg-red-300" />
</x-tests.app>
