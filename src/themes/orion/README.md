# Orion Template

フロント開発用テンプレート。

---

## Dependencies

- Node.js > 5.12.0
- Gulp > latest
- babel-cli > 6.18.0

---

## Usage

### Frontend

```sh
$ sudo npm i
$ gulp
```

グローバルに必要なモジュール（未インストールの場合のみ）
```sh
$ babel --version # バージョンが表示され、6.0.0以上ならば babel-cli は不要
$ sudo npm i -g browserify babel-cli
```

コマンド別処理内容
```sh
$ gulp # watch
```

```sh
$ gulp publish # 画像やcss,jsなどリソースをロスレス圧縮、gzip化、staticからpublic環境へコピー
```

```sh
$ gulp json-dl # 翻訳データをDLして'./languages'に格納。言語ごとに分割。
```

### EJS

#### Delimiter

- include

```

```




--

### Structure


```sh
. # プリプロセッサ系のソースファイル（SassやEjs等）を格納
├── README.md
├── gulpfile.babel.js
├── node_modules/ # gitignore対象
├── gulp_extensions/ # npmに公開していないgulp用pluginを格納（callgas等）
├── └── callgas.js # 翻訳スプレッドシート連携用プラグイン
├── package.json # パッケージ／プロジェクト設定ファイル
├── ejs
│   ├── data
│   ├── layouts
│   │   └── default.ejs # HTMLルート要素を記述。ページは layout-wrapper で結合
│   ├── partials
│   └── index.ejs # HTMLページデータ
├── img
│   └── sprite # PC用sprite画像の切り出しを格納
│       └── mobile # SP用sprite画像の切り出しを格納
├── js
│   ├── libs # ライブラリを格納
│   ├── modules # 開発用ディレクトリ
│   ├── helpers.js
│   ├── project.js # プロジェクト依存かつモジュール化しない軽微・軽量なコードを記述
│   ├── view_base.js # 全モジュール共通で呼ばれるベーススクリプト。トリガーの存在判定などを記述
│   └── main.js
└── scss
    ├── base
    ├── constants
    ├── generated # globbingで[ base, constants, layouts, mixins, modules, utils ]を生成
    ├── layouts
    ├── mixins
    ├── modules
    ├── utils
    ├── print.scss
    └── style.scss # generated に生成されたscssをimport

../
└── www/
    ├── static/ # 静的ドキュメントルート
    └── html/ # ドキュメントルート
```
