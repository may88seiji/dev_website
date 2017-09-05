# Triangulum theme

## このテーマの特徴
* 翻訳機能を備えたspreadsheetで変数管理される静的サイト生成ツール
* phpを利用しない、JavaScriptで構成されたテーマです
* spreadsheetの情報取得にGAS(google apps script)を利用しています
* ejsテンプレートを利用しています
* 1言語から利用可能です

## 前提として
#### theme取り込み済みという前提
このREADMEは、Triangulum themeを取り込んだ後の想定で記述しています。  
themeの取り込み方は[こちらから](https://github.com/cinra/project-template/blob/master/src/README.md)  
themeにtriangulumを選択して展開してください

#### cinraのGASプロジェクトclient_secret取得済みという前提
GASスクリプトを利用するにあたり、cinraのgasプロジェクトのclient_secretを所持している必要があります。詳しくは[こちら](https://github.com/cinra/project-template/wiki/%E3%80%90%E9%81%8B%E7%94%A8%E3%80%91GAS%E3%82%BD%E3%83%BC%E3%82%B9%E7%AE%A1%E7%90%86#%E5%88%9D%E6%9C%9F%E6%A7%8B%E7%AF%89)


## OAuth認証
#### CINRAのGAS APIを利用するための認証
triangulum themeでは、CINRAのGASプロジェクトAPIを利用しています。（そちらの詳しくは[こちらから](https://github.com/cinra/project-template/wiki/%E3%80%90%E9%81%8B%E7%94%A8%E3%80%91GAS%E3%82%BD%E3%83%BC%E3%82%B9%E7%AE%A1%E7%90%86)）  
そのため、利用するにはOAuth認証が必要です。  
ここでは、そのための設定を説明します


#### 必要なnpmパッケージを取り込む
GAS のOAuth認証ヘルパーとして、npmパッケージを取り込み、認証を行います

```
[ project-template/src ]$ npm install 
[ project-template/src ]$ gulp gas
```

すると、こんな感じにURLアクセスして認証してほしい旨伝えられるので
![2016-12-05 13 47 41](https://cloud.githubusercontent.com/assets/834927/20874035/958ca094-baf1-11e6-96e8-02acb82c58c2.png)
そのまま、会社のアカウントで認証して、`Enter the code from that page here: `に認証後のcodeを入力します。  
これで事前準備は完了です。


#### tips
* Apps Script Execution APIというgoogleのAPIを利用して、外部環境からGASの関数を実行することを実現しています
* [参考](http://qiita.com/kingpanda/items/8e60a64dc2454f6ae6b5)
* こちらで設定しているTOKENはcallgas.jsの'TOKEN_PATH'に格納されています


## スプレッドシートについて
#### 利用するスプレッドシートのサンプル(google spread sheet との連動)

1. [こちら](https://docs.google.com/spreadsheets/d/1ZRajbTNaDzj2DgWtxW5R4HYTCZHR6usjDY0k5q7TpME/edit#gid=0)を参考に、スプレッドシートを用意します。
 - A-1枠は空欄
 - 1行目が展開する言語のslug(languages.jsonと同じものを指定)
 - 1列名が翻訳キー(ejsで利用)
 - 各ページのmeta情報の翻訳キーは、```
{ pags.jonで指定したmeta_key }/title```,
```{ pags.jonで指定したmeta_key }/keyword```,
```{ pags.jonで指定したmeta_key }/description```
と指定


## 導入
#### 0. client_secret.jsonを所持しているか？
GASスクリプトを利用するにあたり、cinraのgasプロジェクトのclient_secretを所持している必要があります。詳しくは[こちら](https://github.com/cinra/project-template/wiki/%E3%80%90%E9%81%8B%E7%94%A8%E3%80%91GAS%E3%82%BD%E3%83%BC%E3%82%B9%E7%AE%A1%E7%90%86#%E5%88%9D%E6%9C%9F%E6%A7%8B%E7%AF%89)

#### 連携するスプレッドシートの情報を入力
gulp.jsのL: 42あたり`gulp.task('gas', ...`内のresources objectのparametersに

* 連携するスプレッドシートIDをstringで指定
* 取得したいシートの名前をstringで指定

```
  var resources =  {
      function: 'spreadsheetlib_doTranslate' // spreadsheetIdとシート番号を渡すと、その内容をjsonで返してくれる
    , parameters: ['1Evpp70_ynr9osJFR4ZqUHO2hhl7b2gD2tcTE-X4b2qE', 'シート1']
    , devMode: true
  };

```


#### 連携したスプレッドシートの内容を取り込みながらDOM構築
あとは、通常通り以下コマンドで普通にサイト制作していく感じです

```
[ project-template/src ]$ gulp 
```
gulpコマンドのデフォルトは'watch'で、その中の最初にspread sheetの内容を取ってくるコマンドが仕込まれています

## その他ejs部分ざっと説明

jsonで設定した情報を元に、ejsテンプレートを使って、言語展開したページを書き出します。

```
[project-template/src]
 ├ [dist] // 書き出しファイル
 ├ [project_settings]
 │ ├ gas.json // 連携するGAS API設定 ( 必須 )
 │ ├ languages.json // 展開する言語の定義 ( 必須 )
 │ └ pages.json // 展開するページの定義 ( 必須 )
 └ [src]
   ├ [assets]
   │ ├ [img] - ...
   │ ├ [js] - ...
   │ └ [sass] - ...
   ├ [ejs]
   │ ├ _template.ejs // ルートのテンプレート ( 必須 )
   │ └ index.ejs... // 各ejsテンプレート
   └ [language]
     └ translation.json // 翻訳データ ( gasでスプレッドシートと同期 )
```

#### 設定ファイル

- project_settings
 - [pages.json](https://github.com/uunnee/my-template-ejs/blob/master/project_settings/pages.json) : 書き出すページの設定 ( ページのpathやslugなど )
 > - pages
 >  - **path** : 書き出しページのpath。書き出し先が```/sample/index.html```なら```"sample/"```、ルート書き出しなら```""```指定
 >  - **slug** : 書き出しページのslug。```/sample/index.html```なら```"index"```
 >  - **template** : 書き出し先と同じejs以外を使う場合は、rc直下の```"{ejsのファイル名}"```を指定
 >  - **ogtype** : ページのog:type を指定
 >  - **meta_key** : 翻訳時のメタタグのキーを指定 ( 翻訳ファイルからこの値に対応するタイトル・ディスクリプション・キーワードをもってくる )

 - [languages.json](https://github.com/uunnee/my-template-ejs/blob/master/project_settings/languages.json) : 書き出す言語の設定 ( 言語のpathやlabel、slugやlocaleなど )
> - all_languages
>  - 言語のslug : 言語のlabel ( 展開する全ての言語を記載 )
> - languages
>  - **lang** : 言語のslug
>  - **path** : 言語の書き出しpath。ルートに書き出すなら```""```
>  - **locale** : 言語の細かいやつ ( SNSボタンとかにつかいそうな予感 )
- src
 - [ejs/_template.ejs](https://github.com/uunnee/my-template-ejs/blob/master/src/ejs/_template.ejs) : ルートのテンプレート ( WPで言ったらindex.php )。  
 サイトの変数や、細かい情報の設定。( サイトのURLや、app_idなどの設定もあるので要確認 )
 - [language/translation.json](https://github.com/uunnee/my-template-ejs/blob/master/src/language/translation.json) : google spread sheet からGAS経由で落としてくる翻訳データのjson。

#### テンプレート

```_template.ejs``` でjsonから受け取った諸情報を整頓し、メインテンプレートを読み込みます。
メインテンプレートは、```src/{pages.jsonで指定した"template"}.ejs``` か、未指定の場合は ```src/{ページpath}/{ページslug}.ejs``` ( 書き出し先と同じejs ) です。

#### 翻訳

ejs内では、それぞれの言語の翻訳データを```$translation```として保持してます。
テンプレート内で```<%- $translation.sample_text %>```と指定すると、```src/language/translation.json``` の```"sample_text"```の値をもってきます。

翻訳データには、各ページの タイトル、ディスクリプション、キーワード も含まれます。
pages.json で指定した各ページの```"meta_key"```の値を、翻訳データ内から参照します。


#### html書き出し

書き出し先は、```dist/{言語path}/{ページpath}/{ページslug}.html```となります。

## ejs内で利用できる情報たち

#### サイトの情報 ( _template.ejsで指定 )

サイトのURL : ```<%- $site_url %>```
サイトのパス : ```<%- $site_path %>```
他にも_template.ejsにいろいろ設定してあります

#### 全ての言語の情報 ( languages.jsonで指定 )

```$langs``` ( 配列 )
```
  <%
  // slug : label の書き出し
  Object.keys($langs).forEach(function(key) { %>
     <%- key %> : <%- $langs[key] %>
  <% }); %>
```

#### 現在のページの情報

path : ```<%- $path %>``` ( pages.jsonで指定 )
slug : ```<%- $slug %>``` ( pages.jsonで指定 )

#### 現在の言語の情報 ( languages.jsonで指定 )

path : ```<%- $path_lang %>```
slug : ```<%- $lang %>```
locale : ```<%- $locale %>``` ( en_US など )

#### 翻訳データ ( src/language/以下のjsonで指定 )

```$translation``` (jsonデータ)
```<%- $translation.sampletext %>```

#### ex. 言語リストで表示中の言語にカレントをつける

```
<ul>
<% Object.keys($langs).forEach(function(key) {
  var is_current = "";
  var disp_key = key == 'ja' ? "" : key+"/";
  if(key == $lang) is_current = ' class="is-current"' %>
  <li<%- is_current %>><a href="<%- $site_path+disp_key %>"><%- $langs[key] %></a></li>
<% }); %>
</ul>
```

#### ex. ページで表示中のページにカレントをつける

```
<ul>
  <li<% if($slug=="index"&&$path==""){ %> class="is-current"<% } %>><a href="/<%- $lang_path %>">index.html</a></li>
  <li<% if($slug=="page1"&&$path==""){ %> class="is-current"<% } %>><a href="/<%- $lang_path %>page1.html">page1</a></li>
  <li<% if($slug=="index"&&$path=="sample/"){ %> class="is-current"<% } %>><a href="/<%- $lang_path %>sample/">sample/index.html</a></li>
  <li<% if($slug=="index2"&&$path=="sample/"){ %> class="is-current"<% } %>><a href="/<%- $lang_path %>sample/index2.html">sample/index2.html</a></li>
</ul>
```

#### ex. 自分の言語以外の言語リストを出力

```
<%
// alternate
// ( 現在の言語以外の言語のalternateタグを取得 )
$alternate = "";
Object.keys($langs).forEach(function(key) {
  if($lang!==key) $alternate = $alternate+ '<link rel="alternate" hreflang="'+key+'" href="'+$site_url+key+'/" />'+"\n";
});
%>
```

#### ex. 書き出しが /sample/index2.html の場合だけ出力

```
<% if($slug=="index2"&&$path=="sample/") { %>
  <p>これは /sample/index2.html ですが、page2のテンプレートを読んでいます。</p>
<% } %>
```

#### ex. 言語名のついた画像を出力

```
<p><img src="<%- $site_path %>assets/img/sampleimg/<%- $lang %>.png"></p>
```

---
