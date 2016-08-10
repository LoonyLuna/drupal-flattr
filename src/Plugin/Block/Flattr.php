<?php

namespace Drupal\flattr\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin;
use Drupal\Core\Render\Element;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;

/**
 * Provides a 'Flattr' block.
 *
 * @Block(
 *  id = "flattr",
 *  admin_label = @Translation("Flattr"),
 * )
 *
 * @RenderElement('inline_template')
 */
class Flattr extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['button'] = array(
      '#type' => 'inline_template',
      '#template' => '<a href="{{href}}" style="border-bottom:none"><img src="{{picture}}"></a>',
      '#context' => [
        'title' => 'Flattr',
        'uid' => 'flattr',
        'tags' => 'text, opensource',
        'category' => 'button',
        'href' => 'http://flattr.com/',
        'picture' => '/sites/default/files/pictures/2016-08/flattr_0.png',
      ],
      '#attached' => array(
        'library' => array(
          'flattr/flattr'
        ),
      ),
    );

    return $build;
  }

  /**
   * BuildConfigurationForm.
   *
   * @return mixed
   *   Return the form.
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    $form['username'] = array(
      '#type' => 'textfield',
      '#title' => 'Username',
      '#default_value' => User::load($this->configuration['uid']),
    );
    return $form;
  }

}
