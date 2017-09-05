# Front-base

## 1.gulp

### 1-1.config
ファイル生成についての設定。

#### 1-1-1.make
- **device**：[Array] 作成するテンプレートの種類を配列で記載する。

ex.) PC/SPのテンプレート作成の場合

```
device: ['pc','sp']
```

ex.) レスポンシブなど、単一のテンプレート作成の場合

```
device: ''
```

#### 1-1-2.basePaths
- **srcDir**：[String] ソースファイルのディレクトリ
- **dstDir**：[String] フロント確認用の吐き出し先
- **sgDir** ：[String] スタイルガイド用の吐き出し先
- **prdDir**：[String] 組み込み先用の吐き出し先

#### 1-1-3.ports
- **static**：[Number] フロント確認用のport番号。`localhost: {ports.static}` でサイトが確認できる。  
（ 1-1-1. で複数テンプレートの作成を選択した場合は、ここで指定した`port`,`port+10*n` でそれぞれデバイスごとの確認ができる。ex. `localhost: 8000`がPC、`localhost: 8010`がsp ）
- **styleguide**：[Number] スタイルガイド用のport。`localhost:{ports.styleguide}`でスタイルガイドが確認できる。

#### 1-1-4.use
- **templateEngine**：[String] html生成用のテンプレートエンジンの選択。現状ejsかpugを選択できる
- **es6**：[boolean] jsでes6を使用するか否か
- **styleguide**：[boolean] cssスタイルガイドを作成するか否か

### 1-2.gulpfile.js
タスク呼び出し元ファイルとして使用。

### 1-3.gulp/tasks
- **connect.js**：ローカル確認用
- **imgmin.js**：画像圧縮
- **js-minify.js**：jsのconcatとminify（browserify使用）
- **sass.js**：sassのコンパイル
- **sprite.js**：スプライト画像生成
- **styleguide.js**：スタイルガイド生成
- **templ.js**：テンプレートエンジンからhtml生成
- **watch.js**：ファイル監視

## 2.sass
### 2-1.プロジェクト用sass
下記に格納

- 単一テンプレート：`src/assets/sass`
- 複数テンプレート：`src/assets/theme/{pc|sp|tb..}/sass`  
	テンプレート共有：`src/assets/theme/shared/sass`  

#### 2-1-1.ファイルの分割
- **style.scss**：呼び出し元
- **_var.scss**：変数の定義
- **_mixin.scss**：mixin,function置き場
- **_font.scss**：font指定（webfont/iconfont含む）
- **_base.scss**：html,bodyなどタグに直接指定するstyle
- **_layout.scss**：レイアウト要素への指定
- **module/{name}.scss**：モジュール要素への指定。モジュールごとにファイルをわけてmoduleディレクトリに格納する（**※**）
- **_helper.scss**：ヘルパー用class
- **_print.scss**：印刷用css

##### ※ディレクトリ内のsassファイルをまとめて読み込む場合
ディレクトリのあとにアスタリスクを記載することでディレクトリ配下のsassファイルが読み込まれる。

ex.) style.scss

```
@import 'module/*';
```

### 2-2.common sass
汎用的に使えるスタイルを格納（theme外）

