<?php

namespace Drupal\flattr\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Html;

/**
 * Plugin implementation of the 'Flattr' formatter.
 *
 * @FieldFormatter(
 *   id = "flattr_field_formatter",
 *   label = @Translation("Flattr"),
 *   field_types = {
 *     "flattr_field_type"
 *   }
 * )
 */
class FlattrFieldFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      // Implement default settings.
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    return [
      // Implement settings form.
    ] + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Implement settings summary.
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    global $base_url;

    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#markup' => $this->viewValue($item),

      $build['button'] = [
        '#type' => 'inline_template',
        // See: http://developers.flattr.net/button/
        // HTML5 code example.
        '#template' => '<a class="FlattrButton" style="display:none;"
      data-flattr-uid="{{ username }}"
      data-flattr-category="{{ category }}"
      href="{{ href }}"></a>',
        '#cache' => [
          'contexts' => [
            'url',
          ],
        ],
        '#context' => [
          // The flatter account name.
          'value' => $this->configuration['value'],
          // The flatter category.
          'category' => $this->configuration['category'],
          // The href should refer to the page which is being "flattered".
          'href' => $base_url . \Drupal::service('path.current')->getPath(),
        ],
        '#attached' => [
          'library' => [
            'flattr/flattr',
            ],
          ],
        ],
      ];
    }

    return $elements;
  }

  /**
   * Generate the output appropriate for one field item.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   One field item.
   *
   * @return string
   *   The textual output generated.
   */
  protected function viewValue(FieldItemInterface $item) {
    // The text value has no text format assigned to it, so the user input
    // should equal the output, including newlines.
    return nl2br(Html::escape($item->value));
  }

}
