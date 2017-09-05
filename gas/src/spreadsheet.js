/** 
 * spreadsheets系の処理をまとめたGAS 
 **/


var spreadsheetlib = {
    vars:{

    }
  , getSheetName: function(){ }
  , SpreadSheet2Json: function(){ }
  , doTranslate: function(){ }
  , doTranslates: function(){ }
};

spreadsheetlib.getSheetName = function(sheetId) {
  var ss = SpreadsheetApp.openById(sheetId);
  var sheets = ss.getSheets();
  return sheets.map(function(sheet) {
    return sheet.getName();
  });
}

spreadsheetlib.SpreadSheet2Json = function(sheet) {
  var colStartIndex = 1;
  var rowNum = 1;
  var firstRange = sheet.getRange(1, 1, 1, sheet.getLastColumn());
  var firstRowValues = firstRange.getValues();
  var titleColumns = firstRowValues[0];

  // after the second line(data)
  var lastRow = sheet.getLastRow();
  var rowValues = [];
  for(var rowIndex=2; rowIndex<=lastRow; rowIndex++) {
    var colStartIndex = 1;
    var rowNum = 1;
    var range = sheet.getRange(rowIndex, colStartIndex, rowNum, sheet.getLastColumn());
    var values = range.getValues();
    rowValues.push(values[0]);
  }

  // create json
  var json = new Object;
  for(var j=1; j<titleColumns.length; j++) {
    json[titleColumns[j]] = new Object();
    for(var i=0; i<rowValues.length; i++) {
      var line = rowValues[i];
      if ( line[0].indexOf('/') != -1) {
        var subline = line[0].split('/');
        if(!json[titleColumns[j]][subline[0]]) json[titleColumns[j]][subline[0]] = new Object;
        json[titleColumns[j]][subline[0]][subline[1]] = line[j];
      } else {
        json[titleColumns[j]][line[0]] = line[j];
      }
    }
  }
  return json;
}

// 翻訳システムで利用している関数
spreadsheetlib.doTranslate = function(spredId, sheetName) {
  var book = SpreadsheetApp.openById(spredId);
  var sheet = book.getSheetByName(sheetName);
  var json = spreadsheetlib.SpreadSheet2Json(sheet);

  return json;
  // これでこけてた
  // return ContentService.createTextOutput(JSON.stringify(json, null, 2))
  //   .setMimeType(ContentService.MimeType.JSON);
}

// 翻訳システムで利用している関数
spreadsheetlib.doTranslates = function(spredId, sheetnameobj) {
  var 
        book = SpreadsheetApp.openById(spredId)
      , names = sheetnameobj.split(',')
      , json = {}
  ;
  for(var i = 0; i < names.length; i += 1){
    var sheet = book.getSheetByName(names[i]);
    json[names[i]] = spreadsheetlib.SpreadSheet2Json(sheet);
  }

  return json;
}












//
// ここから外部APIとして提供する領域
//
function spreadsheetlib_doTranslate(spredId, sheetName){
  return spreadsheetlib.doTranslate(spredId, sheetName);
}

// sheetnameobjにシート名を','でセパレートした文字列
function spreadsheetlib_doTranslates(spredId, sheetnameobj){
  return spreadsheetlib.doTranslates(spredId, sheetnameobj);
}





