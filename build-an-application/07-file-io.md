# 07. File I/O: JSON を境界に閉じ込める

## 目的

一時ファイルを使って、JSON の保存・復元と不正入力を統合的にテストします。完成実装は [`src/Application/Todo.php`](../src/Application/Todo.php) と [`src/Application/JsonTodoStore.php`](../src/Application/JsonTodoStore.php)、テストは [`tests/Application/JsonTodoStoreTest.php`](../tests/Application/JsonTodoStoreTest.php) です。

## 最初のテスト

```php
$store = new JsonTodoStore($this->path);
$expected = [new Todo('テストを書く'), new Todo('リファクタリングする', true)];

$store->save($expected);

self::assertEquals($expected, $store->load());
```

テストは `setUp()` で一時的なパスを確保し、`tearDown()` で削除します。この方法なら開発者の実データに依存せず、保存から復元までを一つのテストで確認できます。復元後は別インスタンスになるため、ここでは同一性 `assertSame()` ではなく値の等価性 `assertEquals()` を使います。

次に、ファイルがない場合は空リストになること、壊れた JSON は `UnexpectedValueException` として報告されることを追加します。例外を JSON API の内部事情のまま漏らさず、境界の利用者に意味のある失敗へ変換するのが要点です。

## 完成時の確認

```bash
composer test -- --filter JsonTodoStoreTest
```

## 次に増やす振る舞い

原子的なファイル置換、排他制御、スキーマのバージョン番号を追加してみてください。それぞれに失敗時のファイル内容と、同時書込みの振る舞いをテストで先に定義します。
