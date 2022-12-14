<?php

namespace Drupal\asenext_test;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a result entity type.
 */
interface ResultInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
