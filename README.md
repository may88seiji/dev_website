# dev_website

- [Staging](http://stg.takedasei.com/)

---

## Dependencies

- Node.js v5.10.1〜
- Gulp v3.9.1〜
- PHP 7.0

---

## Deplyment

### Production


### Staging


---


### Structure

```sh
.
├── .git
├── .gitignore
├── .vagrant
├── site.yml（VCCWの設定ファイル）
├── README.md
├── Vagrantfile
├── Movefile
├── gulpfile.js
├── provision/ # VCCWのplaybook
├── sql/ # SQLを収める
├── src/ # プリプロセッサ系のソースファイル（SassやCofeescript）を収める
│   └── node_modules/ # npmインストールしたファイル（gitignore対象）
│   └── package.json # node.js用設定ファイル
├── wiki/ # ドキュメント
│   └── .git # gitで別管理
└── www/ # プロジェクトルート
    └── html/ # ドキュメントルート
```
