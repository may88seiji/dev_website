(function(root, factory) {
  // commonJs, browserify
  module.exports = factory(require('./app.js'), ($ || require('jquery')));
}(this, function(PJAPP, $){

  return {
      ua: require('../lib/ua.js')
    , gmap: require('../lib/gmap.js')
    , sharebutton: require('../lib/sharebutton.js')
    , loader: require('../lib/loader.js')
    , touchend: require('../lib/touchend.js')
    , setzoom: require('../lib/setzoom.js')
  }


}));
