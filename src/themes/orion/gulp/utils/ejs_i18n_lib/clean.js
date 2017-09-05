import del from 'del'
import fs from 'fs-extra'

export default function (file) {

    try {
      fs.statSync(`${ PATH.static_html }/**/*.html`)
    } catch(err) {
      if(err.code === 'ENOENT') return false
    }

    del(file).then(paths => {
      console.log('Deleted files and folders:\n', paths.join('\n'));
    })
}