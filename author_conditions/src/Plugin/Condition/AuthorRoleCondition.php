<?php

namespace Drupal\author_conditions\Plugin\Condition;

use Drupal\Core\Cache\Cache;
use Drupal\Core\Cache\CacheableDependencyInterface;
use Drupal\Core\Plugin\Context\ContextDefinition;
use Drupal\node\Entity\Node;
use Drupal\user\Plugin\Condition\UserRole;

/**
 * Provides a 'Author role condition' condition to enable a condition based in module selected status.
 *
 * @Condition(
 *   id = "author_role_condition",
 *   label = @Translation("Author role condition"),
 *   context = {
 *     "node" = @ContextDefinition("entity:node", required = TRUE , label = @Translation("node"))
 *   }
 * )
 */
class AuthorRoleCondition extends UserRole {

  /**
   * {@inheritdoc}
   */
  public function evaluate() {
    if (empty($this->configuration['roles']) && !$this->isNegated()) {
      return TRUE;
    }
    /** @var Node $node */
    $node = $this->getContextValue('node');
    $author = $node->uid->entity;
    return (bool) array_intersect($this->configuration['roles'], $author->getRoles());
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheContexts() {
    $cache_contexts = [];
    // Applied contexts can affect the cache contexts when this plugin is
    // involved in caching, collect and return them.
    foreach ($this->getContexts() as $context) {
      /** @var $context \Drupal\Core\Cache\CacheableDependencyInterface */
      if ($context instanceof CacheableDependencyInterface) {
        $cache_contexts = Cache::mergeContexts($cache_contexts, $context->getCacheContexts());
      }
    }
    return $cache_contexts;
  }

}
