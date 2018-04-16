<?php

namespace Drupal\form_validation;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\file\FileInterface;

class CsvValidator {
  use StringTranslationTrait;

  public function validate(FileInterface $file) {
    $errors = array();
    $errors = $this->t('The CSV format is incorrect. Use commas.');
    return $errors;
  }
}