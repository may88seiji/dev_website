import shell from 'shell';
import fs from 'fs-extra';
import path from 'path';
import colors from 'colors';

const exec = require('child_process').exec;
const setup = new shell();
const PKG = require('./package.json');

let _stack = [];

console.log('>> Type "help" or press enter for a list of commands.'.yellow);


/**
 * シェル環境設定
 */
setup.configure( () => {
  setup.use(shell.history({
    shell: setup
  }));
  setup.use(shell.completer({
    shell: setup
  }));
  setup.use(shell.router({
    shell: setup
  }));
  setup.use(shell.help({
    shell: setup,
    introduction: false
  }));
})


/**
 * 型判定処理
 */
function isArray (item) {
  return Object.prototype.toString.call(item) === '[object Array]';
}
function isObject (item) {
  return typeof item === 'object' && item !== null && !isArray(item);
}


/**
 * 存在判定処理
 */
function isExistFile(file) {
  try {
    fs.statSync(file);
    return file
  } catch(err) {
    if(err.code === 'ENOENT') return false
  }
}


/**
 * ファイル一覧取得処理
 */
function getFileList(path) {
  return new Promise((resolve, reject) => {
    let fileList = [];

    fs.readdir(path, (err, files) => {
      if(err) {
        reject(err);
        return;
      }

      files.forEach((file) => {
        if(!file.match(/\.DS_Store|(.*)\.log$|info.json/)) {
          fileList.push(file);
        }
      });

      resolve(fileList);
    })
  })
}


/**
 * リジェクト時処理
 */
function onRejected(err) {
  console.log(`${ err }`.red);
}


/**
 * インストール済パッケージのロード処理
 */
function loadPackages() {

  console.log('>> Load installed packages...'.yellow);
  getFileList(PKG.path.packages)
    .then((file) => {
      file.forEach( (filename) => {
        let filepath = path.join(PKG.path.packages, filename);
        let infoData = `./${filepath}/info.json`;
        let detail;
        let result = {};

        if(fs.statSync(filepath).isDirectory()) {

          result[filename] = {
            'files': null
          }

          detail = isExistFile(infoData) || false;

          if(isObject(detail)) {
            Object.keys(detail).forEach( (key) => {
              result[filename][key] = detail[key];
            })
          }

          _stack.push(result);
        }
      })
      console.log('Complete!'.yellow);
    }).catch(onRejected);
}


/**
 * インストール済パッケージの表示処理
 */
function ls() {
  _stack.forEach( (file) => {
    let list;
    let key;
    let detail = {};

    key = Object.keys(file)[0];

    detail.description = file[key].description ? file[key].description : '';
    if(detail.description) {
      list = `> ${ key } ${ detail.description }`;
    } else {
      list = `> ${ key }`;
    }

    console.log(list.white);
  });
}


/**
 * package.jsonへのマージ
 */
function mergePackageJson(beforeJson, afterJson) {

  if(!isObject(afterJson)){
    console.log('引数がオブジェクトではありません');
    return;
  }

  Object.keys(afterJson).forEach( (key) => {
    beforeJson[key] = afterJson[key];
    // if(key.match(/devDependencies|dependencies/)) {
    // } else if(!PKG[key]) {
    //   PKG[key] = ''; //キーがない場合は項目を削除
    // }
  })

  Object.keys(beforeJson).forEach( (key) => {
    if(!afterJson[key]) {
      beforeJson[key] = '';
    }
  })

  return beforeJson;
}


/**
 * パッケージの展開処理
 */
function select(theme) {
  let pick = _stack[0][theme] || false;

  if(!pick) {
    console.log(`${theme} は存在しません`.gray);
    return;
  }

  let filepath = path.join(PKG.path.packages, theme);

  getFileList(`./${filepath}`)
    .then((files) => {
      files.forEach((file) => {
        let filepath = path.join(PKG.path.packages, `${theme}/${file}`);

        if(file.match(/package\.json/)) {
          let selectPackageJson = require(`./${filepath}`);
          let activePackageJson = require('./package.json');

          let merged = mergePackageJson(activePackageJson, selectPackageJson);
          fs.writeFile('./package.json', JSON.stringify(merged, null, '\t'), () => { });
        } else {
          exec(`cp -r ${filepath} ./`);
        }
      })

    }).catch(onRejected);
}


