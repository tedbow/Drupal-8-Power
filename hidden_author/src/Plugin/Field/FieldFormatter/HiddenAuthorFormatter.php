<?php

namespace Drupal\hidden_author\Plugin\Field\FieldFormatter;
use Drupal\Core\Entity\EntityInterface;
use Drupal\user\Plugin\Field\FieldFormatter\AuthorFormatter;

/**
 * Plugin implementation of the 'author' formatter.
 *
 * @FieldFormatter(
 *   id = "hidden_author",
 *   label = @Translation("Hidden Author"),
 *   description = @Translation("Display the referenced author user entity if access allowed."),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */
class HiddenAuthorFormatter extends AuthorFormatter {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity) {
    // Always allow an entity author's username to be read, even if the current
    // user does not have permission to view the entity author's profile.
    return $entity->access('view', NULL, TRUE);
  }

}
