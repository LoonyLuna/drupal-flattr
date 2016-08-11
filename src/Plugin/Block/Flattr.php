<?php

namespace Drupal\flattr\Plugin\Block;

use Drupal\Core\Block\BlockBase;
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

    // Here is an example of how to put some markup into our block.
    $build['hello'] = array(
      '#type' => 'markup',
      '#markup' => '<p><strong>' . 'hello world' . '</p></strong>',
    );

    // So that you can debug your href value, for example.
    $build['href'] = array(
      '#type' => 'markup',
      '#markup' => '<p>' . $base_url . \Drupal::service('path.current')->getPath() . '</p>',
    );

    // Or your username value from the configuration.
    $build['username'] = array(
      '#type' => 'markup',
      '#markup' => '<p>' . $this->configuration['username'] . '</p>',
    );

    // Debugging: make a copy of the button.
    // Take display:none out so that it is visible.
    // Take the javascript attached library out.
    // The button works like this: when the javascript runs it replaces the
    // link we have created.
    // What we are left with is the link that is created by the javascript.
    // That's why it works now even without the picture.
    // Here we display a copy of the button so that you can see what the href
    // is. Then go to the flattr developer documentation and see if you can
    // work out what the reason for the error is.
    $build['button_visible'] = array(
      '#type' => 'inline_template',
      // See: http://developers.flattr.net/button/
      // HTML5 code example.
      '#template' => '<a
        data-flattr-uid="{{username}}"
        href="{{href}}">this is a link we can see and inspect</a>',
      '#context' => [
        // The flatter account name.
        'username' => $this->configuration['username'],
        // The href should refer to the page which is being "flattered".
        'href' => $base_url . \Drupal::service('path.current')->getPath(),
      ],
//      '#attached' => array(
//        'library' => array(
//          'flattr/flattr',
//        ),
//      ),
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
