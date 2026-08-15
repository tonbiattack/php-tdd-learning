# 06. Dependency Injection: 境界を注入する

## 目的

出力先を直接作らず、小さなインターフェースとして受け取る設計を学びます。完成実装は [`src/Application/Writer.php`](../src/Application/Writer.php) と [`src/Application/ReportService.php`](../src/Application/ReportService.php)、テストは [`tests/Application/ReportServiceTest.php`](../tests/Application/ReportServiceTest.php) です。

## 最初のテスト

```php
$writer = new RecordingWriter();
$service = new ReportService($writer);

$service->publish('朝会', 3);

self::assertSame(['朝会: 3件完了'], $writer->messages);
```

`RecordingWriter` はテスト内だけの実装で、渡されたメッセージを配列に記録します。実際の標準出力、メール送信、データベースを使わずに、サービスが境界へどの値を渡したかを観察できます。

次に空の題名と負の完了件数を拒否するテストを追加します。不正な入力で `Writer` が呼ばれないことも確認し、失敗した操作が副作用を残さない契約にします。

## 完成時の確認

```bash
composer test -- --filter ReportServiceTest
```

## 次に増やす振る舞い

`Writer` の実装としてファイル、HTTP API、標準出力を追加してください。テストでは引き続き手書きスパイを使い、外部サービスを必要としない高速な単体テストを維持します。
