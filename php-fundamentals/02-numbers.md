# 02. Numbers: 純粋関数と数値

## 目的

入力にだけ依存し、副作用を持たない関数をテストします。完成実装は [`src/Fundamentals/Arithmetic.php`](../src/Fundamentals/Arithmetic.php)、テストは [`tests/Fundamentals/ArithmeticTest.php`](../tests/Fundamentals/ArithmeticTest.php) です。

## 最初のテスト

```php
public function testAddsPositiveIntegers(): void
{
    self::assertSame(5, Arithmetic::add(2, 3));
}
```

最初は `return 5;` のような仮実装でも構いません。次にゼロと負数を足すテストを追加すると、特定の値ではなく `$left + $right` が必要だと分かります。最後に小数を加え、`int|float` という PHP の合併型が期待どおりに働くことを確認します。

## 完成時の確認

```bash
composer test -- --filter ArithmeticTest
```

## 次に増やす振る舞い

金額計算は浮動小数点数に任せず、最小通貨単位の整数または専用の値オブジェクトで表してください。次章以降の `Money` は、この設計上の境界を明示する例です。
