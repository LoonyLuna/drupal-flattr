<?php

namespace Drupal\flattr\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'FlattrFieldformatter' formatter.
 *
 * @FieldFormatter(
 *   id = "flattrFieldformatter",
 *   label = @Translation("FlattrFieldformatter"),
 *   field_types = {
 *     "string"
 *   }
 * )
 */
class FlattrFieldformatter extends FormatterBase {

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

    foreach ($items as $delta => $item) {
      // Render each element as markup.
      $elements[$delta] = [
        '#type' => 'markup',
        '#markup' => $this->viewValue($item),
      ];
    }

    return $elements;
  }

}
