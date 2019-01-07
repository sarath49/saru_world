<?php

namespace Drupal\saru_world\EventDispatcher;

use Symfony\Component\EventDispatcher\Event;

/**
 * Event class to be dispatched from the HelloWorldSalutation service.
 */
class SalutationEvent extends Event {

  const EVENT = 'saru_world.salutation_event';

  /**
   * The salutation message.
   *
   * @var string
   */
  protected $message;

  /**
   * @return mixed
   */
  public function getValue() {
    return $this->message;
  }

  /**
   * @param mixed $message
   */
  public function setValue($message) {
    $this->message = $message;
  }
}