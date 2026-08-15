# 原典との対応表

この表は [Learn Go with Tests][1] の章を棚卸しし、PHP 版で扱う設計概念と実装状況を明示するものです。表中の **実装済み** は、章ガイド、完成実装、PHPUnit テストのすべてが存在する状態だけを指します。原典の固有コードや文章は移植していません。

## 基礎概念

| 原典の主題 | PHP 版の章 | PHP における表現 | 状態 |
|---|---|---|---|
| Hello, world | 01 Greeting | strict types、既定引数、`match` | 実装済み |
| Integers | 02 Numbers | 型付き純粋関数 | 実装済み |
| Iteration | 03 Iteration | `str_repeat()` と不正引数 | 実装済み |
| Arrays and slices | 04 Collections | `array_sum()`、`foreach`、累積配列 | 実装済み |
| Structs, methods, interfaces | 05 Wallet / 06 DI | `final class`、値オブジェクト、インターフェース | 実装済み |
| Pointers and errors | 05 Wallet | 例外と失敗後の状態不変条件 | 実装済み |
| Maps | 04 Collections | 連想配列の発展課題 | 部分実装 |
| Dependency injection | 06 Dependency Injection | コンストラクタ注入、手書きスパイ | 実装済み |
| Mocking | 06 Dependency Injection | `RecordingWriter` による相互作用の観測 | 実装済み |

## アプリケーション概念

| 原典の主題 | PHP 版の章 | PHP における表現 | 状態 |
|---|---|---|---|
| HTTP server / handlers | 08 HTTP Boundary | フレームワーク非依存のリクエスト値・レスポンス値 | 実装済み |
| JSON | 07 File I/O / 08 HTTP Boundary | `json_encode()`、`json_decode()`、例外 | 実装済み |
| I/O | 07 File I/O | 一時ファイルと `file_get_contents()` / `file_put_contents()` | 実装済み |
| Command line | — | Symfony Console または `$argv` を使う発展課題 | 未着手 |
| HTML templates | — | テンプレートエンジンを選ぶ発展課題 | 未着手 |
| WebSockets | — | 常駐プロセスが必要なため初版の対象外 | 未着手 |

## 高度な主題

| 原典の主題 | PHP 版での扱い | 状態 | 判断 |
|---|---|---|---|
| Concurrency | ReactPHP / Amp などの選定を要する | 未着手 | PHP CLI の基礎教材からは除外する。 |
| Select / Context | 非同期ランタイムのキャンセル設計に依存する | 未着手 | 同上。 |
| Sync / mutex | 実行モデルと拡張に依存する | 未着手 | 同上。 |
| Reflection | PHP Reflection API の単独章として追加可能 | 未着手 | 基礎パス完了後の候補。 |
| Generics | PHPDoc テンプレートと静的解析が必要 | 未着手 | PHPStan/Psalm 導入後の候補。 |
| Benchmarks | phpbench 等の追加ツールが必要 | 未着手 | 初版ではテスト実行速度の観測に留める。 |

> **範囲の考え方:** 本教材は原典の全章をPHP構文に機械変換することを目的にしません。PHPで学ぶ価値が高い「型付き境界、例外、状態不変条件、依存性注入、ファイル・HTTP I/O」を、実行可能な小さな課題として優先します。

## 参照

[1]: https://github.com/quii/learn-go-with-tests "quii/learn-go-with-tests"
