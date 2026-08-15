# PHP TDD Learning

**PHP 8.2 以降を、テストから実装へ進む形で学ぶ実行可能な教材**です。各実装済み章には、完成実装、PHPUnit の振る舞いテスト、最初に書くテストと次の一歩を記した日本語ガイドがあります。

この教材は [Learn Go with Tests][1] の「テストで言語と設計を学ぶ」という方針から着想を得ています。ただし原典の文章・コードは複製していません。PHP の strict types、例外、名前空間、インターフェース、標準ファイル API を使う教材として独自に構成しています。原典との対応と未実装範囲は [coverage-matrix.md](coverage-matrix.md) に明記しています。

> **進め方:** 最初のテストを実行して失敗を観察し、最小の実装で通し、重複や命名を整えます。完成コードを先に読むのではなく、テスト名と失敗メッセージを次の小さな変更の手掛かりにしてください。

## 必要環境

| 項目 | 要件 |
|---|---|
| PHP | 8.2 以上 |
| Composer | 2.x |
| テスト | PHPUnit 11（`composer install` で取得） |

PHPUnit では `TestCase` を継承したテストクラスとアサーションを使います。本教材もこの公式の基本構成に従います。[2]

## 開始方法

```bash
composer install
composer test
composer testdox
composer lint
```

`composer test` は全テスト、`composer testdox` は振る舞いを文章風に表示します。`composer lint` は `src/` と `tests/` に含まれるすべての PHP ファイルを構文検査します。

## 学習順序

| 区分 | 章 | 主題 | ガイド | 完成実装 |
|---|---|---|---|---|
| 基礎 | 01 | 文字列と既定値 | [Greeting](php-fundamentals/01-greeting.md) | `src/Fundamentals/Greeting.php` |
| 基礎 | 02 | 数値と純粋関数 | [Numbers](php-fundamentals/02-numbers.md) | `src/Fundamentals/Arithmetic.php` |
| 基礎 | 03 | 反復と境界値 | [Iteration](php-fundamentals/03-iteration.md) | `src/Fundamentals/Repeater.php` |
| 基礎 | 04 | 配列と累積処理 | [Collections](php-fundamentals/04-collections.md) | `src/Fundamentals/NumberList.php` |
| 基礎 | 05 | 値オブジェクト・例外・不変条件 | [Wallet](php-fundamentals/05-wallet.md) | `src/Fundamentals/{Money,Wallet}.php` |
| アプリケーション | 06 | 依存性注入と手書きスパイ | [Dependency Injection](build-an-application/06-dependency-injection.md) | `src/Application/ReportService.php` |
| アプリケーション | 07 | JSON ファイル I/O | [File I/O](build-an-application/07-file-io.md) | `src/Application/JsonTodoStore.php` |
| アプリケーション | 08 | HTTP 境界と入力検証 | [HTTP Boundary](build-an-application/08-http-boundary.md) | `src/Application/GreetingEndpoint.php` |
| 補足 | 09 | 実践の進め方と発展課題 | [Next Steps](questions-and-answers/09-next-steps.md) | — |

`SUMMARY.md` は章だけを連続して読むための索引です。設計判断は [DESIGN.md](DESIGN.md)、原典との対応範囲は [coverage-matrix.md](coverage-matrix.md) で確認できます。

## TDD の最小サイクル

| 段階 | 行うこと | 確認すること |
|---|---|---|
| Red | 一つの振る舞いを表すテストを書く | テストが期待どおりに失敗する |
| Green | テストを通す最小限の実装を加える | 全テストが成功する |
| Refactor | 重複・命名・責務を改善する | テストが安全網として成功し続ける |

一度に複数の振る舞いを加えないことが重要です。失敗時には、まずテスト名、期待値、実際値、入力の型を確認し、次の最小実験を決めてください。

## リポジトリ構成

```text
src/                      完成実装
  Fundamentals/           PHP の基本概念
  Application/            依存・I/O・HTTP 境界
tests/                    PHPUnit の振る舞いテスト
php-fundamentals/         基礎章のガイド
build-an-application/     アプリケーション章のガイド
questions-and-answers/    補足ガイド
DESIGN.md                 PHP 固有の設計判断
SUMMARY.md                学習順序の索引
coverage-matrix.md        原典との対応と進捗
```

## 参照

[1]: https://github.com/quii/learn-go-with-tests "quii/learn-go-with-tests"
[2]: https://docs.phpunit.de/en/12.5/writing-tests-for-phpunit.html "Writing Tests for PHPUnit"
