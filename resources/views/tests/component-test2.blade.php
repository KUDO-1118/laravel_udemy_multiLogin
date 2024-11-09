<x-tests.app>
  <x-slot name="header">ヘッダー１</x-slot>

  コンポーネントテスト2
  <x-test-class-base classBaseMessage="メッセージ" />
  <div class="md-4"></div>
  <x-test-class-base classBaseMessage="メッセージ" defaultMessage="初期値メッセージから変更" />
</x-tests.app>

