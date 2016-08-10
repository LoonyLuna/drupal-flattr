<?php

namespace Drupal\flattr\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin;
use Drupal\Core\Render\Element;
use Drupal\Core\Form\FormStateInterface;

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
        'title' => $this->configuration['Flattr'],
        'uid' => $this->configuration['flattr'],
        'tags' => $this->configuration['text, opensource'],
        'category' => $this->configuration['button'],
        'href' => 'http://flattr.com/',
        'picture' => drupal_get_path('module', 'flattr') . '/images/flattr_0.png',
      ],
      '#attached' => array(
        'library' => array(
          'flattr/flattr',
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
      '#default_value' => $this->configuration['uid'],
    );
    return $form;
  }

}
