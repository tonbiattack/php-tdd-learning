# 01. Greeting: 最初のテストと文字列

## 目的

最小の失敗を読み、型付き関数と既定値を追加する流れを学びます。完成実装は [`src/Fundamentals/Greeting.php`](../src/Fundamentals/Greeting.php)、テストは [`tests/Fundamentals/GreetingTest.php`](../tests/Fundamentals/GreetingTest.php) にあります。

## 最初のテスト

まず、名前を受け取って日本語で挨拶する振る舞いだけを表します。

```php
public function testJapaneseGreetingUsesProvidedName(): void
{
    self::assertSame('こんにちは、花子！', Greeting::hello('花子'));
}
```

この時点では `Greeting` が存在しないため、テストは失敗します。`Greeting::hello()` を追加し、まずはこの入力だけを通す実装を作ります。その後で空白の名前を `世界` に置き換えるテスト、英語を選ぶテスト、未知の言語を拒否するテストを一件ずつ足します。

## 完成時の確認

```bash
composer test -- --filter GreetingTest
```

## 次に増やす振る舞い

ユーザーのロケールから既定の言語を決める場合を考えてください。そのときはグローバル状態を直接読まず、小さな `LocaleProvider` を注入する設計へ進むと、テストを独立させやすくなります。
