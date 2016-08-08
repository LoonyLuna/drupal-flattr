<?php

namespace Drupal\flattr;

use \Drupal\Core\Block\BlockBase;
use \Drupal\Core\Link;
use \Drupal\Core\Plugin;
use \Drupal\Core\Render\Element;
use \Drupal\Core\Url;
use \Drupal\user\Entity\User;

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
   *
   * @FormElement("button")
   */
  public function build() {
    $build['button'] = array(
      '#type' => 'inline_template',
      '#template' => "{% trans %} Hello {% endtrans %}",
      '#context' => [
        '#title' => 'Flattr',
        '#uid' => 'flattr',
        '#tags' => 'text, opensource',
        '#category' => 'text',
        '#href' => 'https://flattr.com/',
      ],
    );
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

  /**
   * BuildConfigurationForm.
   *
   * @return mixed
   *   Return the form.
   */
  public function buildConfigurationForm() {
    public PluginFormInterface::buildConfigurationForm(array $form, FormStateInterface $form_state);
    $form = parent::buildConfigurationForm();
    $form['username'] = array(
      '#type' => 'textfield',
      '#title' => 'username',
    );
    return $form;
  }

}
