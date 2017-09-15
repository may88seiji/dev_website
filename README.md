#Template

## Wordpress Package

```ssh
$ cd src
$ bower install
$ npm install
$ bundle install
```

**デフォルト管理者**

id: dev / pwd: cvS%zJm(Qn0Ou9(0NT

**www/.gitignore**

- wpとindex.phpがignore対象になっているので、削除

## Docker

### 初期化

```ssh
$ docker-machine start
$ eval $(docker-machine env)
$ docker-compose build
```

### 立ち上げ

```ssh
$ docker-compose up -d
```

---

## Init

**/etc/hosts**

```shell
192.168.33.5    cinra.dev
```

### Vagrant立ち上げ

```bash
$ vagrant up
```

- 「SUDO password: 」と出力されたら、「vagrant」と入力

### Guest Additionsを合わせる

[こちら](https://github.com/cinra/project-template#guest-additions対策)参照

### Ansibleの設定

- `Vagrantfile`を書き換え
  - 仮想環境のIPを指定（hostsに指定した値）：`config.vm.network "private_network", ip: "192.168.33.5"`
  - Synched Folderの設定（本番・ステージングと合わせるのがベスト）：`config.vm.synced_folder "www", "/home/cinra"`
- `ansible/development`に、仮想環境のIPを登録
- `ansible/group_vars/all`に、ユーザー名やパスワードなどを指定
- `ansible/host_vars/development.yml`に、hostsで指定した開発環境のドメイン／ドキュメントルートなどを指定

---

## Dependencies

- Virtual Box
- Vagrant
- Chef
- Chef Solo

### Structure

```
.
├── .git
├── .gitignore
├── README.md
├── Vagrantfile
├── ansible
├── chef
├── deploy - 納品ファイルを書き出す時用
│   └── .git - リポジトリを「deploy」に
├── gruntfile.js
├── node_modules - npmインストールしたファイル（gitignore対象）
├── package.json
├── sql - SQLを収める
├── src - プリプロセッサ系のソースファイル（SassやCofeescript）を収める
├── wiki - ドキュメント
│   └── .git - gitで別管理
└── www - Vagrantのsync folder
    └── html - ドキュメントルート
```

## Issues

### Guest Additions対策

Mac OSXで、ゲストマシン（Linux）のGuest Additionsが合わず、共有フォルダが同期できない問題。
下記操作で解決できる

1. Guest Additionのバージョンを合わせなくてはならないのでVagrantのプラグイン「vagrant-vbguest」が入っていなかったらインストールしておく。 `$ vagrant plugin install vagrant-vbguest`
1. ゲストマシンにログイン `$ vagrant ssh`
1. rootとしてログインしておく `$ sudo su`。
1. kernel-develのインストール：ゲストマシンで、`/etc/yum.conf`を編集。最終行にある`exclude=kernel*`をコメントアウト
1. `yum install -y kernel-devel`が動くようになるので、インストール
1. KERN_DIRを設定：`$ export KERN_DIR=/usr/src/kernels/2.6.32-504.3.3.el6.x86_64`（最後はカーネルのバージョン。`$ export KERN_DIR=/usr/src/kernels/`まで入力して、TABで表示される）
1. kernelのアップデート：`$ yum -y update kernel`
1. kernel周りのインストール：`$ yum -y install kernel-devel kernel-headers dkms gcc gcc-c++`
1. ゲストマシンからログアウト。 `$ exit`（`root`権限に変更していた場合、二回必要です）
1. ゲストマシンを再起動 `# vagrant reload`