/**
 * コマンド定義
 */
setup.cmd('select :value', 'Select package', (req, res, next) => {
  res.cyan(`Setup project -> ${ req.params.value }`);
  select(req.params.value);

  //res.prompt();
})

setup.cmd('ls', 'Show installed packages', (req, res, next) => {
  ls();
  res.prompt();
})


/**
 * 起動時にパッケージを読み込み
 */
loadPackages();


// setup.cmd('themes :value', 'テーマを選択', function(req, res, next){
//   // console.log("選択するテーマ: " + req.params.value);

//   var
//         _flg = false
//       , _targetInt = 0
//   ;
//   for(var i = 0; i < themesName.length; i += 1){
//     if(themesName[i] == req.params.value){
//       _flg = true;
//       _targetInt = i;
//       res.cyan("選択するテーマ: " + req.params.value);
//       console.log(conf.themesDescription[req.params.value]);
//       req.confirm('選択されたテーマでよろしいですか？', function(req, res, next){
//         if(req == true){
//           // 対象テーマのリソースをコピー
//           copyThemesFiles(themesName[_targetInt]);
//         }else{
//           setup.prompt();
//         }
//       });
//     }
//   }
//   if(_flg == false){
//     console.log("その星座(themes)は存在しません 再度入力してください");
//     res.prompt();
//   }
// });


// // 一度選択したテーマを削除したいとき
// setup.cmd('clear-themes', '選択したテーマを削除', function(req, res, next){
//   req.confirm('選択されたテーマを削除します。よろしいですか？', function(req, res, next){
//     if(req == true){
//       clearThemes();
//     }else{
//       setup.prompt();
//     }
//   });
// });


// // テーマの説明をみる
// setup.cmd('themes-help :value', 'テーマの簡単な説明', function(req, res, next){

//   Object.keys(conf.themesDescription).forEach(function(f){
//     if(conf.themesDescription[req.params.value] == undefined){
//       res.cyan(f);
//       console.log(conf.themesDescription[f]);
//     }else{
//       if(req.params.value == f){
//         res.cyan(f);
//         console.log(conf.themesDescription[f]);
//       }
//     }
//   });

//   setup.prompt();

// });



// // 一度選択されたテーマを削除する
// function clearThemes(){
//   var walk = function(p, fileCallback, errCallback) {
//     fs.readdir(p, function(err, files) {
//       if (err) {
//         errCallback(err);
//         return;
//       }

//       var
//             _i = 0
//           , packageOldFlg = false
//       ;

//       files.forEach(function(f) {
//         _i += 1;
//         var
//             // to full-path
//             fp = path.join(p, f)
//           , flg = false
//         ;

//         for(var j = 0; j < defaltFilesName.length; j += 1){
//           if(defaltFilesName[j] == f){
//             flg = true;
//           }
//         }
//         if(f == packageJsonDefaltName){
//           packageOldFlg = true;
//         }

//         if(flg == false){
//           exec('rm -rf ' + fp);
//         }

//         if(files.length == _i){
//           if(packageOldFlg == true){
//             exec('rm -rf package.json', function(err, stdout, stderr){
//               exec('mv ' + packageJsonDefaltName + ' package.json', function(){
//                 console.log('remove them completely without node_modules.');
//                 setup.quit();
//               });
//             });
//           }else{
//             console.log('remove them completely without node_modules.');
//             setup.prompt();
//           }
//         }

//       });
//     });
//   };


//   // 使う方
//   walk('./', function(path) {
//     // console.log(path); // ファイル１つ受信
//   }, function(err) {
//     console.log("Receive err:" + err); // エラー受信
//   });
// }



// function startSearchThemes(){
//   var walk = function(p, fileCallback, errCallback) {
//     fs.readdir(p, function(err, files) {
//       if (err) {
//         errCallback(err);
//         return;
//       }

