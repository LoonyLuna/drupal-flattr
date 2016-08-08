<?php

namespace Drupal\flattr\Plugin\Block;

namespace Drupal\Core;

use Drupal\Core\Block\BlockBase;
use \Drupal\user\Entity\User;

/**
 * Provides a 'FlattrBlock' block.
 *
 * @Block(
 *  id = "flattrBlock",
 *  admin_label = @Translation("FlattrBlock"),
 * )
 */
class FlattrBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['FlattrBlock']['#markup'] = 'Implement FlattrBlock.';

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