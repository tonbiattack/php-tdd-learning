# 04. Collections: 配列と累積処理

## 目的

配列の集計と、走査しながら状態を累積する処理をテストします。完成実装は [`src/Fundamentals/NumberList.php`](../src/Fundamentals/NumberList.php)、テストは [`tests/Fundamentals/NumberListTest.php`](../tests/Fundamentals/NumberListTest.php) です。

## 最初のテスト

```php
public function testSumsEveryNumberInTheList(): void
{
    self::assertSame(10, NumberList::sum([1, 2, 3, 4]));
}
```

まず合計を返す振る舞いを作り、次に空配列が `0` になることを追加します。続いて `[1, 2, 3, 4]` から `[1, 3, 6, 10]` を得る累積和を定義します。一つのテストで複数の段階を要求せず、入力と期待値の差を小さく保ってください。

## 完成時の確認

```bash
composer test -- --filter NumberListTest
```

## 次に増やす振る舞い

連想配列の値を集計する、キーごとにグループ化する、空でない配列だけを受け取る、といった契約を追加できます。型が曖昧になる場合は、PHPDoc の配列形状または専用のコレクションクラスを検討します。
