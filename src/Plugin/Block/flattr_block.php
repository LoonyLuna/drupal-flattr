<?php

namespace Drupal\flattr\Plugin\Block;

namespace Drupal\Core;

use Drupal\Core\Block\BlockBase;
use \Drupal\user\Entity\User;

/**
 * Provides a 'flattr_block' block.
 *
 * @Block(
 *  id = "flattr_block",
 *  admin_label = @Translation("Flattr_block"),
 * )
 */
class flattr_block extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['flattr_block']['#markup'] = 'Implement flattr_block.';

    return $build;
  }

  /**
   * Creates a link for the Flattr button in a block.
   * @param $path
   * @param $text
   * @return static
   */
  public function checkURL($path, $text) {
    //Get route name.
    $url_object = \Drupal::service('path.validator')->getUrlIfValid($path);
    $route_name = $url_object->Url::getRouteName();

    //Create URL.
    $url = Url::fromRoute($route_name);
    $internal_link = Link::fromTextAndUrl($text, $url);

    return $internal_link;
  }

  public function loadUser(){
    $user = User::load(\Drupal::currentUser()->id());
    $uid = $user->get('uid')->uid;
    
    return $user;
  }

}