//       var _i = 0;
//       files.forEach(function(f) {
//         _i += 1;
//         var fp = path.join(p, f); // to full-path
//         if(fs.statSync(fp).isDirectory()) {
//           // console.log(f);
//           themesName.push(f);
//           // walk(fp, fileCallback); // ディレクトリなら再帰
//         } else {
//           fileCallback(fp); // ファイルならコールバックで通知
//         }

//         if(files.length == _i){
//           startConsole();
//         }

//       });
//     });
//   };


//   // 使う方
//   walk('./themes/', function(path) {
//     // console.log(path); // ファイル１つ受信
//   }, function(err) {
//     console.log("Receive err:" + err); // エラー受信
//   });
// }


// // themes取得したので、prompt開始
// function startConsole(){
//   var _str = '';

//   for(var i = 0; i < themesName.length; i += 1){
//     _str += _str != '' ? ', ' : '( ';
//     _str += themesName[i];
//   }

//   _str += ' )';

//   console.log('which themes do you use?' + _str );
//   setup.prompt();
//   console.log('(ex: $ themes aries');
//   setup.prompt();
// }


// // tssmesのコピー
// function copyThemesFiles(_theme){
//   console.log(_theme + ' をコピる');

//   var walk = function(p, fileCallback, errCallback) {
//     fs.readdir(p, function(err, files) {
//       if (err) {
//         errCallback(err);
//         return;
//       }

//       var _i = 0;
//       files.forEach(function(f) {
//         _i += 1;
//         var fp = path.join(p, f); // to full-path


//         for(var i = 0; i < ignoreFilesName.length; i += 1){
//           if(ignoreFilesName[i] == f){
//             console.log(f + ' こぴらない');
//             // directory copyしたくないファイル
//             return;
//           }
//         }


//         if(fs.statSync(fp).isDirectory()) {
//           console.log(f + ' こぴる');
//           exec('cp -r ' + fp + ' ./');
//         } else {
//           var _packageJson;
//           if(f == 'package.json'){
//             _packageJson = require('./' + fp);

//             // 中身精査して、npm packageのマージ
//             function _recursive(_obj, _targetAddObj){
//               Object.keys(_obj).forEach(function(key){
//                 if(typeof _obj[key] === 'object'){
//                   if(_targetAddObj[key] == undefined){
//                     _targetAddObj[key] = _obj[key];
//                   }else{
//                     _recursive(_obj[key], _targetAddObj[key]);
//                   }
//                 }else{
//                   if(_targetAddObj[key] == undefined){
//                     _targetAddObj[key] = _obj[key];
//                   }else{
//                     // なんか書いてある場合はさわらない
//                   }
//                 }
//               });
//             }
//             _recursive(_packageJson, packageJson);

//           }else{
//             console.log(f + ' こぴる');
//             exec('cp ' + fp + ' ./');
//           }

//         }

//         if(files.length == _i){
//           //package.json.defaultがないときのみ
//           exec('ls', function(err, stdout, stderr){

//             function writePackageJson(){
//               fs.writeFile('./package.json', JSON.stringify(packageJson, null, '\t'), function(err){
//                 console.log('▼ ▼  package.jsonを確認して、"$npm install" をおねがいします');
//                 exec('cat package.json', function(err, stdout, stderr){
//                   console.log(stdout);
//                   console.log('▲ ▲  package.jsonを確認して、"$npm install" をおねがいします');
//                   setup.quit();
//                 });
//               });
//             }

//             // console.log(stdout);

//             if(stdout.indexOf(packageJsonDefaltName) != -1){
//               writePackageJson();
//             }else{
//               exec('cp package.json ' + packageJsonDefaltName , function(err, stdout, stderr){
//                 writePackageJson();
//               });
//             }

//           });
//         }

//       });
//     });
//   };


//   // 使う方
//   walk('./themes/' + _theme, function(path) {
//     // console.log('ファイルなので考える');
//   }, function(err) {
//     console.log("Receive err:" + err); // エラー受信
//   });
// }



// // スタート
// //
// startSearchThemes();


