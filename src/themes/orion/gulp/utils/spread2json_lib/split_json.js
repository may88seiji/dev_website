import fs from 'fs-extra'

export default function (jsonData, savePath) {

  let splitData;
  let infoData = {};

  infoData.language_count = Object.keys(jsonData).length;
  fs.outputFile('./gulp/utils/spread2json_lib/info.json', JSON.stringify(infoData), 'utf-8');

  fs.mkdirsSync(savePath);
  Object.keys(jsonData).forEach((key, i) => {
    splitData = {};
    splitData[key] = jsonData[key];
    fs.writeFile(`${ savePath }/${ key }.json`, JSON.stringify(splitData), (err) => {
      err ? console.log('Error: ' + err) : '';
    })
  })
}