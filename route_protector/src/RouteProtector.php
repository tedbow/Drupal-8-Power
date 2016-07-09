<?php

namespace Drupal\route_protector;

use Drupal\Core\Session\AccountProxy;

/**
 * Class RouteProtector.
 *
 * @package Drupal\route_protector
 */
class RouteProtector implements RouteProtectorInterface {

  /**
   * Drupal\Core\Session\AccountProxy definition.
   *
   * @var Drupal\Core\Session\AccountProxy
   */
  protected $currentUser;
  /**
   * Constructor.
   */
  public function __construct(AccountProxy $current_user) {
    $this->currentUser = $current_user;
  }

}
