<?php

namespace Drupal\sitestudio_data_transformers\Handlers\FormFieldLevel;

use Drupal\cohesion\LayoutCanvas\Element;

/**
 * Handles Site Studio form fields of "input" type.
 */
class InputHiddenHandler extends FieldHandlerBase implements FormFieldLevelHandlerInterface {

  /**
   * Site Studio Element type id.
   * @todo make these injectable from DIC or at least configurable/changeable by clients.
   */
  const ID = 'form-input-hidden';
  const MAP = '/maps/field_level/input-hidden.map.yml';
  const SCHEMA = '/maps/field_level/input-hidden.schema.json';

  /**
   * {@inheritdoc}
   */
  public function getSchema(Element $form_field = NULL): array {

    if (is_null($form_field)) {
      return json_decode($this->schema, TRUE);
    }

    $settings = $form_field->getModel()->getProperty('settings');
    if (isset($settings->schema) && !empty($settings->schema)) {
      $schema = json_decode($this->schema, TRUE);
      if (isset($settings->schema->maxLength)) {
        //@todo make this cleaner
        $schema['properties']['attributes']['properties']['value']['maxLength'] = $settings->schema->maxLength;
      }
    }

    return $schema;
  }

}