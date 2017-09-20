# project name

新規自社メディア 

（仮）
- [Staging]()

---

## Dependencies

- Node.js v5.10.1〜
- Gulp v3.9.1〜
- PHP 7.0

---

## Deplyment

### Production


### Staging


### Local
#### /etc/hosts

```shell
192.168.33.41    
```

#### Vagrant
（VCCW）

```bash
$ vagrant up
$ vagrant ssh
$ sudo vi /etc/apache2/sites-available
# 000-default.confを選択, document rootを /var/www/html に変更
$ sudo service apache2 restart
```

#### Wordmove
（保留）
```bash
$ sudo apt-get update
$ sudo apt-get upgrade
$ sudo apt-get install yum
$ cd 
$ sudo apt-get install git build-essential libssl-dev
$ git clone https://github.com/sstephenson/rbenv.git ~/.rbenv
$ git clone https://github.com/sstephenson/ruby-build.git ~/.rbenv/plugins/ruby-build
$ rbenv install 2.4.0
$ rbenv rehash
$ gem install wordmove
```


#### MySQL

```
$ vagrant ssh
$ cd {{ project_root }}
$ mysql -u vagrant -p {{ project_name }} < sql/latest.sql
```

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