<?php

namespace Drupal\flattr;

use \Drupal\Core\Block\BlockBase;
use \Drupal\Core\Link;
use \Drupal\Core\Plugin;
use \Drupal\Core\Url;
use \Drupal\user\Entity\User;

/**
 * Provides a 'Flattr' block.
 *
 * @Block(
 *  id = "flattr",
 *  admin_label = @Translation("Flattr"),
 * )
 */
class Flattr extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['Flattr']['#markup'] = 'Implement Flattr.';

    return $build;
  }

  /**
   * Creates a link for the Flattr button.
   *
   * @param $path
   *   UrlPath.
   * @param $text
   *   Text.
   *
   * @return static
   */
  public function checkUrl($path, $text) {
    // Get route name.
    $url_object = \Drupal::service('path.validator')->getUrlIfValid($path);
    $route_name = $url_object->Url::getRouteName();

    // Create URL.
    $url = Url::fromRoute($route_name);
    $internal_link = Link::fromTextAndUrl($text, $url);

    return $internal_link;
  }

  /**
   * Load User.
   *
   * @return \Drupal\Core\Entity\EntityInterface|null|static
   *   Return User.
   */
  public function loadUser() {
    $user = User::load(\Drupal::currentUser()->id());
    $uid = $user->get('uid')->uid;

    return $user;
  }

  public function buildConfigurationForm(){
    public PluginFormInterface::buildConfigurationForm(array $form, FormStateInterface $form_state);
    $form['username'] = array(
      '#type' => 'inline_template',
      '#title' => 'username',
    );
    return $form;
  }

}
?>

<html>
  <head>
    <script type="text/javascript">
      window.onload = function() {
        FlattrLoader.render({
          'uid': 'flattr',
          'url': 'https://flattr.com/',
          'title': 'Flattr Button',
          'description': 'Donate Button from Flattr'
        }, 'element_id', 'replace');
      }
    </script>
  </head>

  <body>
    <div id="element_id"></div>
  </body>
</html>
