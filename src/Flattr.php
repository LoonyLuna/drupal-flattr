<?php

namespace Drupal\flattr;

/**
 * Class Flattr.
 *
 * @package Drupal\flattr
 */
class Flattr {

  /**
   * The Flattr categories.
   *
   * @var array
   */
  public static $categories = [
    'text', 'images', 'video', 'audio', 'software', 'people', 'rest'
  ];

  /**
   * Get the Flattr categories.
   *
   * @return array
   */
  public static function getCategories() {
    return self::$categories;
  }

}
