<?php

namespace Drupal\asenext_test\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the result entity edit forms.
 */
class ResultForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $result = parent::save($form, $form_state);

    $entity = $this->getEntity();

    $message_arguments = ['%label' => $entity->toLink()->toString()];
    $logger_arguments = [
      '%label' => $entity->label(),
      'link' => $entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New result %label has been created.', $message_arguments));
        $this->logger('asenext_test')->notice('Created new result %label', $logger_arguments);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The result %label has been updated.', $message_arguments));
        $this->logger('asenext_test')->notice('Updated result %label.', $logger_arguments);
        break;
    }

    $form_state->setRedirect('entity.result.collection');

    return $result;
  }

}
