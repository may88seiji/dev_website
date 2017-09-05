var
    shell = require('shell')
  , fs = require('fs')
  , exec = require('child_process').exec
  , path = require('path')
  , dir = process.argv[2] || '.'
  , app = new shell()
  , packageJson = require('./package.json')
  , packageJsonDefaltName = 'package.json.default'
  , conf = require('config')
  , themesDescription = {}
    // clearしたいときに残したいファイル名称
  , defaltFilesName = ['themes', 'common', 'init.js', 'package.json', packageJsonDefaltName, 'node_modules', 'README.md', 'config']
    // themesのselectからのコピーでコピー上書きされるとまずいファイル（package.jsonは除く）
  , ignoreFilesName = ['init.js', 'README.md', 'config', 'themes']
  , themesName = []
;


/////
/////
///// 対象themes取得
/////
/////

app.configure(function() {
  app.use(shell.history({
    shell: app
  }));
  app.use(shell.completer({
    shell: app
  }));
  app.use(shell.router({
    shell: app
  }));
  app.use(shell.help({
    shell: app,
    introduction: true
  }));
});


app.cmd('themes :value', 'テーマを選択', function(req, res, next){
  // console.log("選択するテーマ: " + req.params.value);

  var
        _flg = false
      , _targetInt = 0
  ;
  for(var i = 0; i < themesName.length; i += 1){
    if(themesName[i] == req.params.value){
      _flg = true;
      _targetInt = i;
      res.cyan("選択するテーマ: " + req.params.value);
      console.log(conf.themesDescription[req.params.value]);
      req.confirm('選択されたテーマでよろしいですか？', function(req, res, next){
        if(req == true){
          // 対象テーマのリソースをコピー
          copyThemesFiles(themesName[_targetInt]);
        }else{
          app.prompt();
        }
      });
    }
  }
  if(_flg == false){
    console.log("その星座(themes)は存在しません 再度入力してください");
    res.prompt();
  }
});


// 一度選択したテーマを削除したいとき
app.cmd('clear-themes', '選択したテーマを削除', function(req, res, next){
  req.confirm('選択されたテーマを削除します。よろしいですか？', function(req, res, next){
    if(req == true){
      clearThemes();
    }else{
      app.prompt();
    }
  });
});


// テーマの説明をみる
app.cmd('themes-help :value', 'テーマの簡単な説明', function(req, res, next){

  Object.keys(conf.themesDescription).forEach(function(f){
    if(conf.themesDescription[req.params.value] == undefined){
      res.cyan(f);
      console.log(conf.themesDescription[f]);
    }else{
      if(req.params.value == f){
        res.cyan(f);
        console.log(conf.themesDescription[f]);
      }
    }
  });

  app.prompt();

});



// 一度選択されたテーマを削除する
function clearThemes(){
  var walk = function(p, fileCallback, errCallback) {
    fs.readdir(p, function(err, files) {
      if (err) {
        errCallback(err);
        return;
      }

      var
            _i = 0
          , packageOldFlg = false
      ;

      files.forEach(function(f) {
        _i += 1;
        var
            // to full-path
            fp = path.join(p, f)
          , flg = false
        ;

        for(var j = 0; j < defaltFilesName.length; j += 1){
          if(defaltFilesName[j] == f){
            flg = true;
          }
        }
        if(f == packageJsonDefaltName){
          packageOldFlg = true;
        }

        if(flg == false){
          exec('rm -rf ' + fp);
        }

        if(files.length == _i){
          if(packageOldFlg == true){
            exec('rm -rf package.json', function(err, stdout, stderr){
              exec('mv ' + packageJsonDefaltName + ' package.json', function(){
                console.log('remove them completely without node_modules.');
                app.quit();
              });
            });
          }else{
            console.log('remove them completely without node_modules.');
            app.prompt();
          }
        }

      });
    });
  };


  // 使う方
  walk('./', function(path) {
    // console.log(path); // ファイル１つ受信
  }, function(err) {
    console.log("Receive err:" + err); // エラー受信
  });
}



