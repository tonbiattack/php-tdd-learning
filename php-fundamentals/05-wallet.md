# 05. Wallet: 値オブジェクト、状態、例外

## 目的

状態を持つオブジェクトで、不変条件をテストの形で固定します。完成実装は [`src/Fundamentals/Money.php`](../src/Fundamentals/Money.php) と [`src/Fundamentals/Wallet.php`](../src/Fundamentals/Wallet.php)、テストは [`tests/Fundamentals/WalletTest.php`](../tests/Fundamentals/WalletTest.php) です。

## 最初のテスト

```php
public function testWalletStartsWithZeroYen(): void
{
    self::assertSame(0, (new Wallet())->balance()->yen);
}
```

続けて、入金で残高が増えること、出金で減ることを一件ずつ定義します。ここで `int` を直接渡すのではなく `Money` を導入し、金額が負にならない制約を値の生成時に閉じ込めます。

最重要のテストは、残高を超える出金が失敗したあとも残高が変わらないことです。

```php
try {
    $wallet->withdraw(new Money(501));
    self::fail('InsufficientFunds should be thrown.');
} catch (InsufficientFunds) {
    self::assertSame(500, $wallet->balance()->yen);
}
```

例外だけではなく、**失敗後の状態**も確認することで、操作が原子的であるという契約を残せます。

## 完成時の確認

```bash
composer test -- --filter WalletTest
```

## 次に増やす振る舞い

入出金履歴、通貨、日次限度額を追加してみてください。外部の現在時刻を使う機能は、次章のように依存として注入するとテストで制御できます。
