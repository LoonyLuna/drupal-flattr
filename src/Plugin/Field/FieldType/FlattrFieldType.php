<?php

namespace Drupal\flattr\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'Flattr' field type.
 *
 * @FieldType(
 *   id = "flattr_field_type",
 *   label = @Translation("Flattr"),
 *   description = @Translation("This field is used to display a Flattr button together with your content"),
 *   default_widget ="flattr_field_widget",
 *   default_formatter="flattr_field_formatter"
 * )
 */
class FlattrFieldType extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['username'] = DataDefinition::create('string')
      ->setLabel(t('Username'));
    $properties['category'] = DataDefinition::create('string')
      ->setLabel(t('Category'));
    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = [
      'columns' => [
        'username' => [
          'type' => 'text',
          'size' => 'normal',
          'not null' => FALSE,
        ],
        'category' => [
          'type' => 'text',
          'size' => 'normal',
          'not null' => FALSE,
        ],
      ],
    ];
    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
    $random = new Random();
    $values['username'] = $random->name();
    return $values;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    return !(isset($item['username']));
  }

}
