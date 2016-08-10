<?php

namespace Drupal\flattr\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin;
use Drupal\Core\Render\Element;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

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
    global $base_url;

    $build['button'] = array(
      '#type' => 'inline_template',
      // See: http://developers.flattr.net/button/
      // HTML5 code example.
      '#template' => '<a class="FlattrButton" style="display:none;"
        data-flattr-uid="{{username}}"
        href="{{href}}"></a>',
      '#context' => [
        // The flatter account name.
        'username' => $this->configuration['username'],
        // The href should refer to the page which is being "flattered".
        'href' => $base_url . \Drupal::service('path.current')->getPath(),
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
      '#default_value' => isset($this->configuration['username']) ? $this->configuration['username'] : \Drupal::currentUser()->getAccountName(),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['username'] = $form_state->getValue('username');
  }

}
