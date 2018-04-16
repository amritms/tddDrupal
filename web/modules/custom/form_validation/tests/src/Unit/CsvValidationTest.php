<?php
namespace Drupal\form_validation\Test\Unit;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\file\FileInterface;

use Drupal\form_validation\CsvValidator;
use Drupal\Tests\UnitTestCase;

class CsvValidationTest extends UnitTestCase {
  use StringTranslationTrait;

  protected function setUp() {
    parent::setUp();
    require_once __DIR__ . '/../../../form_validation.module';

    $container = new ContainerBuilder();

    $validator = new CsvValidator();

    $container->set('form_validation.csv_validator', (new CsvValidator()));

    $translations = $this->createMock(TranslationInterface::class);
    $container->set('string_translation', $translations);

    \Drupal::setContainer($container);
  }

  public function testValidation() {
    $file = $this->createMock(FileInterface::class);
    $file->expects($this->any())
      ->method('getFileUri')
      ->will($this->returnValue(__DIR__ . '/../../fixtures/books_incorrect_format.csv'));

    $this->assertEquals($this->t("The CSV format is incorrect. Use commas."),
      form_validation_validate_csv($file)
    );
  }
}