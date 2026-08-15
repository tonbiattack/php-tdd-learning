# 03. Iteration: 反復と境界値

## 目的

繰り返し回数という境界を、通常系だけでなくゼロと不正値まで含めて定義します。完成実装は [`src/Fundamentals/Repeater.php`](../src/Fundamentals/Repeater.php)、テストは [`tests/Fundamentals/RepeaterTest.php`](../tests/Fundamentals/RepeaterTest.php) です。

## 最初のテスト

```php
public function testRepeatsAStringSpecifiedNumberOfTimes(): void
{
    self::assertSame('Go!Go!Go!', Repeater::repeat('Go!', 3));
}
```

まず一つの文字列を三回繰り返します。次に回数がゼロなら空文字を返すテストを追加します。最後に負数を渡したとき `InvalidArgumentException` が投げられることを確認し、入力契約を実装します。

## 完成時の確認

```bash
composer test -- --filter RepeaterTest
```

## 次に増やす振る舞い

文字列ではなく、配列や `Generator` を対象にする反復を考えてください。大きなデータを扱うとき、値をすべてメモリに積むのか遅延評価にするのかを、テストで先に決められます。
