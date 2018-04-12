<?php
namespace Drupal\show_count\ShowCountServices;

use Symfony\Component\HttpFoundation\Response;

class HelloGenerator {

  public function getHello($count) {
    return new Response("Hello " . $count);
  }
}