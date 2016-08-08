<?php

namespace Drupal\flattr\Plugin\Block;

use Drupal\Core\Block\BlockBase;

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

}
