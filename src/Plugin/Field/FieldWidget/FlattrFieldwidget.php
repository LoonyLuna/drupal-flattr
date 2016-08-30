<?php

namespace Drupal\flattr\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'FlattrFieldwidget' widget.
 *
 * @FieldWidget(
 *   id = "flattrFieldwidget",
 *   label = @Translation("FlattrFieldwidget"),
 *   field_types = {
 *     "field_ui:entity_reference:user"
 *   }
 * )
 */
class FlattrFieldwidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'size' => 60,
      'placeholder' => '',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = [];
    $active_value = isset($items[$delta]['active']) ? $items[$delta]['active'] : TRUE;
    $category_value = isset($items[$delta]['category']) ? $items[$delta]['category'] : 0;
    $options = ['text', 'images', 'video', 'audio', 'software', 'people', 'rest'];

    $elements['size'] = [
      '#type' => 'number',
      '#title' => t('Size of textfield'),
      '#default_value' => $this->getSetting('size'),
      '#required' => TRUE,
      '#min' => 1,
    ];
    $elements['placeholder'] = [
      '#type' => 'textfield',
      '#title' => t('Placeholder'),
      '#default_value' => $this->getSetting('placeholder'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    ];

    $element['active'] = [
      '#type' => 'checkbox',
      '#default_value' => $active_value,
      '#title' => t('Provide a Flattr button?'),
    ];

    $element['category'] = [
      '#type' => 'select',
      '#default_value' => $category_value,
      '#options' => $options,
      '#title' => t('Which Flattr category does this belong to?'),
    ];
    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $summary[] = t('Textfield size: @size', ['@size' => $this->getSetting('size')]);
    if (!empty($this->getSetting('placeholder'))) {
      $summary[] = t('Placeholder: @placeholder', ['@placeholder' => $this->getSetting('placeholder')]);
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = isset($this->configuration['username']) ? $this->configuration['username'] : \Drupal::currentUser()->getAccountName();
    $element['username'] = $element + [
      '#type' => 'textfield',
      '#default_value' => $value,
      '#size' => $this->getSetting('size'),
      '#placeholder' => $this->getSetting('placeholder'),
      '#maxlength' => $this->getFieldSetting('max_length'),
      '#empty_value' => '',
    ];

    return $element;
  }

}
