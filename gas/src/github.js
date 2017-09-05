/**
 * githubと連携する用の処理をまとめたGAS
 **/
var githublib = {
      vars: {
          USERNAME: ''// github username
        , TEST_TOKEN: '' // 現状personal access token対応
        , ISSUE_TITLE: '【GAS／通知アシスタント】翻訳シートに更新がありました'
        , REPOSITORY: ''
        , userProperties: PropertiesService.getUserProperties()
      }
    , initUi: function(){}
    , dispRepos: function(){}
    , dispSend: function(){}
    , getRepos: function(){}
    , save: function(){}
    , onEditExecute: function(){}
    , postIssue: function(){}
};



/**
 * ファイルが開かれた時に、UIを追加
 * 現状、モジュール管理ができないため使われないと思う
 */
githublib.initUi = function(){
  SpreadsheetApp.getUi()
    .createMenu('GitHub')
    .addItem('リポジトリを設定', 'cinragasapis.githublib.dispRepos')
    .addItem('更新通知（Issue投稿）', 'cinragasapis.githublib.dispSend')
    .addToUi();
}


/**
 * getRepos()の結果を、HTMLに渡す
 */
githublib.dispRepos = function() {
  var repos = githublib.getRepos();
  Logger.log(repos);
  var template = HtmlService.createTemplateFromFile('exportDialog');
  template.repos = repos;
  var page = template.evaluate();
  SpreadsheetApp.getUi()
    .showModalDialog(page, 'Export');
}


/**
 * 送信ボタンを表示
 */
githublib.dispSend = function() {
  var template = HtmlService.createTemplateFromFile('sendDialog');
  var page = template.evaluate();
  SpreadsheetApp.getUi()
    .showModalDialog(page, 'Export');
}



/**
 * リポジトリリストを取得
 */
githublib.getRepos = function() {
  var response = UrlFetchApp.fetch('https://api.github.com/users/' + githublib.vars.USERNAME + '/repos?access_token=' + githublib.vars.TEST_TOKEN);
  var repos = [];
  response = JSON.parse(response);
  for (var i = 0; i < response.length; i++) {
    repos.push(response[i].name);
  }
  return repos;
}


/**
 * 選択されたリポジトリを保存
 */
githublib.save = function(form) {
  Logger.log(form.repos);
  //REPOSITORY = form.repos;
  var newProperties = { repo: form.repos };
  githublib.vars.userProperties.setProperties(newProperties);
}


/**
 * 送信イベントハンドラ
 */
githublib.send = function() {
  githublib.postIssue('test');
}

/**
 * シートに変更があった時に実行
 */
githublib.onEditExecute = function(e) {

  if ( e.source.getSheetName() === 'Log') {
    return;
  }

  var sheet = e.source.getActiveSheet(),
        range = sheet.getDataRange(),
        dataLength = range.getValues()[0].length,
        row = e.range.getRow(),
        col = e.range.getColumn();
}


/**
 * 引数の内容でイシューを投稿
 */
githublib.postIssue = function(v) {
  var prop = githublib.vars.userProperties.getProperties();
  Logger.log(prop.repo);
  if( !prop.repo ) {
    Browser.msgBox('リポジトリが設定されていません。');
    return;
  }
  Logger.log(v);
  var raw_payload = {}, options = {},
      payload;

  row_payload = {
    'title': githublib.vars.ISSUE_TITLE + '- ' + new Date(),
    'body' : v
  };

  payload = JSON.stringify(row_payload);

  options = {
    'method' : 'POST',
    'payload':  payload
  };
  Logger.log(options);
  var response = UrlFetchApp.fetch('https://api.github.com/repos/' + githublib.vars.USERNAME + '/' + prop.repo + '/issues?access_token=' + githublib.vars.TEST_TOKEN, options);
  Logger.log(response);
}


