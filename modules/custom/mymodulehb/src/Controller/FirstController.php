<?php
/**
 * @file
 * Contains \Drupal\mymodulehb\Controller\MyModulehbController
 */

namespace Drupal\mymodulehb\Controller;

use Drupal\Core\Controller\ControllerBase;


/**
 * Class FirstController
 * @package Drupal\mymodulehb\Controller
 */
class FirstController extends ControllerBase {
  public function content() {
    return array(
      '#type' => 'markup',
      '#markup' => t('This is my menu linked custom page'),
    );
  }
}
