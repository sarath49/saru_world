<?php

namespace Drupal\saru_world\Services;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\saru_world\EventDispatcher\SalutationEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class SaruWorldSalutation
 * Prepare salutition to the world.
 *
 * @package Drupal\saru_world
 */
class SaruWorldSalutation {

  use StringTranslationTrait;

  /**
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  protected $eventDispatcher;

  /**
   * SaruWorldSalutation constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $event_dispatcher
   */
  public function __construct(ConfigFactoryInterface $config_factory, EventDispatcherInterface $event_dispatcher) {
    $this->configFactory = $config_factory;
    $this->eventDispatcher = $event_dispatcher;
  }

  /**
   * Returns the salutation
   */
  public function getSalutation() {

    $config = $this->configFactory->get('saru_world.custom_salutation');
    $salutation = $config->get('salutation');
    if ($salutation != "") {
      //return $salutation;
      $event = new SalutationEvent();
      $event->setValue($salutation);
      $event = $this->eventDispatcher->dispatch(SalutationEvent::EVENT, $event);
      return $event->getValue();
    }

    $time = new \DateTime();
    if ((int) $time->format('G') >= 06 && (int) $time->format('G') < 12) {
      return $this->t('Good morning world');
    }

    if ((int) $time->format('G') >= 12 && (int) $time->format('G') < 18) {
      return $this->t('Good afternoon world');
    }

    if ((int) $time->format('G') >= 18) {
      return $this->t('Good evening world');
    }
  }
}