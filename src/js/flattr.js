/**
 * Created by janet on 10.08.16.
 */

(function() {
  var s = document.createElement('script');
  var t = document.getElementsByTagName('script')[0];

  s.type = 'text/javascript';
  s.async = true;
  s.src = '//api.flattr.com/js/0.6/load.js?'+
    'mode=auto&uid=gargamel&language=sv_SE&category=text';

  t.parentNode.insertBefore(s, t);
})();

window.onload = function() {
    FlattrLoader.render({
      'uid': 'flattr',
      'url': 'http://wp.local',
      'title': 'Title of the thing',
      'description': 'Description of the thing'
    }, 'element_id', 'replace');
  };