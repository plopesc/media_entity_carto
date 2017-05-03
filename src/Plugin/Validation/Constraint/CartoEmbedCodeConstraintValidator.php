<?php

namespace Drupal\media_entity_carto\Plugin\Validation\Constraint;

use Drupal\media_entity\EmbedCodeValueTrait;
use Drupal\media_entity_carto\Plugin\MediaEntity\Type\Carto;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the CartoEmbedCode constraint.
 */
class CartoEmbedCodeConstraintValidator extends ConstraintValidator {

  use EmbedCodeValueTrait;

  /**
   * {@inheritdoc}
   */
  public function validate($value, Constraint $constraint) {
    $value = $this->getEmbedCode($value);
    if (!isset($value)) {
      return;
    }

    foreach (Carto::$validationRegexp as $pattern => $key) {
      if (preg_match($pattern, $value)) {
        return;
      }
    }

    $this->context->addViolation($constraint->message);
  }

}
