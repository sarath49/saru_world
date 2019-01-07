<?php

namespace Drupal\saru_world\Controller;


use Drupal\Core\Controller\ControllerBase;
use Drupal\saru_world\Services\SaruWorldSalutation;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SaruWorldController extends ControllerBase {

  /**
   * @var \Drupal\saru_world\HelloWorldSalutation
   */
  protected $salutation;

  /**
   * SaruWorldController constructor.
   *
   * @param \Drupal\saru_world\HelloWorldSalutation $salutation
   */
  public function __construct(SaruWorldSalutation $salutation) {
    $this->salutation = $salutation;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('saru_world.salutation')
    );
  }

  /**
   * Helloworld function.
   *
   * @return array
   */
  public function helloworld() {
    return [
      '#markup' => $this->salutation->getSalutation(),
    ];
    return [
      '#markup' => $this->t('Hello from Saru!')
    ];
  }
}