<?php

namespace Drupal\show_count\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\show_count\ShowCountServices\HelloGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class ShowCountController extends ControllerBase {

  /**
   * @var \Drupal\show_count\ShowCountServices\HelloGenerator
   */
  private $helloGenerator;

  /**
   * ShowCountController constructor.
   *
   * @param \Drupal\show_count\ShowCountServices\HelloGenerator $helloGenerator
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $loggerFactory
   */
  public function __construct(HelloGenerator $helloGenerator, LoggerChannelFactoryInterface $loggerFactory) {

    $this->helloGenerator = $helloGenerator;
    $this->loggerFactory = $loggerFactory;
  }

  /**
   * @param int $count
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function says($count = 1) {
//    $keyValueStore = $this->keyValue('show_count');

    $hello = $this->helloGenerator->getHello($count);

//    $keyValueStore->set('show_count', $hello);
//    $hello = $keyValueStore->get('show_count');

    $this->loggerFactory->get('default')->debug($hello);

    return new Response($hello);
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *
   * @return static
   */
  public static function create(ContainerInterface $container) {
    $helloGenerator = $container->get('show_count.hello_generator');
    $loggerFactory = $container->get('logger.factory');

    return new static($helloGenerator, $loggerFactory);
  }

}