function startSearchThemes(){
  var walk = function(p, fileCallback, errCallback) {
    fs.readdir(p, function(err, files) {
      if (err) {
        errCallback(err);
        return;
      }

      var _i = 0;
      files.forEach(function(f) {
        _i += 1;
        var fp = path.join(p, f); // to full-path
        if(fs.statSync(fp).isDirectory()) {
          // console.log(f);
          themesName.push(f);
          // walk(fp, fileCallback); // ディレクトリなら再帰
        } else {
          fileCallback(fp); // ファイルならコールバックで通知
        }

        if(files.length == _i){
          startConsole();
        }

      });
    });
  };


  // 使う方
  walk('./themes/', function(path) {
    // console.log(path); // ファイル１つ受信
  }, function(err) {
    console.log("Receive err:" + err); // エラー受信
  });
}


// themes取得したので、prompt開始
function startConsole(){
  var _str = '';

  for(var i = 0; i < themesName.length; i += 1){
    _str += _str != '' ? ', ' : '( ';
    _str += themesName[i];
  }

  _str += ' )';

  console.log('which themes do you use?' + _str );
  app.prompt();
  console.log('(ex: $ themes aries');
  app.prompt();
}


// tssmesのコピー
function copyThemesFiles(_theme){
  console.log(_theme + ' をコピる');

  var walk = function(p, fileCallback, errCallback) {
    fs.readdir(p, function(err, files) {
      if (err) {
        errCallback(err);
        return;
      }

      var _i = 0;
      files.forEach(function(f) {
        _i += 1;
        var fp = path.join(p, f); // to full-path


        for(var i = 0; i < ignoreFilesName.length; i += 1){
          if(ignoreFilesName[i] == f){
            console.log(f + ' こぴらない');
            // directory copyしたくないファイル
            return;
          }
        }


        if(fs.statSync(fp).isDirectory()) {
          console.log(f + ' こぴる');
          exec('cp -r ' + fp + ' ./');
        } else {
          var _packageJson;
          if(f == 'package.json'){
            _packageJson = require('./' + fp);

            // 中身精査して、npm packageのマージ
            function _recursive(_obj, _targetAddObj){
              Object.keys(_obj).forEach(function(key){
                if(typeof _obj[key] === 'object'){
                  if(_targetAddObj[key] == undefined){
                    _targetAddObj[key] = _obj[key];
                  }else{
                    _recursive(_obj[key], _targetAddObj[key]);
                  }
                }else{
                  if(_targetAddObj[key] == undefined){
                    _targetAddObj[key] = _obj[key];
                  }else{
                    // なんか書いてある場合はさわらない
                  }
                }
              });
            }
            _recursive(_packageJson, packageJson);

          }else{
            console.log(f + ' こぴる');
            exec('cp ' + fp + ' ./');
          }

        }

        if(files.length == _i){
          //package.json.defaultがないときのみ
          exec('ls', function(err, stdout, stderr){

            function writePackageJson(){
              fs.writeFile('./package.json', JSON.stringify(packageJson, null, '\t'), function(err){
                console.log('▼ ▼  package.jsonを確認して、"$npm install" をおねがいします');
                exec('cat package.json', function(err, stdout, stderr){
                  console.log(stdout);
                  console.log('▲ ▲  package.jsonを確認して、"$npm install" をおねがいします');
                  app.quit();
                });
              });
            }

            // console.log(stdout);

            if(stdout.indexOf(packageJsonDefaltName) != -1){
              writePackageJson();
            }else{
              exec('cp package.json ' + packageJsonDefaltName , function(err, stdout, stderr){
                writePackageJson();
              });
            }

          });
        }

      });
    });
  };


  // 使う方
  walk('./themes/' + _theme, function(path) {
    // console.log('ファイルなので考える');
  }, function(err) {
    console.log("Receive err:" + err); // エラー受信
  });
}



// スタート
//
startSearchThemes();


