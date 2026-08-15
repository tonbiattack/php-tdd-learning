# 設計方針

## 目的

このリポジトリは、テストを先に書き、小さな実装で通し、読みやすく整える **Red → Green → Refactor** の反復を通じて PHP 8.2 以降を学ぶ教材です。原典の [Learn Go with Tests][1] の設計上の問いを参照しますが、文章・コードを転記せず、PHP の言語機能と標準ライブラリに合わせて再設計しています。

PHPUnit のテストは `PHPUnit\Framework\TestCase` を基底にし、テスト名には `test*` を使います。これは公式文書で示される構成です。[2]

## 実装範囲

| 区分 | 章 | PHP で扱う概念 | テストの焦点 |
|---|---|---|---|
| 基礎 | 01 Greeting | strict types、関数、文字列 | 通常の挨拶と既定値 |
| 基礎 | 02 Numbers | 型宣言、純粋関数 | 加算、ゼロ、負数 |
| 基礎 | 03 Iteration | `for`、文字列連結 | 空文字、文字数 |
| 基礎 | 04 Collections | 配列、走査、例外 | 合計、空配列、境界 |
| 基礎 | 05 Wallet | 値オブジェクト、例外、不変条件 | 入金、出金、残高不足時の状態 |
| アプリケーション | 06 Dependency Injection | インターフェース、手書きスパイ | 呼出し順、委譲 |
| アプリケーション | 07 File I/O | 一時ファイル、JSON、例外 | 保存・復元、壊れた入力 |
| アプリケーション | 08 HTTP Boundary | リクエスト値、レスポンス値、入力検証 | 成功、JSON形式、異常入力 |
| 補足 | 09 Next Steps | TDDの実践と発展課題 | 実装は置かない |

## Go から PHP への置換

| 原典の主題 | PHP 版での表現 | 置換理由 |
|---|---|---|
| struct と method receiver | `final class`、コンストラクタ、メソッド | PHP はオブジェクトと可視性を中心にドメインの不変条件を表せる。 |
| error 戻り値 | ドメイン例外 | PHP の通常の失敗通知は例外であり、PHPUnit の `expectException()` で明確に検証できる。 |
| interface | 小さな `interface` と手書きスパイ | 依存の方向と相互作用を、外部ライブラリなしで観測できる。 |
| `io.Reader` とファイル | `FileStore` と一時ファイル | PHP 標準の `file_get_contents()` / `file_put_contents()` を安全な境界に閉じ込める。 |
| HTTP handler | フレームワーク非依存の `GreetingEndpoint` | Web フレームワーク固有の設定を避け、HTTP境界の入出力と検証に集中できる。 |
| goroutine、channel、select、context | 初版では未実装 | PHP CLI の基礎学習として非同期ランタイムを導入しない。拡張候補として対応表に明記する。 |

## ディレクトリ規約

`src/` に完成実装、`tests/` に PHPUnit の振る舞いテストを置きます。学習順序と最初のテストは `php-fundamentals/`、`build-an-application/`、`questions-and-answers/` に置く章別ガイドで提供します。すべてのクラスは `PhpTddLearning\` 名前空間に属し、Composer の PSR-4 オートロードで解決します。

## 検証規約

テストは `composer test`、構文検査は `composer lint`、静的検査は `composer analyse` で行います。`analyse` は PHPStan を将来的に追加する余地を残しますが、初版では依存を最小限に保つため PHP の組込み構文検査を採用します。テスト対象では `declare(strict_types=1);` を必須とし、公開APIには引数と戻り値の型を付与します。

## 参照

[1]: https://github.com/quii/learn-go-with-tests "quii/learn-go-with-tests"
[2]: https://docs.phpunit.de/en/12.5/writing-tests-for-phpunit.html "Writing Tests for PHPUnit"
