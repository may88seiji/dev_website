export default function (PATH) {
  return {
        layoutsDir: `${ PATH.src.ejs }/layouts`,
        assets: PATH.assets,
        partials: 'partials',
        data: `${ PATH.src.ejs }/data`,
        domain: 'https://www.cinra.co.jp/',
        locale: '',
        slug: '',
        path: '',
        filename: '',
        filepath: '',
        meta: '',
        curdetailnum: '',
        fbappid: '1630560497157753',
        relativePath: ''
      };
}