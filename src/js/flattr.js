/**
 * Created by janet on 10.08.16.
 */
window.onload = function() {
    FlattrLoader.render({
      'uid': 'flattr',
      'url': 'http://wp.local',
      'title': 'Title of the thing',
      'description': 'Description of the thing'
    }, 'element_id', 'replace');
  };