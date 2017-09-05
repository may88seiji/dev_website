# Front Template

### Front Templateについて
Front側の実装において、いくつかパターンが考えられるかと思います。  
例えば、jQueryを利用した、wordpressで実装するための基本的なテンプレート、例えばes2015のみを利用したい等。  
そのパターンをThemeというくくりでいくつか用意しておいて、実働の初速を加速させる目的で作成しました。  
ユーザはThemeを選択することで、基本的な環境構築は完了した状態から実装を進められます。  
Themeの追加は、PRをマネージャーを通すことで誰でも作成可能ですが、作成着手前にメンバーに構想を相談するのが良いでしょう。

### Front Templateの使い方
####  Themeの展開方法
```
[ project-template/src ]$ npm install
[ project-template/src ]$ npm start
[ project-template/src ]$ npm help

```

#### 例) Aries Templateを選ぶ場合
```
[ project-template/src ]$ npm start
[ project-template/src ]$ themes aries
[ project-template/src ]$ yes
[ project-template/src ]$ npm install
[ project-template/src ]$ gulp watch

```

#### 展開したThemeをclearしたい場合
展開したThemeはプロジェクトで利用されることを想定しています。  
なので、project-template上にはコミットしないでください。  
展開したThemeをgit管理に戻す場合は

```
[ project-template/src ]$ npm start
[ project-template/src ]$ clear-theme
```

でクリアされます。

### その他
* config/default.jsonを持っているので、こちらは自由に設定可能(ansibleから連携予定) 
* Themeのアップデートの仕方が、現状実装したものをTheme配下にコピペしないとコミットできないので、これは何とかしないとまずい 





  



