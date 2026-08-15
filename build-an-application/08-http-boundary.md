# 08. HTTP Boundary: 入力を検証してレスポンスを返す

## 目的

Web フレームワークの設定を避け、HTTP 境界に必要な入力検証と JSON 応答を小さなクラスとしてテストします。完成実装は [`src/Application/GreetingEndpoint.php`](../src/Application/GreetingEndpoint.php)、テストは [`tests/Application/GreetingEndpointTest.php`](../tests/Application/GreetingEndpointTest.php) です。

## 最初のテスト

```php
$response = (new GreetingEndpoint())->handle(['name' => '花子']);

self::assertSame(200, $response['status']);
self::assertSame(['message' => 'こんにちは、花子！'], json_decode($response['body'], true));
```

最初に成功する JSON レスポンスを定義します。その後、`Content-Type` を含めること、英語を選べること、未対応の言語は 400 を返すことを一件ずつ追加します。最後に配列のような不正な `name` を渡し、型の検証を HTTP 境界で行うことを確認します。

この章の `handle()` は、HTTP サーバーそのものではありません。フレームワークの `Request` と `Response` を接続する前に、テストしやすい入出力契約を確立するための小さな境界です。

## 完成時の確認

```bash
composer test -- --filter GreetingEndpointTest
```

## 次に増やす振る舞い

実際のフレームワークを選び、ルーティング層で `GreetingEndpoint` を呼び出すアダプターを追加してください。アダプターは少数の統合テスト、エンドポイント本体は高速な単体テストで守るように分けます。
